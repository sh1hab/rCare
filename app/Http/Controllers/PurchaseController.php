<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Purchase;

use Session;
use Hash;
use Auth;
use Validator;
use Redirect;
use DB;
use DataTables;

class PurchaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function request()
    {
        $data['locations'] = Location::all();
        $data['parts'] = Parts::all();
        $data['suppliers'] = Supplier::all();

        return view('purchase.request_create')->with('data', $data);
    }

    public function post_request(Request $request)
    {

        dmd($_POST);

        $input_rules['supplier_id'] = 'required';
        $input_rules['location_id'] = 'required';
        $input_rules['total_sum'] = 'required';
        $input_rules['grand_total'] = 'required';

        $validator = Validator::make($request->all(), $input_rules);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        $purchase = new Supplier();

        $purchase->supplier_id = $request->get('supplier_id'); 
        $purchase->location_id = $request->get('location_id');  
        $purchase->total_sum = $request->get('total_sum');
        $purchase->discount = $request->get('discount');
        $purchase->grand_total = $request->get('grand_total');
        $purchase->remarks = $request->get('remarks');
        $purchase->status = 1;
        $purchase->request_date = date('Y-m-d');
        $purchase->request_by = Auth::user()->id;
        $purchase->create_by = Auth::user()->id;
        $purchase->update_by = Auth::user()->id;

        if($purchase->save()){
            for ($i = 0; $i < $request->get('productsrowcount'); $i++) { 
                print_r($i);
                echo "<br>";
            }

            die('here');
            
            return redirect()->back()->with('success_message', 'Location Successfully Saved');
        }else{
            return redirect()->back()->with('error_message', 'Failed to Save Location');
        }

    }
}
