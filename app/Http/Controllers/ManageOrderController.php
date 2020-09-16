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
}
