<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use Cart;

class CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
    	$qty=$request->qty;
    	$product_id=$request->product_id;

    	$product_info=DB::table('tbl_products')
    					->where('id',$product_id)
    					->first();
    	$data = [
    		'id'  		=> 		$product_id,
    		'name'		=> 		$product_info->product_name,
    		'price' 	=> 		$product_info->product_price,
    		'quantity'	=>		$qty,
    		'attributes'=> 		$image = [ 'image' => $product_info->product_image ]
    	];

    	Cart::add($data);
    	return Redirect::to('/show-cart');
    }

    public function show_cart()
    {
    	return view ('pages.add_to_cart');
    }

    public function delete_item($id)
    {
    	Cart::remove($id);    	
    	return Redirect::to('/show-cart');
    }

    public function update_cart(Request $request)
    {
        $quantity=$request->quantity;
        $id=$request->id;

        Cart::update($id, ['quantity' => [
                                            'relative' => false,
                                             'value' => $quantity
                                         ]
            ]);

        return Redirect::to('/show-cart');
    }
}