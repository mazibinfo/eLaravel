@extends('layout')
@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check Out</li>
				</ol>
			</div><!--/breadcrums-->			

			<div class="register-req">
				<p>Please fill the form........</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">					
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Shipping Details</p>
							<div class="form-one">
								<form action="{{URL::to('/save-shipping-details')}}" method="post">
									{{ csrf_field() }}
									<input type="text" name="first_name" placeholder="First Name">
									<input type="text" name="last_name" placeholder="Last Name">
									<input type="text" name="email" placeholder="Email">
									<input type="text" name="phone" placeholder="Mobile Number">
									<input type="text" name="address" placeholder="Address">
									<input type="text" name="city" placeholder="City">
									<button type="submit" class="btn btn-default">Done</button>
								</form>
							</div>							
						</div>
					</div>					
				</div>
			</div>
		</div>			
	</section> <!--/#cart_items-->
@endsection