<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use Session;
Session_Start();

class CheckoutController extends Controller
{
    public function login_check()
    {
    	return view ('pages.login');
    }

    public function customer_registration(Request $request)
    {
    	$data = [
    		'name' => $request->name,
    		'phone' => $request->phone,
    		'email' => $request->email,
    		'password' => md5($request->password)
    	];

    	$customer_id=DB::table('tbl_customer')->InsertGetId($data);

    	$customers_id=Session::put('customer_id',$customer_id);
    	$name=Session::put('name',$request->name);

    	return Redirect::to('/checkout');
    }

    public function checkout()
    {
    	return view ('pages.checkout');
    }

    public function save_shipping_details(Request $request)
    {
        $data=[
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city
        ];

        $shipping_id=DB::table('tbl_shipping')->InsertGetId($data);
        Session::put('shipping_id',$shipping_id);
        return Redirect::to('/payment');        
    }

    public function payment()
    {
        return view ('pages.payment');
    }

    public function order_place(Request $request)
    {
        $payment_getway=$request->payment_getway;
        $shipping_id=Session::get('shipping_id');
        $customer_id=Session::get('customer_id');
        dd($payment_getway,$shipping_id,$customer_id);
    }

    public function customer_login(Request $request)
    {
        $email=$request->email;
        $password=md5($request->password);

        $result=DB::table('tbl_customer')->where('email',$email)->where('password',$password)->first();

        
        if ($result) {
            Session::put('customer_id',$result->id);
            return Redirect::to('/checkout');
        }else{
            return redirect()->back()->with('errors', 'Invalid Email or Password !!!');
        }        
    }

    public function customer_logout()
    {
        Session::flush();
        return Redirect::to('/');
    }
}
