@extends('layouts.main')

@section('content')
  <ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="/users">Users</a></li>
    <li class="breadcrumb-item active" aria-current="page">Show</li>
  </ol>
  <div class="card">
  	<div class="card-header">Information for User {{ $user->id }}</div>
  	<div class="card-body">
      @if (session()->has('created'))
        <div class="alert alert-success" role="alert">Successfully created new User</div>
      @endif
      @if (session()->has('updated'))
        <div class="alert alert-success" role="alert">Successfully updated User</div>
      @endif
      <table class="table table-bordered" width="100%" cellspacing="0">
        <tbody>
          <tr>
            <th>First Name</th>
            <td>{{ $user->firstname }}</td>
          </tr>
          <tr>
            <th>Last Name</th>
            <td>{{ $user->lastname }}</td>
          </tr>
          <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
          </tr>
          <tr>
            <th>Username</th>
            <td>{{ $user->username }}</td>
          </tr>
          <tr>
            <th>Category</th>
            <td>{{ $type->name }}</td>
          </tr>
          <tr>
            <th>Created</th>
            <td>{{ $user->created_at }}</td>
          </tr>
          <tr>
            <th>Last Updated</th>
            <td>{{ $user->updated_at }}</td>
          </tr>
        </tbody>
      </table>
  	</div>
  </div>
@endsection

@section('additional')
@endsection
