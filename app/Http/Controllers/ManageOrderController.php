<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use Session;
use Cart;
Session_Start();

class ManageOrderController extends Controller
{
    public function manage_order()
    {
    	$manage_order=DB::table('tbl_order')
				    		->join('tbl_customer','tbl_order.customer_id','tbl_customer.id')
				    		->select('tbl_order.*','tbl_customer.name')
				    		->get();
    	return view('admin.manage_order',compact('manage_order'));
    }

    public function view_order_details($id)
    {
    	$customer=DB::table('tbl_order')
    					->join('tbl_customer','tbl_order.customer_id','tbl_customer.id')
    					->where('tbl_order.id',$id)
    					->select('tbl_customer.name','tbl_customer.phone','tbl_customer.email')
    					->get();

    	$shipping=DB::table('tbl_order')
    					->join('tbl_shipping','tbl_order.shipping_id','tbl_shipping.id')
    					->where('tbl_order.id',$id)
    					->select('tbl_shipping.first_name','tbl_shipping.last_name','tbl_shipping.phone','tbl_shipping.address','tbl_shipping.city')
    					->get();

    	$product=DB::table('tbl_order')
    					->join('tbl_order_details','tbl_order.id','tbl_order_details.order_id')
    					->where('tbl_order.id',$id)
    					->select('tbl_order.order_total','tbl_order_details.product_name','tbl_order_details.product_price','tbl_order_details.product_sales_quantity')
    					->get();

    	return view('admin.view_order_details',compact('customer','shipping','product'));
    }
}
