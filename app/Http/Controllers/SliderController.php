<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use Session;
Session_Start();

class SliderController extends Controller
{
    public function index()
    {
    	return view ('admin.add_slider');
    }

    public function add_slider(Request $request)
    {
    	$data=array();
    	$data['slider_name']=$request->slider_name;
    	$data['slider_description']=$request->slider_description;
    	$data['status']=$request->status;
    	
    	$image=$request->file('slider_image');
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
    	$data['slider_image']=$image_url;

    	DB::table('tbl_slider')->insert($data);

    	Session::put('message','Slider Added Successfully !!');
    	return Redirect::to('/add-slider');
    }

    public function all_slider()
    {
    	$slider=DB::table('tbl_slider')->get();
    	return view ('admin.all_slider',compact('slider'));
    }

    public function inactive_slider($id)
    {
    	DB::table('tbl_slider')
    				->where('id',$id)
    				->update(['status' => 0]);
    	Session::put('message','Slider Inactive Successfully !!');
    	return Redirect::to('/all-slider');
    }

    public function active_slider($id)
    {
    	DB::table('tbl_slider')
    				->where('id',$id)
    				->update(['status' => 1]);
    	Session::put('message','Slider active Successfully !!');
    	return Redirect::to('/all-slider');
    }

    public function delete_slider($id)
    {
        DB::table('tbl_slider')->where('id',$id)->delete();

        Session::put('message','Slider Deleted Successfully !!');
        return Redirect::to('/all-slider');
    }
}
