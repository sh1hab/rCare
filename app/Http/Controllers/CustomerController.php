<?php

namespace App\Http\Controllers;

use App\Role;
use App\Bank;
use App\Location;
use App\Service;
use App\Card;
use App\BankAccount;
use App\Category;
use App\Brand;
use App\AssetType;
use App\AssetHead;
use App\Warranty;
use App\Parts;
use App\Supplier;
use App\User;

use Session;
use Hash;
use Auth;
use Validator;
use Redirect;
use DB;
use DataTables;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function claim()
    {
        $data['users'] = User::all();
        $data['role'] = Role::all();
        $data['location'] = Location::all();
        $data['services'] = Service::all();

    	return view('customer.claim')->with('data', $data);
    }
}
