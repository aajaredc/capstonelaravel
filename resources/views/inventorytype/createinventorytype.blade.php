@extends('layouts.main')

@section('content')
  <ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="/inventorytypes">Inventory Types</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
  </ol>
  <div class="card">
  	<div class="card-header">Create Inventory Type</div>
  	<div class="card-body">
      @if ($errors->any())
        <div class="alert alert-warning" role="alert">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <form class="was-validated" method="post" action="/inventorytypes">
        @csrf
        <div class="row">
					<div class="col-3 col-md-3">
						<input name="name" type="text" class="form-control" placeholder="Name" required>
						<div class="valid-feedback">Valid name</div>
						<div class="invalid-feedback">Invalid name</div>
					</div>
					<div class="col-9 col-md-9">
						<input name="description" type="text" class="form-control" placeholder="Description" required>
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
