@extends('layouts.main')

@section('content')
  <ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="/orders/create">Orders</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
  </ol>
  <div class="card">
  	<div class="card-header">Create Order</div>
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
      <div id="order-menu">
        <div class="row">
          @foreach ($types as $type)
            <div class="col-12 col-md-2">
              <table class="w-100">
                <thead>
                  <th>{{ $type->name }}</th>
                </thead>
                <tbody>
                  @foreach ($items->where('inventory_type_id', $type->id) as $item)
                    <tr>
                      <td>
                        <form method="post" action="{{ route('createorderpost') }}">
                          @csrf
                          @if (isset($orderitems))
                            <input name="inventoryitems" type="hidden" value="{{ json_encode($orderitems, TRUE)}}" />
                          @endif
                          <input name="inventoryitem" type="hidden" value="{{ $item->id }}" />
                          <input class="w-100" type="submit" value="{{ $item->name }}"
                            @if ((isset($itemOccurences[$item->id]) && ($itemOccurences[$item->id] >= $item->count)) || $item->count <= 0)
                              disabled="true"
                            @endif
                          />
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endforeach
        </div>
      </div>
  	</div>
  </div>

  <!-- Order Details -->
  <div class="card mt-3">
  	<div class="card-header">Order Details</div>
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
      <div id="order-details">
        <table class="table">
          <tbody>
            <tr>
              <th>Item</th>
              <th>Price</th>
              <th>Notes</th>
              <th class="fit"></th>
              <th class="fit"></th>
            </tr>
            @isset($orderdetails)
              @foreach ($orderdetails as $detail)
                <tr>
                  <td>{{ \DB::table('inventory_items')->where('id', $detail->inventory_item_id)->value('name') }}</td>
                  <td>{{ $detail->price }}</td>
                  <td>{{ $detail->note }}</td>
                  <td>
                    <form method="post" action="{{ route('createorderpost') }}">
                      @csrf
                      <input name="orderdetailid" type="hidden" value="{{ $detail->id }}" />
                      <input name="inventoryitems" type="hidden" value="{{ json_encode($orderitems)}}" />
                      <input name="edit" type="submit" value="Edit" />
                    </form>
                  </td>
                  <td>
                    <form method="post" action="{{ route('createorderpost') }}">
                      @csrf
                      <input name="orderdetailid" type="hidden" value="{{ $detail->id }}" />
                      <input name="inventoryitems" type="hidden" value="{{ json_encode($orderitems)}}" />
                      <input name="deletesubmit" type="submit" value="Delete" />
                    </form>
                  </td>
                </tr>
              @endforeach
            @endisset
            <tr>
              <th>Total</th>
              <th>$$$</th>
              <th> </th>
              <th> </th>
              <th> </th>
            </tr>
          </tbody>
        </table>

        @isset($_POST['edit'])
          <form method="POST" action="{{ route('createorderpost') }}" class="mt-4">
            @csrf
            <table class="table">
              <tbody>
                <tr>
                  <th class="fit">Price</th>
                  <td>
                    <div class="input-group">
                    	<div class="input-group-prepend">
                    		<div class="input-group-text">$</div>
                    	</div>
                    	<input name="price" type="text" value="{{ $orderdetails[$_POST['orderdetailid']]->price }}">
                    </div>
                  </td>
                </tr>
                <tr>
                  <th class="fit">Note</th>
                  <td>
                    <input type="text" name="note" placeholder="Note" value="{{ $orderdetails[$_POST['orderdetailid']]->note }}"/>
                  </td>
                </tr>
              </tbody>
              <tr>
                <td>
                  <input type="hidden" name="orderdetailid" value="{{ $_POST['orderdetailid'] }}"/>
                  <input name="inventoryitems" type="hidden" value="{{ json_encode($orderitems)}}" />
                  <input type="submit" name="editsubmit" value="Save"/>
                </td>
              </tr>
            </table>
          </form>
        @endisset
        <div>
          <form name="ordersubmitform" method="post" action="{{ route('storeorder') }}">
            @csrf
          	@isset($orderdetails)
              <input name="orderdetails" value="{{ json_encode($orderdetails) }}" type="hidden">
            @endisset
          	<button name="submitorder" type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
  	</div>
  </div>
@endsection

@section('additional')

@endsection
