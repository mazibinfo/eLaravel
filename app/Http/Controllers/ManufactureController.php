<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use Session;
Session_Start();

class ManufactureController extends Controller
{
    public function index()
    {
    	return view ('admin.add_manufacture');
    }

    public function add_manufacture(Request $request)
    {
    	$data=array();
    	$data['manufacture_name']=$request->manufacture_name;
    	$data['manufacture_description']=$request->manufacture_description;
    	$data['publication_status']=$request->publication_status;

    	DB::table('tbl_manufacture')->insert($data);

    	Session::put('message','Manufacture Added Successfully !!');
    	return Redirect::to('/all-manufacture');
    }

    public function all_manufacture()
    {
    	$manufacture=DB::table('tbl_manufacture')->get();
    	return view ('admin.all_manufacture',compact('manufacture'));
    }

    public function inactive_manufacture($id)
    {
    	DB::table('tbl_manufacture')
    				->where('id',$id)
    				->update(['publication_status' => 0]);
    	Session::put('message','Manufacture Inactive Successfully !!');
    	return Redirect::to('/all-manufacture');
    }

    public function active_manufacture($id)
    {
    	DB::table('tbl_manufacture')
    				->where('id',$id)
    				->update(['publication_status' => 1]);
    	Session::put('message','Manufacture active Successfully !!');
    	return Redirect::to('/all-manufacture');
    }

    public function edit_manufacture($id)
    {
        $manufacture=DB::table('tbl_manufacture')->where('id',$id)->first();
        return view ('admin.edit_manufacture',compact('manufacture'));
    }

    public function update_manufacture(Request $request,$id)
    {
        $data=array();
        $data['manufacture_name']=$request->manufacture_name;
        $data['manufacture_description']=$request->manufacture_description;

        DB::table('tbl_manufacture')->where('id',$id)->update($data);

        Session::put('message','Manufacture Updated Successfully !!');
        return Redirect::to('/all-manufacture');
    }

    public function delete_manufacture($id)
    {
        DB::table('tbl_manufacture')->where('id',$id)->delete();

        Session::put('message','Manufacture Deleted Successfully !!');
        return Redirect::to('/all-manufacture');
    }
}
