@extends('layouts.main')

@section('content')
  <ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="/locations">Locations</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
  </ol>
  <div class="card">
  	<div class="card-header">Create Location</div>
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
      <form class="was-validated" method="post" action="/locations">
        @csrf
        <div class="row">
          <div class="col-3 col-md-3">
						<input name="name" type="text" class="form-control" placeholder="Name" required>
						<div class="valid-feedback">Valid name</div>
						<div class="invalid-feedback">Invalid name</div>
					</div>
				</div>
        <div class="row mt-2">
          <div class="col-4 col-md-4">
            <input name="address" type="text" class="form-control" placeholder="Address" required>
            <div class="valid-feedback">Valid address</div>
            <div class="invalid-feedback">Invalid address</div>
          </div>
          <div class="col-2 col-md-2">
            <input name="city" type="text" class="form-control" placeholder="City" required>
            <div class="valid-feedback">Valid city</div>
            <div class="invalid-feedback">Invalid city</div>
          </div>
          <div class="col-2 col-md-2">
            <select name="state" class="form-control" required>
              <option selected disabled>State</option>
              <option value="AL">Alabama</option>
            	<option value="AK">Alaska</option>
            	<option value="AZ">Arizona</option>
            	<option value="AR">Arkansas</option>
            	<option value="CA">California</option>
            	<option value="CO">Colorado</option>
            	<option value="CT">Connecticut</option>
            	<option value="DE">Delaware</option>
            	<option value="DC">District of Columbia</option>
            	<option value="FL">Florida</option>
            	<option value="GA">Georgia</option>
            	<option value="HI">Hawaii</option>
            	<option value="ID">Idaho</option>
            	<option value="IL">Illinois</option>
            	<option value="IN">Indiana</option>
            	<option value="IA">Iowa</option>
            	<option value="KS">Kansas</option>
            	<option value="KY">Kentucky</option>
            	<option value="LA">Louisiana</option>
            	<option value="ME">Maine</option>
            	<option value="MD">Maryland</option>
            	<option value="MA">Massachusetts</option>
            	<option value="MI">Michigan</option>
            	<option value="MN">Minnesota</option>
            	<option value="MS">Mississippi</option>
            	<option value="MO">Missouri</option>
            	<option value="MT">Montana</option>
            	<option value="NE">Nebraska</option>
            	<option value="NV">Nevada</option>
            	<option value="NH">New Hampshire</option>
            	<option value="NJ">New Jersey</option>
            	<option value="NM">New Mexico</option>
            	<option value="NY">New York</option>
            	<option value="NC">North Carolina</option>
            	<option value="ND">North Dakota</option>
            	<option value="OH">Ohio</option>
            	<option value="OK">Oklahoma</option>
            	<option value="OR">Oregon</option>
            	<option value="PA">Pennsylvania</option>
            	<option value="RI">Rhode Island</option>
            	<option value="SC">South Carolina</option>
            	<option value="SD">South Dakota</option>
            	<option value="TN">Tennessee</option>
            	<option value="TX">Texas</option>
            	<option value="UT">Utah</option>
            	<option value="VT">Vermont</option>
            	<option value="VA">Virginia</option>
            	<option value="WA">Washington</option>
            	<option value="WV">West Virginia</option>
            	<option value="WI">Wisconsin</option>
            	<option value="WY">Wyoming</option>
            </select>
            <div class="valid-feedback">Valid state</div>
            <div class="invalid-feedback">Invalid state</div>
          </div>
          <div class="col-1 col-md-1">
            <input name="zip" type="text" class="form-control" placeholder="ZIP" required>
            <div class="valid-feedback">Valid ZIP code</div>
            <div class="invalid-feedback">Invalid ZIP code</div>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-3 col-md-3">
            <input name="phone" type="text" class="form-control" placeholder="Phone" required>
            <div class="valid-feedback">Valid phone number</div>
            <div class="invalid-feedback">Invalid phone number</div>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-12 col-md-6">
            <input name="Description" type="text" class="form-control" placeholder="Description">
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
