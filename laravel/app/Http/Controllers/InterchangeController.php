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
use App\Item;
use App\Parts;
use App\Supplier;
use App\User;
use App\PartsStockView;
use App\Interchange;
use App\InterchangeDetails;

use Session;
use Hash;
use Auth;
use Validator;
use Redirect;
use DB;
use DataTables;

class InterchangeController extends Controller
{
    public function request()
    {
    	$data['parts'] = Parts::where('status', 1)->get();
        $data['locations'] = Location::where('status', 1)->get();
    	return view('interchange.request_create')->with('data', $data);
    }

    public function request_create(Request $request)
    {
    	//dmd($_POST);

    	$input_rules['from_location_id'] = 'required';
        $input_rules['to_location_id'] = 'required';

        $validator = Validator::make($request->all(), $input_rules);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        $interchange = new Interchange();

        $interchange->ic_from = $request->get('from_location_id'); 
        $interchange->ic_to = $request->get('to_location_id');  
        $interchange->remarks = $request->get('remarks');  
        $interchange->request_date = date('Y-m-d H:i:s');
        $interchange->request_by =  Auth::user()->id;

        if($interchange->save()){

        	for ($i = 1; $i <= $request->get('partsrowcount'); $i++) { 
               
                $interchange_details = new InterchangeDetails();
 
                $interchange_details->interchange_id = $interchange->id; 
                $interchange_details->parts_id = $request->get('parts_id_'.$i);  
                $interchange_details->quantity = $request->get('quantity_'.$i);
                $interchange_details->request_date = date('Y-m-d H:i:s');
                $interchange_details->request_by = Auth::user()->id;
                $interchange_details->save();                
            }

                return redirect()->back()->with('success_message', 'Interchange Request Successfully Created');
        }else{
                return redirect()->back()->with('error_message', 'Failed to create new interchange request!!!');
        }
    }
}
