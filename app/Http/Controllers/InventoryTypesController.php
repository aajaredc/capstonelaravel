<?php

namespace App\Http\Controllers;

use App\InventoryType;
use Illuminate\Http\Request;
use Auth;
use DB;
use Validator;

class InventoryTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $this->authorize('viewAny', InventoryType::class);

      $types = InventoryType::all();

      return view('inventorytype.indexinventorytype', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $this->authorize('create', InventoryType::class);

      return view('inventorytype.createinventorytype');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->authorize('update', InventoryType::class);

      $validator = Validator::make(request()->all(), [
        'name' => 'required',
        'description' => 'required'
      ]);

      if ($validator->fails()) {
          return redirect('/inventorytypes/create')
            ->withErrors($validator)
            ->withInput();
      }

      $inventoryType = new InventoryType();
      $inventoryType->name = request('name');
      $inventoryType->description = request('description');
      $inventoryType->save();

      return redirect('/inventorytypes/' . $inventoryType->id)->with('created', $inventoryType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InventoryType  $inventoryType
     * @return \Illuminate\Http\Response
     */
    public function show(InventoryType $inventoryType)
    {
      $this->authorize('view', InventoryType::class);

      return view('inventorytype.showinventorytype', compact('inventoryType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InventoryType  $inventoryType
     * @return \Illuminate\Http\Response
     */
    public function edit(InventoryType $inventoryType)
    {
      $this->authorize('update', InventoryType::class);

      return view('inventorytype.editinventorytype', compact('inventoryType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InventoryType  $inventoryType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InventoryType $inventoryType)
    {
      $this->authorize('update', InventoryType::class);

      $validator = Validator::make(request()->all(), [
        'name' => 'required',
        'description' => 'required'
      ]);

      if ($validator->fails()) {
          return redirect('/inventorytypes/create')
            ->withErrors($validator)
            ->withInput();
      }

      $inventoryType->name = request('name');
      $inventoryType->description = request('description');
      $inventoryType->save();

      return redirect('/inventorytypes/' . $inventoryType->id)->with('updated', $inventoryType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InventoryType  $inventoryType
     * @return \Illuminate\Http\Response
     */
    public function destroy(InventoryType $inventoryType)
    {
      $this->authorize('delete', InventoryType::class);

      $inventoryType->delete();

      return redirect('/inventorytypes')->with('deleted', $inventoryType);
    }
}
