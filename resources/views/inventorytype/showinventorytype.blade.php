@extends('layouts.main')

@section('content')
  <ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="/inventorytypes">Inventory Types</a></li>
    <li class="breadcrumb-item active" aria-current="page">Show</li>
  </ol>
  <div class="card">
  	<div class="card-header">Information for Inventory Type {{ $inventoryType->id }}</div>
  	<div class="card-body">
      @if (session()->has('created'))
        <div class="alert alert-success" role="alert">Successfully created new Inventory Type</div>
      @endif
      @if (session()->has('updated'))
        <div class="alert alert-success" role="alert">Successfully updated Inventory Type</div>
      @endif
      <table class="table table-bordered" width="100%" cellspacing="0">
        <tbody>
          <tr>
            <th>Name</th>
            <td>{{ $inventoryType->name }}</td>
          </tr>
          <tr>
            <th>Description</th>
            <td>{{ $inventoryType->description }}</td>
          </tr>
          <tr>
            <th>Created</th>
            <td>{{ $inventoryType->created_at }}</td>
          </tr>
          <tr>
            <th>Last Updated</th>
            <td>{{ $inventoryType->updated_at }}</td>
          </tr>
        </tbody>
      </table>
  	</div>
  </div>
@endsection

@section('additional')
@endsection
