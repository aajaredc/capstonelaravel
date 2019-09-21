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
      $items = InventoryItem::all();
      $types = InventoryType::all();

      return view('selectinventoryitems', compact('items', 'types'));
    }
}
