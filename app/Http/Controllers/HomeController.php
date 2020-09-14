<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index()
    {
    	$product=DB::table('tbl_products')
                        ->join('tbl_category','tbl_products.category_id','tbl_category.id')
                        ->join('tbl_manufacture','tbl_products.manufacture_id','tbl_manufacture.id')
                        ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                        ->where('tbl_products.publication_status','1')
                        ->limit('9')
                        ->get();
    	return view('pages.home_content',compact('product'));
    }

    public function category_by_product($id)
    {
        $category_by_product=DB::table('tbl_products')
                        ->join('tbl_category','tbl_products.category_id','tbl_category.id')
                        ->join('tbl_manufacture','tbl_products.manufacture_id','tbl_manufacture.id')
                        ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                        ->where('tbl_products.category_id',$id)
                        ->where('tbl_products.publication_status','1')
                        ->get();
        return view('pages.home_content_category_by_product',compact('category_by_product'));
    }

    public function product_by_brands($id)
    {
        $product_by_brands=DB::table('tbl_products')
                        ->join('tbl_category','tbl_products.category_id','tbl_category.id')
                        ->join('tbl_manufacture','tbl_products.manufacture_id','tbl_manufacture.id')
                        ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                        ->where('tbl_products.manufacture_id',$id)
                        ->where('tbl_products.publication_status','1')
                        ->get();
        return view('pages.home_content_product_by_brands',compact('product_by_brands'));
    }

    public function product_details($id)
    {
       $product_details=DB::table('tbl_products')
                        ->join('tbl_category','tbl_products.category_id','tbl_category.id')
                        ->join('tbl_manufacture','tbl_products.manufacture_id','tbl_manufacture.id')
                        ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                        ->where('tbl_products.id',$id)
                        ->first();
        return view('pages.product_details',compact('product_details')); 
    }
}
