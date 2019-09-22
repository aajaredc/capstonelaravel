@extends('layouts.main')

@section('content')
  <ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="/inventoryitems">Inventory Items</a></li>
  </ol>
  <div class="card">
  	<div class="card-header">Inventory Items</div>
  	<div class="card-body">
      <table class="table table-bordered w-100" id="selectTable" width="100%" cellspacing="0">
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
            </tr>
          @endforeach
        </tbody>
      </table>
  	</div>
  </div>
@endsection

@section('additional')
  <script>
    $(document).ready( function () {
        $('#selectTable').DataTable({
          responsive: true
        });
    });
  </script>
@endsection
