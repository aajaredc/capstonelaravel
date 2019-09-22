@extends('layouts.main')

@section('content')
  <ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="/inventoryitems">Inventory Items</a></li>
    <li class="breadcrumb-item active" aria-current="page">Update</li>
  </ol>
  <div class="card">
  	<div class="card-header">Edit Inventory Item {{ $item->id }}</div>
  	<div class="card-body">

  	</div>
  </div>
@endsection

@section('additional')
@endsection
