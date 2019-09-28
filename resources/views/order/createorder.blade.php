@extends('layouts.main')

@section('meta')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
  <ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="/orders/create">Orders</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
  </ol>
  <div class="card">
  	<div class="card-header">Create Order</div>
  	<div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
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
                        <form class="add-item" data-itemid="{{ $item->id }}" method="post" action="{{ route('createorderpost') }}">
                          @csrf
                          <input name="orderdetails" type="hidden" value="{{ json_encode($orderdetails) }}" />
                          <input name="itemid" type="hidden" value="{{ $item->id }}" />
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
      <div id="order-details">
        <table class="table">
          <tbody>
            <tr>
              <th id="i">Item</th>
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
                      <input name="orderdetails" type="hidden" value="{{ json_encode($orderdetails) }}" />
                      <input name="edit" type="submit" value="Edit" />
                    </form>
                  </td>
                  <td>
                    <form method="post" action="{{ route('createorderpost') }}">
                      @csrf
                      <input name="orderdetailid" type="hidden" value="{{ $detail->id }}" />
                      <input name="orderdetails" type="hidden" value="{{ json_encode($orderdetails) }}" />
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
                  <input name="orderdetails" type="hidden" value="{{ json_encode($orderdetails) }}" />
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
              <input name="orderdetails" type="hidden" value="{{ json_encode($orderdetails) }}" />
            @endisset
          	<button name="submitorder" type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
  	</div>
  </div>
@endsection

@section('additional')
  {{-- I'll be coming back to this script later. There's a problem where the javascript keeps exiting because
  the form is being submitted while the ajax is trying is trying to run. --}}
  {{-- <script>
    $(document).ready(function(){

      // Item button pressed
      $(".add-item").submit(function(e) {

        e.preventDefault();

        var itemid = $(this).data('itemid');
        var orderdetails = '{{ json_encode($orderdetails) }}';
        var orderdetails = orderdetails.replace(/&quot;/g, '"');

        $.ajax({
          url: '/orders/ajaxRequest',
          type: 'POST',
          data: {
            'orderdetails': orderdetails,
            'itemid': itemid
          },
          success: function(data){
            console.log(orderdetails);
            console.log(itemid);
            console.log('Success');
          },
          error: function(xhr) {
             console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
           }
        });

      });

    });
  </script> --}}
@endsection
