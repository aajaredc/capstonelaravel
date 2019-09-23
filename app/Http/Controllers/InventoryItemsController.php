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

      $inventoryItems = InventoryItem::all();
      $types = InventoryType::all();

      return view('inventoryitem.indexinventoryitem', compact('inventoryItems', 'types'));
    }

    public function show(InventoryItem $inventoryItem)
    {
      $this->authorize('view', InventoryItem::class);

      $type = InventoryType::where('id', $inventoryItem->inventory_type_id)->first();

      return view('inventoryitem.showinventoryitem', compact('inventoryItem', 'type'));
    }

    public function edit(InventoryItem $inventoryItem)
    {
      $this->authorize('update', InventoryItem::class);

      $types = InventoryType::where('id', $inventoryItem->inventory_type_id)->get();

      return view('inventoryitem.editinventoryitem', compact('inventoryItem', 'types'));
    }

    public function update(InventoryItem $inventoryItem)
    {
      $this->authorize('update', InventoryItem::class);

      $inventoryItem->name = request('name');
      $inventoryItem->inventory_type_id = request('type');
      $inventoryItem->price = request('price');
      $inventoryItem->count = request('count');
      $inventoryItem->description = request('description');
      $inventoryItem->save();

      return redirect('/inventoryitems/' . $inventoryItem->id)->with('updated', $inventoryItem);
    }

    public function create()
    {
      $this->authorize('create', InventoryItem::class);

      $types = InventoryType::all();

      return view('inventoryitem.createinventoryitem', compact('types'));
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

      $inventoryItem = new InventoryItem();
      $inventoryItem->name = request('name');
      $inventoryItem->inventory_type_id = request('type');
      $inventoryItem->price = request('price');
      $inventoryItem->count = request('count');
      $inventoryItem->description = request('description');
      $inventoryItem->save();

      return redirect('/inventoryitems/' . $inventoryItem->id)->with('success', $inventoryItem);
    }

    public function destroy(InventoryItem $inventoryItem)
    {
      $this->authorize('delete', InventoryItem::class);

      $inventoryItem->delete();

      return redirect('/inventoryitems')->with('deleted', $inventoryItem);
    }
}
