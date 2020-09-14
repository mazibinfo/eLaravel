<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use Session;
Session_Start();

class CategoryController extends Controller
{
    public function index()
    {
    	return view ('admin.add_category');
    }

    public function all_category()
    {
    	$category=DB::table('tbl_category')->get();
    	return view ('admin.all_category',compact('category'));
    }

    public function add_category(Request $request)
    {
    	$data=array();
    	$data['category_name']=$request->category_name;
    	$data['category_description']=$request->category_description;
    	$data['publication_status']=$request->publication_status;

    	DB::table('tbl_category')->insert($data);

    	Session::put('message','Category Added Successfully !!');
    	return Redirect::to('/all-category');
    }

    public function inactive_category($id)
    {
    	DB::table('tbl_category')
    				->where('id',$id)
    				->update(['publication_status' => 0]);
    	Session::put('message','Category Inactive Successfully !!');
    	return Redirect::to('/all-category');
    }

    public function active_category($id)
    {
    	DB::table('tbl_category')
    				->where('id',$id)
    				->update(['publication_status' => 1]);
    	Session::put('message','Category active Successfully !!');
    	return Redirect::to('/all-category');
    }

    public function edit_category($id)
    {
        $category=DB::table('tbl_category')->where('id',$id)->first();
        return view ('admin.edit_category',compact('category'));
    }

    public function update_category(Request $request,$id)
    {
        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_description']=$request->category_description;

        DB::table('tbl_category')->where('id',$id)->update($data);

        Session::put('message','Category Updated Successfully !!');
        return Redirect::to('/all-category');
    }

    public function delete_category($id)
    {
        DB::table('tbl_category')->where('id',$id)->delete();

        Session::put('message','Category Deleted Successfully !!');
        return Redirect::to('/all-category');
    }
}
