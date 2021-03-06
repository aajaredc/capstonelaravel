@extends('layouts.main')

@section('content')
  <ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="/inventoryitems">Inventory Items</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
  </ol>
  <div class="card">
  	<div class="card-header">Edit Inventory Item {{ $inventoryItem->id }}</div>
  	<div class="card-body">
      <form class="was-validated" method="post" action="/inventoryitems/{{ $inventoryItem->id }}">
        {{ method_field('PATCH') }}
        @csrf
				<div class="row">
					<div class="col-12 col-md-6 mb-3">
						<input name="name" type="text" class="form-control" placeholder="Name" required value="{{ $inventoryItem->name }}">
						<div class="valid-feedback">Valid name</div>
						<div class="invalid-feedback">Invalid name</div>
					</div>
					<div class="col-12 col-md-4 mb-3">
						<select name="type" class="form-control" required>
							<option disabled selected>Type</option>
              @foreach ($types as $type)
                <option value="{{ $type->id }}" @if ($type->id == $inventoryItem->inventory_type_id) selected @endif>
                  {{ $type->name }}
                </option>
              @endforeach
						</select>
						<div class="valid-feedback">Valid type</div>
						<div class="invalid-feedback">Invalid type</div>
					</div>
					<div class="col-12 col-md-4 mb-3">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">$</div>
							</div>
							<input name="price" type="text" class="form-control" placeholder="Price" required value="{{ $inventoryItem->price }}">
							<div class="valid-feedback">Valid price</div>
							<div class="invalid-feedback">Invalid price</div>
						</div>
					</div>
					<div class="col-12 col-md-3 mb-3">
						<input name="count" type="text" class="form-control" placeholder="Count" required value="{{ $inventoryItem->count }}">
						<div class="valid-feedback">Valid count</div>
						<div class="invalid-feedback">Invalid count</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 mb-3">
						<input name="description" type="text" class="form-control" placeholder="Description" required value="{{ $inventoryItem->description }}">
						<div class="valid-feedback">Valid description</div>
						<div class="invalid-feedback">Invalid description</div>
					</div>
				</div>
				<div class="row">
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
