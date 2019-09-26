@extends('layouts.main')

@section('content')
  <ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="/orders">Orders</a></li>
    <li class="breadcrumb-item active" aria-current="page">Show</li>
  </ol>
  <div class="card">
  	<div class="card-header">Information for Order {{ $order->id }}</div>
  	<div class="card-body">
      @if (session()->has('created'))
        <div class="alert alert-success" role="alert">Successfully created new Order</div>
      @endif
      @if (session()->has('updated'))
        <div class="alert alert-success" role="alert">Successfully updated Order</div>
      @endif
      <table class="table table-bordered" width="100%" cellspacing="0">
        <tbody>
          <tr>
            <th class="fit">User</th>
            <td>{{ $user->lastname }}, {{ $user->firstname }}</td>
          </tr>
          <tr>
            <th class="fit">Location</th>
            <td>{{ $location->name }}</td>
          </tr>
          <tr>
            <th class="fit">Complete</th>
            <td>{{ $order->complete }}</td>
          </tr>
          <tr>
            <th class="fit">Created</th>
            <td>{{ $order->created_at }}</td>
          </tr>
          <tr>
            <th class="fit">Last Updated</th>
            <td>{{ $order->updated_at }}</td>
          </tr>
        </tbody>
      </table>
      <div class="mt-5">
        <table id="table" class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <th>Item</th>
            <th>Price</th>
            <th>Note</th>
            <th>Complete</th>
            <th>Last Updated</th>
          </thead>
          <tbody>
            @foreach ($details as $detail)
              <tr>
                <td>{{ DB::table('inventory_items')->where('id', $detail->inventory_item_id)->value('name') }}</td>
                <td>{{ $detail->price }}</td>
                <td>{{ $detail->note }}</td>
                <td>{{ $detail->complete }}</td>
                <td>{{ $detail->updated_at }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  	</div>
  </div>
@endsection

@section('additional')
  <script>
    $(document).ready( function () {
        $('#table').DataTable({

        });
    });
  </script>
@endsection
