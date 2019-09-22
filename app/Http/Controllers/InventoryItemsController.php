<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InventoryItem;
use App\InventoryType;
use Auth;
use DB;

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
      $types = InventoryType::where('id', $item->inventory_type_id)->first();

      return view('editinventoryitem', compact('item', 'types'));
    }
}
