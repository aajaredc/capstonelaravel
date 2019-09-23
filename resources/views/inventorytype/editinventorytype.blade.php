@extends('layouts.main')

@section('content')
  <ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="/inventorytypes">Inventory Types</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
  </ol>
  <div class="card">
  	<div class="card-header">Edit Inventory Type {{ $inventoryType->id }}</div>
  	<div class="card-body">
      <form class="was-validated" method="post" action="/inventorytypes/{{ $inventoryType->id }}">
        {{ method_field('PATCH') }}
        @csrf
        <div class="row">
					<div class="col-3 col-md-3">
						<input name="name" type="text" class="form-control" placeholder="Name" value="{{ $inventoryType->name }}" required>
						<div class="valid-feedback">Valid name</div>
						<div class="invalid-feedback">Invalid name</div>
					</div>
					<div class="col-9 col-md-9">
						<input name="description" type="text" class="form-control" placeholder="Description" value="{{ $inventoryType->description }}" required>
						<div class="valid-feedback">Valid description</div>
						<div class="invalid-feedback">Invalid description</div>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-12">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
  		</form>
  	</div>
  </div>
@endsection

@section('additional')
@endsection
