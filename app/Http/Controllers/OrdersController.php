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
      $items = InventoryItem::all();
      $types = InventoryType::all();
      $input = $request->all();
      $itemid = request('itemid');
      $orderdetailsDecoded = json_decode(request('orderdetails'), TRUE);

      if (request('orderdetails') === NULL) {
        $orderdetails = array();
      } else {
        $orderdetails = array();

        for ($i=0; $i < count($orderdetailsDecoded); $i++) {
          $detail = new OrderDetail();
          $detail->id = count($orderdetails); // temp id
          $detail->inventory_item_id = $orderdetailsDecoded[$i]['inventory_item_id'];
          $detail->price = $orderdetailsDecoded[$i]['price'];
          $detail->note = $orderdetailsDecoded[$i]['note'];

          array_push($orderdetails, $detail);
        }
      }


      if ($request->has('itemid')) {
        $detail = new OrderDetail();
        $detail->id = count($orderdetails); // temp id
        $detail->inventory_item_id = $itemid;
        $detail->price = $items->find($itemid)->price;
        $detail->note = NULL;

        array_push($orderdetails, $detail);
      }

      if ($request->has('editsubmit')) {
        $orderdetailid = request('orderdetailid');
        $orderdetails[$orderdetailid]->price = request('price');
        $orderdetails[$orderdetailid]->note = request('note');
      }

      return view('order.createorder', compact('orderdetails', 'items', 'types'));

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

      $order = new Order();
      $order->user_id = Auth::user()->id;
      $order->location_id = Auth::user()->location_id;
      $order->complete = false;
      $order->save();

      foreach ($orderdetails as $detail) {
        $orderdetail = new OrderDetail();
        $orderdetail->order_id = $order->id;
        $orderdetail->inventory_item_id = $detail->inventory_item_id;
        $orderdetail->price = $detail->price;
        $orderdetail->note = $detail->note;
        $orderdetail->complete = false;
        $orderdetail->save();
      }

      dd($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
      $user = User::find($order->user_id);
      $location = Location::find($order->location_id);
      $details = OrderDetail::all()->where('order_id', $order->id);

      return view('order.showorder', compact('details', 'order', 'user', 'location'));
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
}
