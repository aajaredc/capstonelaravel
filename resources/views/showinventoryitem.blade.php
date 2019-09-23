@extends('layouts.main')

@section('content')
  <ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="/inventoryitems">Inventory Items</a></li>
    <li class="breadcrumb-item active" aria-current="page">Show</li>
  </ol>
  <div class="card">
  	<div class="card-header">Information for Inventory Item {{ $item->id }}</div>
  	<div class="card-body">
      @if (session()->has('success'))
        <div class="alert alert-success" role="alert">Successfully created new Inventory Item</div>
      @endif
      <table class="table table-bordered" width="100%" cellspacing="0">
        <tbody>
          <tr>
            <th>Name</th>
            <td>{{ $item->name }}</td>
          </tr>
          <tr>
            <th>Category</th>
            <td>{{ $type->name }}</td>
          </tr>
          <tr>
            <th>Price</th>
            <td>{{ $item->price }}</td>
          </tr>
          <tr>
            <th>Count</th>
            <td>{{ $item->count }}</td>
          </tr>
          <tr>
            <th>Description</th>
            <td>{{ $item->description }}</td>
          </tr>
        </tbody>
      </table>
  	</div>
  </div>
@endsection

@section('additional')
@endsection
