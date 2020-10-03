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
use App\CustomerClaim;
use App\Customer;

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
        $data['users'] = User::where('user_role_id', 3)->get();
        $data['role'] = Role::all();
        $data['location'] = Location::all();
        $data['services'] = Service::all();

    	return view('customer.claim')->with('data', $data);
    }

    public function add_claim(Request $request)
    {

    	//dmd($_POST);

    	$input_rules['location_id'] = 'required';
    	$input_rules['service_type_id'] = 'required';
        $input_rules['invoice_no'] = 'required';
        $input_rules['invoice_date'] = 'required';
        $input_rules['customer_name'] = 'required';
        $input_rules['customer_mobile'] = 'required';
        $input_rules['engineer_id'] = 'required';
        $input_rules['product_old'] = 'required';
        $input_rules['serial_old'] = 'required';
        $input_rules['problem_details'] = 'required';
        $input_rules['claim_date'] = 'required';
        $input_rules['approx_date'] = 'required';

        $validator = Validator::make($request->all(), $input_rules);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        $customer = Customer::where('customer_mobile', $request->get('customer_mobile'))->first();

        if(!$customer){
        	$customer = new Customer();
	        $customer->customer_name = $request->get('customer_name');
	        $customer->customer_mobile = $request->get('customer_mobile');
	        $customer->customer_email = $request->get('customer_email');
	        $customer->customer_address = $request->get('customer_address');
	        $customer->create_by = Auth::user()->id;
	        $customer->save();
        }

        $claim = new CustomerClaim();

        $claim->rcv_no = 'RCL'; //$request->get('rcv_no');
        $claim->rcv_no_1 = 'RCV'; //$request->get('rcv_no_1');
        $claim->rcv_no_2 = 'RCV'; //$request->get('rcv_no_2');
        $claim->rcv_location_id = $request->get('location_id');
        //$claim->current_location_id = $request->get('current_location_id');
        //$claim->rcom = $request->get('rcom');
        $claim->invoice_no = $request->get('invoice_no');
        $claim->invoice_date = date('Y-m-d H:i:s', strtotime($request->get('invoice_date')));
        $claim->customer_id = $customer->id;
        $claim->engineer_id = $request->get('engineer_id');
        $claim->type_id = $request->get('service_type_id');
        $claim->product_old = $request->get('product_old');
        $claim->serial_old = $request->get('serial_old');
        $claim->product_details = $request->get('product_details');
        $claim->problem_details = $request->get('problem_details');
        $claim->remarks = $request->get('remarks');
        $claim->claim_date = date('Y-m-d H:i:s', strtotime($request->get('claim_date')));
        $claim->approx_date = date('Y-m-d H:i:s', strtotime($request->get('approx_date')));
        $claim->status = 1;
        $claim->received_by = Auth::user()->id;
        $claim->checked_by = Auth::user()->id;
        $claim->update_by = Auth::user()->id;

        if($claim->save()){
            return redirect()->back()->with('success_message', 'Customer Claim Added Successfully');
        }else{
            return redirect()->back()->with('error_message', 'Customer Claim Add Failed');
        }
    }

    public function check_customer(Request $request)
    {
    	if(isset($_POST['mobile'])){
        	$customer = Customer::where('customer_mobile', $request->get('mobile'))->first();
        }

        if($customer){
            return response()->json(['status' => true, 'msg' => 'Old/Valuable Customer of RCL']);
        }
        return response()->json(['status' => false, 'msg' => 'New Customer']);
    }
}
