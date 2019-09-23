@extends('layouts.main')

@section('content')
  <ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="/inventoryitems">Inventory Items</a></li>
  </ol>
  <div class="card">
  	<div class="card-header">Inventory Items</div>
  	<div class="card-body">
      @if (session()->has('deleted'))
        <div class="alert alert-success" role="alert">Successfully deleted Inventory Item</div>
      @endif
      <table class="table table-bordered w-100" id="table" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Price</th>
            <th>Count</th>
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
          @foreach ($items as $item)
            <tr>
              <td>{{ $item->name }}</td>
              <td>{{ DB::table('inventory_types')->where('id', $item->inventory_type_id)->value('name') }}</td>
              <td>{{ $item->price }}</td>
              <td>{{ $item->count }}</td>
              <td>{{ $item->description }}</td>
              @can('view', App\InventoryItem::class)
                <td>
                  <form method="get" action="/inventoryitems/{{ $item->id }}" class="d-inline-block">
                    @csrf
                    <input type="submit" value="Select"/>
                  </form>
                </td>
              @endcan
              @can('update', App\InventoryItem::class)
                <td>
                  <form method="get" action="/inventoryitems/{{ $item->id }}/edit" class="d-inline-block">
                    @csrf
                    <input type="submit" value="Edit"/>
                  </form>
                </td>
              @endcan
              @can('delete', App\InventoryItem::class)
                <td>
                  <form method="post" action="/inventoryitems/{{ $item->id }}" class="d-inline-block">
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
          <a href="/inventoryitems/create" class="btn btn-primary">New Item</a>
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
                text: 'New Item',
                action: function ( e, dt, node, config ) {
                    window.location = '/inventoryitems/create';
                }
              }
            ]
          }
        });
    });
  </script>
@endsection
