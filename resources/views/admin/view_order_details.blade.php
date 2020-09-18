@extends('admin_layout')
@section('admin_content')
	<ul class="breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="index.html">Home</a> 
			<i class="icon-angle-right"></i>
		</li>
		<li>
			<a href="#">Order List</a>
			<i class="icon-angle-right"></i>
		</li>
		<li><a href="#">Order Deltails</a></li>
	</ul>

	<div class="row-fluid sortable">
		<div class="span4">
			<div class="box-header" data-original-title="">
				<h2><i class="halflings-icon user"></i><span class="break"></span>Customer Details</h2>
			</div>

			<div>
				<table class="table table-bordered">
				  <tr>
				    <th>Name</th>
				    <th>Phone</th>
				    <th>Email</th>
				  </tr>
				  @foreach($customer as $row)
				  <tr>
				    <td>{{ $row->name }}</td>
				    <td>{{ $row->phone }}</td>
				    <td>{{ $row->email }}</td>
				  </tr>
				  @endforeach
				  
				</table>
			</div>
		</div>

		<div class="span8">
			<div class="box-header" data-original-title="">
				<h2><i class="halflings-icon user"></i><span class="break"></span>Shipping Details</h2>
			</div>

			<div>
				<table class="table table-bordered">
				  <tr>
				    <th>Name</th>
				    <th>Phone</th>
				    <th>Address</th>
				    <th>City</th>
				  </tr>
				  @foreach($shipping as $row)
				  <tr>
				    <td>{{ $row->first_name.' '.$row->last_name}}</td>
				    <td>{{ $row->phone}}</td>
				    <td>{{ $row->address}}</td>
				    <td>{{ $row->city}}</td>
				  </tr>
				  @endforeach
				  
				</table>
			</div>
		</div>

		<div>
			<div class="box-header" data-original-title="">
				<h2><i class="halflings-icon user"></i><span class="break"></span>Product Details</h2>
			</div>

			<div>
				<table class="table table-bordered">
					<thead>
					  	<tr>
						    <th>Name</th>
						    <th>Price</th>
						    <th>Quantity</th>
						    <th>Subtotal</th>
					    </tr>
					</thead>
				  	@foreach($product as $row)
					  	<tbody>
					  		<tr>
							    <td>{{ $row->product_name }}</td>
							    <td>{{ $row->product_price }}</td>
							    <td>{{ $row->product_sales_quantity }}</td>
							    <td>{{ $row->product_price*$row->product_sales_quantity }}</td>
					  		</tr>
					  	</tbody>			
				  	@endforeach
				  	<tfoot>
					  	<tr>
					  		<td colspan="3">Total Price</td>
					  		<td><strong>= {{ $row->order_total }} TK</strong></td>
					  	</tr>
					</tfoot>
				  
				</table>
			</div>
		</div>
	</div><!--/row-->
@endsection