<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\InventoryItem;
use App\InventoryType;
use Illuminate\Http\Request;
use DB;
use Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


      // This new order system prevents orders from being in the database before they're submitted

      $orderdetails = array();
      $orderdetailid = request('orderdetailid');
      $orderdetailprice = request('price');
      $orderdetailnote = request('note');

      if ($request->has('inventoryitem') || $request->has('inventoryitems')) {
        $inventoryitems = request('inventoryitems');

        $orderitems = array(request('inventoryitem'));

        if ($request->has('inventoryitem')) {

          if ($request->has('inventoryitems')) {
            $orderitems = array_values(json_decode($inventoryitems, true));
            array_push($orderitems, request('inventoryitem'));
          }
        } else {
          $orderitems = array_values(json_decode($inventoryitems, true));
          if ($request->has('deletesubmit')) {
            unset($orderitems[$orderdetailid]);
          }
        }

        foreach ($orderitems as $orderitem) {
          $orderdetail = new OrderDetail();
          $orderdetail->id = count($orderdetails); // temp id
          $orderdetail->inventory_item_id = $orderitem;
          // this doesn't work for some reason
          // $orderdetail->price = $items->find($orderdetail->inventory_item_id)->value('price');
          $orderdetail->price = DB::table('inventory_items')->where('id', $orderdetail->inventory_item_id)->value('price');
          $orderdetail->note = NULL;

          array_push($orderdetails, $orderdetail);
        }


        $itemOccurences = array_count_values($orderitems);        

        if ($request->has('editsubmit')) {
          if ($request->has('price')) {
            $orderdetails[$orderdetailid]->price = $orderdetailprice;
          }
          if ($request->has('note')) {
            $orderdetails[$orderdetailid]->note = $orderdetailnote;
          }
        }
      }


      if (isset($orderitems)) {
        return view('order.createorder', compact('itemOccurences', 'orderdetails', 'orderitems', 'items', 'types'));
      } else {
        return view('order.createorder', compact('items', 'types'));
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $orderdetails = $request->orderdetails;
      $orderdetails = json_decode($orderdetails);

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
        //
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
        //
    }
}
