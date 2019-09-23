@extends('layouts.main')

@section('content')
  <ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="/users">Users</a></li>
  </ol>
  <div class="card">
  	<div class="card-header">Users</div>
  	<div class="card-body">
      @if (session()->has('deleted'))
        <div class="alert alert-success" role="alert">Successfully deleted User</div>
      @endif
      <table class="table table-bordered w-100" id="table" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Type</th>
            @can('view', App\User::class)
              <th class="fit"></th>
            @endcan
            @can('update', App\User::class)
              <th class="fit"></th>
            @endcan
            @can('delete', App\User::class)
              <th class="fit"></th>
            @endcan
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr>
              <td>{{ $user->firstname }}</td>
              <td>{{ $user->lastname }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->username }}</td>
              <td>{{ DB::table('user_types')->where('id', $user->user_type_id)->value('name') }}</td>
              @can('view', App\User::class)
                <td>
                  <form method="get" action="/users/{{ $user->id }}" class="d-inline-block">
                    @csrf
                    <input type="submit" value="Select"/>
                  </form>
                </td>
              @endcan
              @can('update', App\User::class)
                <td>
                  <form method="get" action="/users/{{ $user->id }}/edit" class="d-inline-block">
                    @csrf
                    <input type="submit" value="Edit"/>
                  </form>
                </td>
              @endcan
              @can('delete', App\User::class)
                <td>
                  <form method="post" action="/users/{{ $user->id }}" class="d-inline-block">
                    {{ method_field('DELETE') }}
                    @csrf
                    <input type="submit" value="Delete"/>
                  </form>
                </td>
              @endcan
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="row mt-3">
        <div class="col-12">
          <a href="/users/create" class="btn btn-primary">New User</a>
        </div>
      </div>
  	</div>
  </div>
@endsection

@section('additional')
  <script>
    $(document).ready( function () {
        $('#table').DataTable({
          // Customize data tables to add the "new item" button next to the listing option
          "lengthMenu": [ 10, 25, 50, 75, 100 ],
          dom:
          "<'row'<'col-sm-12 col-md-6'<'d-inline-block'l><'d-inline-block ml-md-4'B>><'col-sm-12 col-md-6'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
          buttons: {
            dom: {
              button: {
                tag: 'button',
                className: 'btn btn-primary'
              }
            },
            buttons: [
              {
                text: 'New User',
                action: function ( e, dt, node, config ) {
                    window.location = '/users/create';
                }
              }
            ]
          }
        });
    });
  </script>
@endsection
