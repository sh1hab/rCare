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

        $invoice_no = $this->create_invoice($request->get('location_id'));

        $claim = new CustomerClaim();

        $claim->rcv_no = 'CPR-'.$invoice_no['rcv_1'].''.$invoice_no['rcv_3'];
        $claim->rcv_no_1 = $invoice_no['rcv_1'];
        $claim->rcv_no_2 = $invoice_no['rcv_3'];
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

    public function create_invoice($location_id)
    {
        $no_1 = $no_2 = '';
        $inv_info = CustomerClaim::where('rcv_location_id', $location_id)
                                    ->where('rcv_no_1', '!=', '')
                                    ->orderBy('id', 'desc')
                                    ->first();      

        if($inv_info){
            $no_1 = $inv_info->rcv_no_1;
            $no_2 = $inv_info->rcv_no_2;
        }
        
        if($no_2 == '')
        {
            $rcv_1 = 'AA';
            $rcv_2 = 0;
        }
        else if($no_2 == 9999)
        {
            $rcv_1 = ++$no_1;
            $rcv_2 = 0;
        }
        else
        {
            $rcv_1 = $no_1;
            $rcv_2 = $no_2 + 1;
        }


        if($rcv_2 < 10)
        {
            $rcv_3 = '000'.$rcv_2;
        }
        else if($rcv_2 < 100)
        {
            $rcv_3 = '00'.$rcv_2;
        }
        else if($rcv_2 < 1000)
        {
            $rcv_3 = '0'.$rcv_2;
        }
        else
        {
            $rcv_3 = $rcv_2;
        }

        return $invoice = array('rcv_1' => $rcv_1, 'rcv_3' => $rcv_3);

    }

    public function claim_list()
    {
        return view('customer.claim_list');
    }

    public function claim_data(Request $request)
    {
        if ($request->ajax()) {

            $data = CustomerClaim::LeftJoin('locations', 'locations.id', '=', 'customer_claims.rcv_location_id')
                        ->LeftJoin('customers', 'customers.id', '=', 'customer_claims.customer_id')
                        ->LeftJoin('users as engineer', 'engineer.id', '=', 'customer_claims.engineer_id')
                        ->LeftJoin('services', 'services.id', '=', 'customer_claims.type_id')
                        ->LeftJoin('users as user', 'user.id', '=', 'customer_claims.received_by')
                        ->select('*', 'customer_claims.id as claim_id', 'customer_claims.status as claim_status', 'engineer.name as engineer_name', 'customer_claims.remarks as claim_remarks')
                        ->get();

            return Datatables::of($data)
                    ->editColumn('no', function ($data){
                        return '';
                    })
                    ->addColumn('rcv_no', function ($data){
                        return $data->rcv_no;
                    })
                    ->addColumn('claim_date', function ($data){
                        return date('d-m-Y', strtotime($data->claim_date));
                    }) 
                    ->addColumn('approx_date', function ($data){
                        return date('d-m-Y', strtotime($data->approx_date));
                    }) 
                    ->addColumn('claim_remarks', function($data){
                        return $data->claim_remarks;
                    })
                    // ->addColumn('Unit Price', function($data){
                    //     return $data->unit_price;
                    // })
                    // ->addColumn('Total Price', function($data){
                    //     return $data->total_price;
                    // })
                    // ->addColumn('Note', function ($data) {
                    //     $note = $data->parts_note;
                    //     $note .= '<br>'.$data->parts_note_1;

                    //     return $note;
                    // })
                    // ->addColumn('action', function($row){

                    //         $output = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';     
                    //         return $output;
                    // })

                    ->rawColumns(['no', 'approx_date', 'claim_date', 'rcv_no', 'claim_remarks'])
                    ->make(true);
        }
    }
}
