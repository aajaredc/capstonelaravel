@extends('layouts.main')

@section('content')
  <ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="/inventorytypes">Inventory Types</a></li>
  </ol>
  <div class="card">
  	<div class="card-header">Inventory Types</div>
  	<div class="card-body">
      @if (session()->has('deleted'))
        <div class="alert alert-success" role="alert">Successfully deleted Inventory Type</div>
      @endif
      <table class="table table-bordered w-100" id="table" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Name</th>
            <th>Description</th>
            @can('view', App\InventoryItem::class)
              <th class="fit"></th>
            @endcan
            @can('update', App\InventoryItem::class)
              <th class="fit"></th>
            @endcan
            @can('delete', App\InventoryItem::class)
              <th class="fit"></th>
            @endcan
          </tr>
        </thead>
        <tbody>
          @foreach ($types as $type)
            <tr>
              <td>{{ $type->name }}</td>
              <td>{{ $type->description }}</td>
              @can('view', App\InventoryItem::class)
                <td>
                  <form method="get" action="/inventorytypes/{{ $type->id }}" class="d-inline-block">
                    @csrf
                    <input type="submit" value="Select"/>
                  </form>
                </td>
              @endcan
              @can('update', App\InventoryItem::class)
                <td>
                  <form method="get" action="/inventorytypes/{{ $type->id }}/edit" class="d-inline-block">
                    @csrf
                    <input type="submit" value="Edit"/>
                  </form>
                </td>
              @endcan
              @can('delete', App\InventoryItem::class)
                <td>
                  <form method="post" action="/inventorytypes/{{ $type->id }}" class="d-inline-block">
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
          <a href="/inventorytypes/create" class="btn btn-primary">New Type</a>
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
                text: 'New Type',
                action: function ( e, dt, node, config ) {
                    window.location = '/inventorytypes/create';
                }
              }
            ]
          }
        });
    });
  </script>
@endsection
