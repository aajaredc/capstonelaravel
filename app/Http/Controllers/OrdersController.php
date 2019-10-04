<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\InventoryItem;
use App\InventoryType;
use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;
use App\Location;
use App\User;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $orders = Order::all();

      return view('order.indexorders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      // Variables
      $items = InventoryItem::all();
      $types = InventoryType::all();
      $input = $request->all();
      $itemid = request('itemid');
      $orderdetailsDecoded = json_decode(request('orderdetails'), TRUE); // array of every order detail added so far
      $orderdetailid = request('orderdetailid');
      $itemOccurences = array(); // number of each item that is ordered

      if (request('orderdetails') === NULL) {
        // Start of the order
        $orderdetails = array();
      } else {
        // Convert current order details to array
        $orderdetails = array();

        for ($i=0; $i < count($orderdetailsDecoded); $i++) {
          // Check for button delete
          if ($request->has('deletesubmit')) {
            if ($orderdetailid == $i) {
              continue;
            }
          }

          $detail = new OrderDetail();
          $detail->id = count($orderdetails); // temp id
          $detail->inventory_item_id = $orderdetailsDecoded[$i]['inventory_item_id'];
          $detail->price = $orderdetailsDecoded[$i]['price'];
          $detail->note = $orderdetailsDecoded[$i]['note'];

          array_push($orderdetails, $detail);
        }
      }

      // Add new detail to array of order details
      if ($request->has('itemid')) {
        $detail = new OrderDetail();
        $detail->id = count($orderdetails); // temp id
        $detail->inventory_item_id = $itemid;
        $detail->price = $items->find($itemid)->price;
        $detail->note = NULL;

        array_push($orderdetails, $detail);
      }

      // Get and set the number of each item that is ordered
      foreach ($orderdetails as $orderdetail) {
        array_push($itemOccurences, $orderdetail->inventory_item_id);
      }
      $itemOccurences = array_count_values($itemOccurences);

      // Edit button is pressed
      if ($request->has('editsubmit')) {
        $orderdetailid = request('orderdetailid');
        $orderdetails[$orderdetailid]->price = request('price');
        $orderdetails[$orderdetailid]->note = request('note');
      }

      // Return
      return view('order.createorder', compact('itemOccurences', 'orderdetails', 'items', 'types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      try {
        $orderdetails = $request->orderdetails;
        $orderdetails = json_decode($orderdetails);

        // Get the number of item occurences
        $itemOccurences = array();
        foreach ($orderdetails as $detail) {
          array_push($itemOccurences, $detail->inventory_item_id);
        }
        $itemOccurences = array_count_values($itemOccurences);
      } catch (\Exception $e) {

      }


      // Validation
      $validator = Validator::make(request()->all(), [
        'orderdetails' => 'required|json'
      ]);

      try {
        foreach ($orderdetails as $detail) {
          if ($itemOccurences[$detail->inventory_item_id] > InventoryItem::find($detail->inventory_item_id)->value('count')) {
            $validator->after(function ($validator) {
              $validator->errors()->add('invaliditemcount', 'An invalid number of items was ordered.');
            });
          }
        }
      } catch (\Exception $e) {

      }


      if ($validator->fails()) {
          return redirect('/orders/create')
            ->withErrors($validator);
      }

      // Add the order to the database
      $order = new Order();
      $order->user_id = Auth::user()->id;
      $order->location_id = Auth::user()->location_id;
      $order->complete = false;
      $order->save();

      foreach ($orderdetails as $detail) {
        // Add the order details to the database
        $orderdetail = new OrderDetail();
        $orderdetail->order_id = $order->id;
        $orderdetail->inventory_item_id = $detail->inventory_item_id;
        $orderdetail->price = $detail->price;
        $orderdetail->note = $detail->note;
        $orderdetail->complete = false;
        $orderdetail->save();

        // Remove item from database when it is ordered
        $inventoryItem = InventoryItem::find($orderdetail->inventory_item_id);
        $inventoryItem->count = $inventoryItem->count - 1;
        $inventoryItem->save();
      }

      // Feedback
      $created = true;
      return redirect('/orders/' . $order->id)->with('created', $order);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
      return view('order.showorder', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
      $this->authorize('delete', Order::class);

      $order->delete();
      $details = OrderDetail::all()->where('order_id', $order->id);

      foreach ($details as $detail) {
        $detail->delete();
      }

      return redirect('/orders')->with('deleted', $order);
    }

    /**
     * List orders that are to be closed
     *
     * @return \Illuminate\Http\Response
     */
    public function closeindex()
    {
      $orders = Order::where('complete', 0)->get();

      return view('order.closeorders', compact('orders'));
    }

    /**
     * Close the specified Order
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function close(Order $order)
    {
      $details = OrderDetail::where('order_id', $order->id)->get();
      foreach ($details as $detail) {
        $detail->complete = 1;
        $detail->save();
      }

      $order->complete = 1;
      $order->save();

      return redirect('/orders/close')->with('closed', $order);
    }
}
