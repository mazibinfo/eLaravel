<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use Session;
Session_Start();

class SuperAdminController extends Controller
{
    public function logout()
    {
    	Session::flush();
    	return Redirect::to('/admin');
    }    
}
