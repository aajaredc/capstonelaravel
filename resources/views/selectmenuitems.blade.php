@extends('layouts.main')

@section('content')
  <ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="#">Menu</a></li>
  	<li class="breadcrumb-item"><a href="#">Menu Items</a></li>
  	<li class="breadcrumb-item active">Select</li>
  </ol>
  <div class="card">
  	<div class="card-header">Select Menu Items</div>
  	<div class="card-body">
  		<div class="table-responsive">
  			<table class="table table-bordered" id="selectmenuitemsTable" width="100%" cellspacing="0">
  				<thead>
  					<tr>
  						<th>Name</th>
  						<th>Type</th>
  						<th>Price</th>
  						<th>Count</th>
  						<th>Description</th>
  					</tr>
  				</thead>
  				<tbody>
            <tr>
              <td>Orange</td>
              <td>General</td>
              <td>$1.00</td>
              <td>1</td>
              <td>You're not Alexander</td>
            </tr>
            <tr>
              <td>Orange</td>
              <td>General</td>
              <td>$1.00</td>
              <td>1</td>
              <td>You're not Alexander</td>
            </tr>
  				</tbody>
  			</table>
  		</div>
  	</div>
  </div>
@endsection

@section('additional')
  <script>
    $(document).ready( function () {
        $('#selectmenuitemsTable').DataTable();
    });
  </script>
@endsection
