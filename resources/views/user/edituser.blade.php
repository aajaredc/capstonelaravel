@extends('layouts.main')

@section('content')
  <ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="/users">Users</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
  </ol>
  <div class="card">
  	<div class="card-header">Edit User</div>
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
      <form class="was-validated" method="post" action="/users/{{ $user->id }}">
        {{ method_field('PATCH') }}
        @csrf
        <div class="row">
					<div class="col-12 col-md-2 mb-3">
						<input name="firstname" type="text" class="form-control" placeholder="First Name" value="{{ $user->firstname }}" required autocomplete="firstname" autofocus>
						<div class="valid-feedback">Valid first name</div>
						<div class="invalid-feedback">Invalid first name</div>
					</div>
          <div class="col-12 col-md-2 mb-3">
						<input name="lastname" type="text" class="form-control" placeholder="Last Name" value="{{ $user->lastname }}" required autocomplete="lastname" autofocus>
						<div class="valid-feedback">Valid last name</div>
						<div class="invalid-feedback">Invalid last name</div>
					</div>
				</div>
        <div class="row">
          <div class="col-12 col-md-2 mb-3">
						<input name="username" type="text" class="form-control" placeholder="Username" value="{{ $user->username }}" required autocomplete="username" autofocus>
						<div class="valid-feedback">Valid username</div>
						<div class="invalid-feedback">Invalid username</div>
					</div>
          <div class="col-12 col-md-3 mb-3">
            <input name="email" type="text" class="form-control" placeholder="Email" value="{{ $user->email }}" required autocomplete="email" autofocus>
            <div class="valid-feedback">Valid email</div>
            <div class="invalid-feedback">Invalid email</div>
          </div>
          <div class="col-12 col-md-3 mb-3">
            <select name="type" class="form-control" required>
              <option disabled selected>Type</option>
              @foreach ($types as $type)
                <option value="{{ $type->id }}" @if ($type->id == $user->user_type_id) selected @endif>
                  {{ $type->name }}
                </option>
              @endforeach
            </select>
            <div class="valid-feedback">Valid user type</div>
            <div class="invalid-feedback">Invalid user type</div>
          </div>
				</div>
        <div class="row">
          <div class="col-12 col-md-3 mb-3">
            <input name="password" type="password" class="form-control" placeholder="Password" required autocomplete="new-password">
            <div class="valid-feedback">Valid password</div>
            <div class="invalid-feedback">Invalid password</div>
          </div>
          <div class="col-12 col-md-3 mb-3">
            <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password" required autocomplete="new-password">
            <div class="valid-feedback">Valid confirmed password</div>
            <div class="invalid-feedback">Invalid confirmed password</div>
          </div>
        </div>
				<div class="row">
					<div class="col-12">
						<button type="submit" name="namesubmit" class="btn btn-primary">Submit</button>
					</div>
				</div>
  		</form>
  	</div>
  </div>
@endsection

@section('additional')

@endsection
