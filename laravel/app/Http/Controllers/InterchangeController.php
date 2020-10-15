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
                $interchange_details->instant = (isset($_POST['instant_'.$i]) && $_POST['instant_'.$i])?$_POST['instant_'.$i]:0;
                $interchange_details->request_date = date('Y-m-d H:i:s');
                $interchange_details->request_by = Auth::user()->id;
                $interchange_details->save();                
            }

                return redirect()->back()->with('success_message', 'Interchange Request Successfully Created');
        }else{
                return redirect()->back()->with('error_message', 'Failed to create new interchange request!!!');
        }
    }

    public function request_to_others()
    {
        $data['interchange_details'] = InterchangeDetails::where('interchanges.ic_from', Auth::user()->location_id)
                                        ->Leftjoin('interchanges', 'interchanges.id', '=', 'interchange_details.interchange_id')
                                        ->Leftjoin('locations as from_location', 'from_location.id', '=', 'interchanges.ic_from')
                                        ->LeftJoin('locations as to_location', 'to_location.id', '=', 'interchanges.ic_to')
                                        ->LeftJoin('users', 'users.id', '=', 'interchanges.request_by')
                                        ->LeftJoin('parts', 'parts.id', '=', 'interchange_details.parts_id')
                                        ->select('*', 'interchange_details.id as id', 'from_location.location_short_name as from_loc', 'to_location.location_short_name as to_loc', 'users.username as request_user')
                                        ->get();
                                        //->toArray();

        //dmd($data['interchange_details']);
        return view('interchange.request_to_others')->with('data', $data);
    }


    public function request_to_me()
    {
        $data['interchange_details'] = InterchangeDetails::where('interchanges.ic_to', Auth::user()->location_id)
                                        ->Leftjoin('interchanges', 'interchanges.id', '=', 'interchange_details.interchange_id')
                                        ->Leftjoin('locations as from_location', 'from_location.id', '=', 'interchanges.ic_from')
                                        ->LeftJoin('locations as to_location', 'to_location.id', '=', 'interchanges.ic_to')
                                        ->LeftJoin('users', 'users.id', '=', 'interchanges.request_by')
                                        ->LeftJoin('parts', 'parts.id', '=', 'interchange_details.parts_id')
                                        ->select('*', 'interchange_details.id as id', 'from_location.location_short_name as from_loc', 'to_location.location_short_name as to_loc', 'users.username as request_user')
                                        ->get();
                                        //->toArray();

        //dmd($data['interchange_details']);
        return view('interchange.request_to_me')->with('data', $data);
    }
}
