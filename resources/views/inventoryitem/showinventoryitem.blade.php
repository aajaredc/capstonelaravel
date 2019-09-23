@extends('layouts.main')

@section('content')
  <ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="/inventoryitems">Inventory Items</a></li>
    <li class="breadcrumb-item active" aria-current="page">Show</li>
  </ol>
  <div class="card">
  	<div class="card-header">Information for Inventory Item {{ $inventoryItem->id }}</div>
  	<div class="card-body">
      @if (session()->has('success'))
        <div class="alert alert-success" role="alert">Successfully created new Inventory Item</div>
      @endif
      @if (session()->has('updated'))
        <div class="alert alert-success" role="alert">Successfully updated Inventory Item</div>
      @endif
      <table class="table table-bordered" width="100%" cellspacing="0">
        <tbody>
          <tr>
            <th>Name</th>
            <td>{{ $inventoryItem->name }}</td>
          </tr>
          <tr>
            <th>Category</th>
            <td>{{ $type->name }}</td>
          </tr>
          <tr>
            <th>Price</th>
            <td>{{ $inventoryItem->price }}</td>
          </tr>
          <tr>
            <th>Count</th>
            <td>{{ $inventoryItem->count }}</td>
          </tr>
          <tr>
            <th>Description</th>
            <td>{{ $inventoryItem->description }}</td>
          </tr>
          <tr>
            <th>Created</th>
            <td>{{ $inventoryItem->created_at }}</td>
          </tr>
          <tr>
            <th>Last Updated</th>
            <td>{{ $inventoryItem->updated_at }}</td>
          </tr>
        </tbody>
      </table>
  	</div>
  </div>
@endsection

@section('additional')
@endsection
