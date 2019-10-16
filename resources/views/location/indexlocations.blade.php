@extends('layouts.main')

@section('content')
  <ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="/locations">Locations</a></li>
  </ol>
  <div class="card">
  	<div class="card-header">Locations</div>
  	<div class="card-body">
      @if (session()->has('deleted'))
        <div class="alert alert-success" role="alert">Successfully deleted Location</div>
      @endif
      <table class="table table-bordered w-100" id="table" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Name</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Phone</th>
            @can('view', App\Location::class)
              <th class="fit"></th>
            @endcan
            @can('update', App\Location::class)
              <th class="fit"></th>
            @endcan
            @can('delete', App\Location::class)
              <th class="fit"></th>
            @endcan
          </tr>
        </thead>
        <tbody>
          @foreach ($locations as $location)
            <tr>
              <td>{{ $location->name }}</td>
              <td>{{ $location->address }}</td>
              <td>{{ $location->city }}</td>
              <td>{{ $location->state }}</td>
              <td>{{ $location->phone }}</td>
              @can('view', App\Location::class)
                <td>
                  <form method="get" action="/locations/{{ $location->id }}" class="d-inline-block">
                    @csrf
                    <input type="submit" value="Select"/>
                  </form>
                </td>
              @endcan
              @can('update', App\Location::class)
                <td>
                  <form method="get" action="/locations/{{ $location->id }}/edit" class="d-inline-block">
                    @csrf
                    <input type="submit" value="Edit"/>
                  </form>
                </td>
              @endcan
              @can('delete', App\Location::class)
                <td>
                  <form method="post" action="/locations/{{ $location->id }}" class="d-inline-block">
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
          <a href="/locations/create" class="btn btn-primary">New Location</a>
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
                text: 'New Location',
                action: function ( e, dt, node, config ) {
                    window.location = '/locations/create';
                }
              }
            ]
          }
        });
    });
  </script>
@endsection
