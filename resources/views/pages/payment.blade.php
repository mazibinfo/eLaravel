@extends('layout')
@section('content')
<section id="cart_items">
		<div class="containe col-sm-12">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>

			<?php
				$cartCollection = Cart::getContent();
				//dd($cartCollection);
			?>


			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="description">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
						</tr>
					</thead>
					<tbody>

						@foreach($cartCollection as $v_cartCollection)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to($v_cartCollection->attributes->image)}}" style="height: 60px; width: 80px;"	alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{ $v_cartCollection->name }}</a></h4>
							</td>
							<td class="cart_price">
								<p>{{ $v_cartCollection->price }} TK</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									
										<input class="cart_quantity_input" type="text" name="quantity" value="{{ $v_cartCollection->quantity }}" autocomplete="off" size="2">
										
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{ $v_cartCollection->getPriceSum() }} TK</p>
							</td>							
						</tr>
						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-8">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>{{Cart::getSubTotal()}} TK</span></li>
							<li>Eco Tax <span>00 TK</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>{{Cart::getTotal()}} TK</span></li>
						</ul>							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

	<section>
		<div class="paymentCont col-sm-12">
			<div class="headingWrap">
					<h3 class="headingTop text-center">Select Your Payment Method</h3>
					
			</div>
			<div class="paymentWrap">
				<form action="{{ URL::to('/order-place') }}" method="post">
				{{ csrf_field() }}

				@if (session('message'))
                    <li class="alert-danger">{{ session('message') }}</li>
                @endif							            
		            <input type="radio" name="payment_getway" value="handcash">Hand Cash<br> 
		            <input type="radio" name="payment_getway" value="debitcard">Debit Card<br>
		            <input type="radio" name="payment_getway" value="bkash">Bkash<br><br>
		            <input type="submit" name="" value="Done">
		        </form>
			</div>
		</div>
	</section>
@endsection