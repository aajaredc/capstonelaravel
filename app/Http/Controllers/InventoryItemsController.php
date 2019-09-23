<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InventoryItem;
use App\InventoryType;
use Auth;
use DB;
use Validator;

class InventoryItemsController extends Controller
{
    public function index()
    {
      $this->authorize('viewAny', InventoryItem::class);

      $items = InventoryItem::all();
      $types = InventoryType::all();

      return view('indexinventoryitem', compact('items', 'types'));
    }

    public function show($id)
    {
      $this->authorize('view', InventoryItem::class);

      $item = InventoryItem::where('id', $id)->first();
      $type = InventoryType::where('id', $item->inventory_type_id)->first();

      return view('showinventoryitem', compact('item', 'type'));
    }

    public function edit($id)
    {
      $this->authorize('update', InventoryItem::class);

      $item = InventoryItem::where('id', $id)->first();
      $types = InventoryType::where('id', $item->inventory_type_id)->get();

      return view('editinventoryitem', compact('item', 'types'));
    }

    public function update($id)
    {
      $this->authorize('update', InventoryItem::class);

      $item = InventoryItem::find($id);
      $item->name = request('name');
      $item->inventory_type_id = request('type');
      $item->price = request('price');
      $item->count = request('count');
      $item->description = request('description');
      $item->save();

      return redirect('/inventoryitems/' . $id);
    }

    public function create()
    {
      $this->authorize('create', InventoryItem::class);

      $types = InventoryType::all();

      return view('createinventoryitem', compact('types'));
    }

    public function store()
    {
      $this->authorize('create', InventoryItem::class);

      $validator = Validator::make(request()->all(), [
        'name' => 'required',
        'type' => 'required',
        'price' => 'required',
        'count' => 'required',
        'description' => 'required'
      ]);

      if ($validator->fails()) {
          return redirect('/inventoryitems/create')
            ->withErrors($validator)
            ->withInput();
      }

      $id = DB::table('inventory_items')->insertGetId(
          [
            'name' => request('name'),
            'inventory_type_id' => request('type'),
            'price' => request('price'),
            'count' => request('count'),
            'description' => request('description')
          ]
      );

      return redirect('/inventoryitems/' . $id)->with('success', $id);
    }

    public function destroy($id)
    {
      $this->authorize('delete', InventoryItem::class);

      InventoryItem::find($id)->delete();

      return redirect('/inventoryitems')->with('deleted', $id);
    }
}
