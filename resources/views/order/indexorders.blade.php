@extends('layouts.main')

@section('content')
  <ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="/orders">Orders</a></li>
  </ol>
  <div class="card">
  	<div class="card-header">Orders</div>
  	<div class="card-body">
      @if (session()->has('deleted'))
        <div class="alert alert-success" role="alert">Successfully deleted Order</div>
      @endif
      <table class="table table-bordered w-100" id="table" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Date</th>
            <th>Time</th>
            <th>User</th>
            <th>Location</th>
            @can('view', App\Order::class)
              <th class="fit"></th>
            @endcan
            @can('update', App\Order::class)
              <th class="fit"></th>
            @endcan
            @can('delete', App\Order::class)
              <th class="fit"></th>
            @endcan
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order)
            <tr>
              <td>{{ date('Y/m/d', strtotime($order->created_at)) }}</td>
              <td>{{ date('H:i:s', strtotime($order->created_at)) }}</td>
              <td>{{ DB::table('users')->where('id', $order->user_id)->value('lastname') }}</td>
              <td>{{ DB::table('locations')->where('id', $order->location_id)->value('name') }}</td>
              @can('view', App\Order::class)
                <td>
                  <form method="get" action="/orders/{{ $order->id }}" class="d-inline-block">
                    @csrf
                    <input type="submit" value="Select"/>
                  </form>
                </td>
              @endcan
              @can('update', App\Order::class)
                <td>
                  <form method="get" action="/orders/{{ $order->id }}/edit" class="d-inline-block">
                    @csrf
                    <input type="submit" value="Edit"/>
                  </form>
                </td>
              @endcan
              @can('delete', App\Order::class)
                <td>
                  <form method="post" action="/orders/{{ $order->id }}" class="d-inline-block">
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
          <a href="/orders/create" class="btn btn-primary">New Order</a>
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
                text: 'New Order',
                action: function ( e, dt, node, config ) {
                    window.location = '/orders/create';
                }
              }
            ]
          }
        });
    });
  </script>
@endsection
