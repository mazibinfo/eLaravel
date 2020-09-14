<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use Session;
Session_Start();

class ProductController extends Controller
{
    public function index()
    {
    	$category=DB::table('tbl_category')->where('publication_status',1)->get();
    	$manufacture=DB::table('tbl_manufacture')->where('publication_status',1)->get();
    	return view ('admin.add_product',compact('category','manufacture'));
    }
    
    public function add_product(Request $request)
    {
    	$data=array();
    	$data['product_name']=$request->product_name;
    	$data['category_id']=$request->category_id;
    	$data['manufacture_id']=$request->manufacture_id;
    	$data['product_price']=$request->product_price;
    	$data['product_size']=$request->product_size;
    	$data['product_color']=$request->product_color;
    	$data['product_short_description']=$request->product_short_description;
    	$data['product_long_description']=$request->product_long_description;
    	$data['publication_status']=$request->publication_status;
    	
    	$image=$request->file('product_image');
        if ($image) {
            $ext = $image->extension();
            $image_name = $image->getClientOriginalName();
            $image_full_name=$image_name.'_'.date('Ymdhis').'.'.$ext;
            $upload_path='img/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
        }
        else{
            $image_url=null;    		
    	}
    	$data['product_image']=$image_url;

    	DB::table('tbl_products')->insert($data);

    	Session::put('message','Product Added Successfully !!');
    	return Redirect::to('/add-product');
    }

    public function all_product()
    {
        $product=DB::table('tbl_products')
                        ->join('tbl_category','tbl_products.category_id','tbl_category.id')
                        ->join('tbl_manufacture','tbl_products.manufacture_id','tbl_manufacture.id')
                        ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                        ->get();
        return view ('admin.all_product',compact('product'));
    }

    public function inactive_product($id)
    {
        DB::table('tbl_products')
                    ->where('id',$id)
                    ->update(['publication_status' => 0]);
        Session::put('message','Product Inactive Successfully !!');
        return Redirect::to('/all-product');
    }

    public function active_product($id)
    {
        DB::table('tbl_products')
                    ->where('id',$id)
                    ->update(['publication_status' => 1]);
        Session::put('message','Product active Successfully !!');
        return Redirect::to('/all-product');
    }

    public function edit_product($id)
    {
        $category=DB::table('tbl_category')->where('publication_status',1)->get();
        $manufacture=DB::table('tbl_manufacture')->where('publication_status',1)->get();
        $product=DB::table('tbl_products')
                        ->join('tbl_category','tbl_products.category_id','tbl_category.id')
                        ->join('tbl_manufacture','tbl_products.manufacture_id','tbl_manufacture.id')
                        ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name',)
                        ->where('tbl_products.id',$id)
                        ->first();
        return view ('admin.edit_product',compact('product','category','manufacture'));
    }

    public function update_product(Request $request,$id)
    {
        $data=array();
        $data['manufacture_name']=$request->manufacture_name;
        $data['manufacture_description']=$request->manufacture_description;

        DB::table('tbl_products')->where('id',$id)->update($data);

        Session::put('message','Manufacture Updated Successfully !!');
        return Redirect::to('/all-product');
    }

    public function delete_product($id)
    {
        DB::table('tbl_products')->where('id',$id)->delete();

        Session::put('message','Product Deleted Successfully !!');
        return Redirect::to('/all-product');
    }
}
