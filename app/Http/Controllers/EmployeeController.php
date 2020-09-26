<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function  permission()
    {
    	return view('setup.permission');
    }
}
