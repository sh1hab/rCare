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
use App\PurchaseDetails;

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
        //dmd($_POST);

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

        $purchase = new Purchase();

        $purchase->supplier_id = $request->get('supplier_id'); 
        $purchase->location_id = $request->get('location_id');  
        $purchase->total = $request->get('total_sum');
        $purchase->discount = $request->get('discount');
        $purchase->grand_total = $request->get('grand_total');
        $purchase->remarks = $request->get('remarks');
        $purchase->request_date = date('Y-m-d');
        $purchase->create_by = Auth::user()->id;
        $purchase->update_by = Auth::user()->id;

        if($purchase->save()){
            for ($i = 1; $i <= $request->get('productsrowcount'); $i++) { 
               
                $purchase_details = new PurchaseDetails();
 
                $purchase_details->purchase_id = $purchase->id; 
                $purchase_details->parts_id = $request->get('parts_id_'.$i);  
                $purchase_details->quantity = $request->get('quantity_'.$i);
                $purchase_details->unit_price = $request->get('price_'.$i);
                $purchase_details->total_price = $request->get('total_'.$i);
                $purchase_details->parts_note = $request->get('note_'.$i);
                $purchase_details->request_date = date('Y-m-d');
                $purchase_details->status = 1;
                $purchase_details->create_by = Auth::user()->id;
                $purchase_details->update_by = Auth::user()->id;
                $purchase_details->save();                
            }

            return redirect()->back()->with('success_message', 'Purchase Requestd Successfully');
            
        }else{
            return redirect()->back()->with('error_message', 'Failed to Save Location');
        }

    }

    public function request_list()
    {
        $data['locations']  = Location::all();
        $data['parts']      = Parts::all();
        $data['suppliers']  = Supplier::all();
        $data['purchases']  = Purchase::all();

        $data['purchase_details'] = PurchaseDetails::LeftJoin('purchases', 'purchases.id', '=', 'purchase_details.purchase_id')
                                ->LeftJoin('suppliers', 'suppliers.id', '=', 'purchases.supplier_id')
                                ->LeftJoin('locations', 'locations.id', '=', 'purchases.location_id')
                                ->LeftJoin('parts', 'parts.id', '=', 'purchase_details.parts_id')
                                ->LeftJoin('users', 'users.id', '=', 'purchases.create_by')
                                ->where('purchase_details.status', '!=', 2)
                                ->select('*', 'purchase_details.id as purchase_id', 'purchase_details.status as purchase_status')
                                ->get();

        //dmd($data['purchase_details']->toArray());

        return view('purchase.request_list')->with('data', $data);
    }

    public function request_status($id, $status)
    {
        $purchase_details = PurchaseDetails::find($id);
        $purchase_details->status = $status;
        if($purchase_details->save()){
            return redirect()->back()->with('success_message', 'Purchase Request Status Changed');
        }else{
            return redirect()->back()->with('error_message', 'Purchase Requestd Status Change Failed');
        }

    }

    public function add_note(Request $request)
    {
        $purchase_note = PurchaseDetails::find($request->get('purchase_id'));
        $purchase_note->parts_note_1 = $request->get('parts_note_1');
        $purchase_note->save();

        return redirect()->back()->with('success_message', 'Product Purchase Note Saved');
    }

    public function challan()
    {
        //die('here');
        $data['purchase_details'] = PurchaseDetails::LeftJoin('purchases', 'purchases.id', '=', 'purchase_details.purchase_id')
                        ->LeftJoin('suppliers', 'suppliers.id', '=', 'purchases.supplier_id')
                        ->LeftJoin('locations', 'locations.id', '=', 'purchases.location_id')
                        ->LeftJoin('parts', 'parts.id', '=', 'purchase_details.parts_id')
                        ->LeftJoin('users', 'users.id', '=', 'purchases.create_by')
                        ->where('purchase_details.status', '=', 2)
                        ->select('*', 'purchase_details.id as purchase_id', 'purchase_details.status as purchase_status')
                        ->get();

        return view('purchase.draft_challan')->with('data', $data);
    }
}
