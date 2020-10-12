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
use App\PurchaseReceive;
use App\Serial;
use App\PartsStock;

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

    public function request_list(Request $request)
    {
        $data['locations']  = Location::all();
        $data['parts']      = Parts::all();
        $data['suppliers']  = Supplier::all();
        $data['purchases']  = Purchase::all();

        $query = PurchaseDetails::LeftJoin('purchases', 'purchases.id', '=', 'purchase_details.purchase_id')
                                ->LeftJoin('suppliers', 'suppliers.id', '=', 'purchases.supplier_id')
                                ->LeftJoin('locations', 'locations.id', '=', 'purchases.location_id')
                                ->LeftJoin('parts', 'parts.id', '=', 'purchase_details.parts_id')
                                ->LeftJoin('users', 'users.id', '=', 'purchases.create_by')
                                ->where('purchase_details.status', '!=', 2);
                                

        if(isset($_POST['supplier_id']) && $_POST['supplier_id']){
        //if($request->has('supplier_id')){
            $query->where('purchases.supplier_id', $_POST['supplier_id']);
        }else{
             $_POST['supplier_id'] = '';
        }

        if(isset($_POST['request_dates']) && $_POST['request_dates']){            
        //if($request->has('request_dates')){
            $string = explode(' - ', $_POST['request_dates']);
            $date1 = explode('/',$string[0]);
            $date2 = explode('/',$string[1]);
            $sDate = $date1[2].'-'.$date1[0].'-'.$date1[1];
            $eDate = $date2[2].'-'.$date2[0].'-'.$date2[1];

            $query->where('purchase_details.request_date' , '>=', $sDate)->where('purchase_details.request_date', '<=', $eDate);
        }else{
            $_POST['request_dates'] = '';
        }

        $data['purchase_details'] = $query->select('*', 'purchase_details.id as purchase_id', 'purchase_details.status as purchase_status')
                                            ->get();

        return view('purchase.request_list')->with('data', $data);

        //return redirect('purchase/request_list')->with('data', $data);
    }

    public function approved_list(DataTables $dataTable)
    {
        return view('purchase.approved_list');
    }

    public function approve_data(Request $request)
    {
        if ($request->ajax()) {

            $data = PurchaseDetails::LeftJoin('purchases', 'purchases.id', '=', 'purchase_details.purchase_id')
                        ->LeftJoin('suppliers', 'suppliers.id', '=', 'purchases.supplier_id')
                        ->LeftJoin('locations', 'locations.id', '=', 'purchases.location_id')
                        ->LeftJoin('parts', 'parts.id', '=', 'purchase_details.parts_id')
                        ->LeftJoin('users', 'users.id', '=', 'purchases.create_by')
                        ->where('purchase_details.status', '=', 2)
                        ->select('*', 'purchase_details.id as purchase_id', 'purchase_details.status as purchase_status')
                        ->get();

            //dmd($data->toArray());
            return Datatables::of($data)
                    ->addColumn('no', function ($result){
                        return '';
                    })
                    ->addColumn('Parts', function($data){
                        return $data->parts_name;
                    })
                    ->addColumn('Supplier', function($data){
                        return $data->supplier_name;
                    })
                    ->addColumn('Quantity', function($data){
                        return $data->quantity;
                    })
                    ->addColumn('Unit Price', function($data){
                        return $data->unit_price;
                    })
                    ->addColumn('Total Price', function($data){
                        return $data->total_price;
                    })
                    ->addColumn('Note', function ($data) {
                        $note = $data->parts_note;
                        $note .= '<br>'.$data->parts_note_1;
                        return $note;
                    })
                    // ->addColumn('action', function($row){

                    //         $output = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';     
                    //         return $output;
                    // })

                    ->rawColumns(['no', 'Note', 'Unit Price', 'Quantity', 'Total Price', 'Supplier', 'Parts'])
                    ->make(true);
        }
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
        $data['purchase_details'] = PurchaseDetails::LeftJoin('purchases', 'purchases.id', '=', 'purchase_details.purchase_id')
                        ->LeftJoin('suppliers', 'suppliers.id', '=', 'purchases.supplier_id')
                        ->LeftJoin('locations', 'locations.id', '=', 'purchases.location_id')
                        ->LeftJoin('parts', 'parts.id', '=', 'purchase_details.parts_id')
                        ->LeftJoin('users', 'users.id', '=', 'purchases.create_by')
                        ->where('purchase_details.status', '=', 2)
                        ->select('*', 'purchase_details.id as purchase_id', 'purchase_details.status as purchase_status')
                        ->get();
        //dmd($data['purchase_details']->toArray());

        return view('purchase.draft_challan')->with('data', $data);
    }

    public function challan_entry($request_id)
    {
        
        $data['locations']  = Location::all();
        $data['purchase_details'] = PurchaseDetails::LeftJoin('purchases', 'purchases.id', '=', 'purchase_details.purchase_id')
                        ->LeftJoin('suppliers', 'suppliers.id', '=', 'purchases.supplier_id')
                        ->LeftJoin('locations', 'locations.id', '=', 'purchases.location_id')
                        ->LeftJoin('parts', 'parts.id', '=', 'purchase_details.parts_id')
                        ->LeftJoin('users', 'users.id', '=', 'purchases.create_by')
                        ->where('purchase_details.id', '=', $request_id)
                        ->select('*', 'purchase_details.id as purchase_detail_id', 'purchases.id as purchase_id', 'purchase_details.status as purchase_status')
                        ->first();

        //dmd($data['purchase_details']->toArray(), $request_id);

        return view('purchase.challan_entry')->with('data', $data);
    }

    public function add_challan_entry(Request $request)
    {      

        $serial_ids = array();

        if(isset($_POST['serial']) && $_POST['serial'])
        {
            foreach ($_POST['serial'] as $key => $serial_no) {
                $serial = new Serial();
                $serial->parts_id = $request->get('parts_id');
                $serial->purchase_details_id = $request->get('purchase_details_id');
                $serial->supplier_id = $request->get('supplier_id');
                $serial->location_id = $request->get('rcv_location_id');
                $serial->serial_no = $serial_no;
                $serial->affect_date = date('Y-m-d H:i:s', strtotime($request->get('affect_date')));
                $serial->entry_by = $request->get('entry_by');
                $serial->save();

                $serial_ids[] = $serial->id;
            }
        }

        $purchase_rcv = new PurchaseReceive();

        $purchase_rcv->purchase_id = $request->get('purchase_id');
        $purchase_rcv->purchase_details_id = $request->get('purchase_details_id');
        $purchase_rcv->parts_id = $request->get('parts_id');
        $purchase_rcv->rcv_quantity = $request->get('rcv_quantity');
        $purchase_rcv->rcv_location_id = $request->get('rcv_location_id');
        $purchase_rcv->receive_note = $request->get('receive_note');
        $purchase_rcv->supplier_challan_no = $request->get('supplier_challan_no');
        $purchase_rcv->serial_ids = json_encode($serial_ids);
        $purchase_rcv->receive_date = date('Y-m-d H:i:s', strtotime($request->get('affect_date')));
        $purchase_rcv->received_by = $request->get('entry_by');

        if($purchase_rcv->save()){
           
            $purchase = PurchaseDetails::find($request->get('purchase_details_id'));
            $purchase->status = 3;
            $purchase->save();


            $stock = new PartsStock();

            $stock->parts_id = $request->get('parts_id');
            $stock->type = 1;
            $stock->quantity = $request->get('rcv_quantity');
            $stock->location_id = $request->get('rcv_location_id');
            $stock->purchase_id = $request->get('purchase_id');
            $stock->purchase_details_id = $request->get('purchase_details_id');
            $stock->purchase_rcv_id = $purchase_rcv->id;
            $stock->entry_date = date('Y-m-d H:i:s');
            $stock->affect_date = date('Y-m-d H:i:s', strtotime($request->get('affect_date')));
            $stock->entry_by = $request->get('entry_by');
            $stock->save();


            return redirect('purchase/challan')->with('success_message', 'Purchase Parts Entered Successfully');
            
        }else{
            return redirect()->back()->with('error_message', 'Failed to Save Parts Entry');
        }

        
    }

    public function parts()
    {
        if($request->ajax()){
            $parts_list = Parts::all();

            $options = "<option value=''> Parts/Accessories </option>";
            if($parts_list){
                foreach($parts_list as $parts){
                    $options .= "<option value = '$parts->id'>".$parts->parts_name."</option>";
                }
            }

            return response()->json(['status' => true, 'result' => $options]);
        }else{
            return redirect('cheque')->with('success_message', 'Cheque Addedd Successfully.');
        }
    }
}
