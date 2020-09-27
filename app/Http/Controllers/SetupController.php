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

use Session;
use Hash;
use Auth;
use Validator;
use Redirect;
use DB;
use DataTables;

class SetupController extends Controller
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

    public function dashboard()
    {
        //dmd(Auth::user());
        return view('home');
    }

    public function bank()
    {
        $data['bank'] = Bank::all();
        return view('setup.bank')->with('data', $data);
    }

    public function add_bank(Request $request)
    {

        $input_rules['short_name'] = 'required';
        $input_rules['full_name'] = 'required';
        $input_rules['status'] = 'required';

        $validator = Validator::make($request->all(), $input_rules);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        if(isset($_POST['bank_id']) && $_POST['bank_id'])
            $bank = Bank::find($request->get('bank_id'));
        else
            $bank = new Bank();

        $bank->short_name = $request->get('short_name'); 
        $bank->full_name = $request->get('full_name');  
        $bank->opening_balance = $request->get('opening_balance');  
        $bank->remarks = $request->get('remarks');
        $bank->status = $request->get('status');
        $bank->create_by = Auth::user()->id;
        $bank->update_by = Auth::user()->id;

        if($bank->save()){
                return redirect()->back()->with('success_message', 'Bank Successfully Created');
        }else{
                return redirect()->back()->with('error_message', 'Failed to create new bank!!!');
        }

    }

    public function location()
    {
        $data['location'] = Location::all();
        return view('setup.location')->with('data', $data);
    }

    public function add_location(Request $request)
    {

        $input_rules['location_name'] = 'required';
        $input_rules['location_short_name'] = 'required';
        $input_rules['location_details'] = 'required';
        $input_rules['location_type'] = 'required';
        $input_rules['location_status'] = 'required';

        $validator = Validator::make($request->all(), $input_rules);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        if(isset($_POST['location_id']) && $_POST['location_id'])
            $location = Location::find($request->get('location_id'));
        else
            $location = new Location();

        $location->location_name = $request->get('location_name'); 
        $location->location_short_name = $request->get('location_short_name');  
        $location->location_details = $request->get('location_details');  
        $location->location_type = $request->get('location_type');
        $location->location_opening_balance = $request->get('location_opening_balance');
        $location->location_status = $request->get('location_status');
        $location->create_by = Auth::user()->id;
        $location->update_by = Auth::user()->id;

        if($location->save()){
            return redirect()->back()->with('success_message', 'Location Successfully Saved');
        }else{
            return redirect()->back()->with('error_message', 'Failed to Save Location');
        }

    }

    public function category()
    {
        $data['category'] = Category::all();
        return view('setup.category')->with('data', $data);
    }

    public function add_category(Request $request)
    {

        $input_rules['category_name'] = 'required';
        $input_rules['category_code'] = 'required';

        $validator = Validator::make($request->all(), $input_rules);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        if(isset($_POST['category_id']) && $_POST['category_id'])
            $category = Category::find($request->get('category_id'));
        else
            $category = new Category();

        $category->category_name = $request->get('category_name'); 
        $category->category_code = $request->get('category_code');  
        $category->category_details = $request->get('category_details');  
        $category->serial = $request->get('serial');
        $category->status = $request->get('status');
        $category->create_by = Auth::user()->id;
        $category->update_by = Auth::user()->id;

        if($category->save()){
            return redirect()->back()->with('success_message', 'Category Successfully Saved');
        }else{
            return redirect()->back()->with('error_message', 'Failed to Save Category');
        }
    }

    public function check_category_code(Request $request)
    {
        $code = Category::where('category_code', $_POST['code'])->first();

        if(isset($code)){
            return response()->json(['status' => true]);
        }else{
            return response()->json(['status' => false]);
        }
    }

    public function brand()
    {
        $data['brand'] = Brand::all();
        //dmd($data['brand']);
        $data['categories'] = Category::all();

        return view('setup.brand')->with('data', $data);
    }

    public function add_brand(Request $request)
    {

        $input_rules['brand_name'] = 'required';
        $input_rules['brand_code'] = 'required';
        $input_rules['categories'] = 'required';

        $validator = Validator::make($request->all(), $input_rules);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        if(isset($_POST['brand_id']) && $_POST['brand_id'])
            $brand = Brand::find($request->get('brand_id'));
        else
            $brand = new Brand();

        $brand->brand_name = $request->get('brand_name'); 
        $brand->brand_code = $request->get('brand_code');  
        $brand->brand_details = $request->get('brand_details');  
        $brand->categories = json_encode($request->get('categories'));
        $brand->status = $request->get('status');
        $brand->create_by = Auth::user()->id;
        $brand->update_by = Auth::user()->id;

        if($brand->save()){
            return redirect()->back()->with('success_message', 'Brand Successfully Saved');
        }else{
            return redirect()->back()->with('error_message', 'Failed to Save Brand');
        }
    }

    public function check_brand_code(Request $request)
    {
        $code = Brand::where('brand_code', $_POST['code'])->first();

        if(isset($code)){
            return response()->json(['status' => true]);
        }else{
            return response()->json(['status' => false]);
        }
    }

    public function bank_account()
    {
        $data['bank_account'] = BankAccount::all();
        $data['bank'] = Bank::all();
        return view('setup.bank_account')->with('data', $data);
    }


    public function add_bank_account(Request $request)
    {
        $input_rules['account_number'] = 'required';
        $input_rules['bank_id'] = 'required';
        $input_rules['branch_name'] = 'required';
        $input_rules['route_number'] = 'required';
        $input_rules['status'] = 'required';

        $validator = Validator::make($request->all(), $input_rules);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        if(isset($_POST['bank_account_id']) && $_POST['bank_account_id'])
            $bank_account = BankAccount::find($request->get('bank_account_id'));
        else
            $bank_account = new BankAccount();

        $bank_account->account_number = $request->get('account_number'); 
        $bank_account->bank_id = $request->get('bank_id');  
        $bank_account->branch_name = $request->get('branch_name');  
        $bank_account->route_number = $request->get('route_number');
        $bank_account->opening_balance = $request->get('opening_balance');
        $bank_account->remarks = $request->get('remarks');
        $bank_account->status = $request->get('status');
        $bank_account->create_by = Auth::user()->id;
        $bank_account->update_by = Auth::user()->id;

        if($bank_account->save()){
            return redirect()->back()->with('success_message', 'Bank Account Successfully Saved');
        }else{
            return redirect()->back()->with('error_message', 'Failed to Save Bank Account');
        }
    }

    public function card()
    {
        $data['card'] = Card::all();
        return view('setup.card')->with('data', $data);
    }

    public function add_card(Request $request)
    {

        $input_rules['card_name'] = 'required';
        $input_rules['status'] = 'required';

        $validator = Validator::make($request->all(), $input_rules);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        if(isset($_POST['card_id']) && $_POST['card_id'])
            $card = Card::find($request->get('card_id'));
        else
            $card = new Card();

        $card->card_name = $request->get('card_name');
        $card->create_by = Auth::user()->id;
        $card->update_by = Auth::user()->id;
        $card->status = $request->get('status');  

        if($card->save()){
            return redirect()->back()->with('success_message', 'Card Successfully Saved');
        }else{
            return redirect()->back()->with('error_message', 'Failed to Save Card');
        }

    }

    public function asset()
    {
        $data['asset_type'] = AssetType::all();
        $data['asset_head'] = AssetHead::all();

        return view('setup.asset')->with('data', $data);
    }

    public function asset_type(Request $request)
    {
        $input_rules['asset_type'] = 'required';
        $validator = Validator::make($request->all(), $input_rules);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        if(isset($_POST['asset_type_id']) && $_POST['asset_type_id'])
            $asset_type = AssetType::find($request->get('asset_type_id'));
        else
            $asset_type = new AssetType();

        $asset_type->asset_type = $request->get('asset_type');
        $asset_type->status = $request->get('status');
        $asset_type->create_by = Auth::user()->id;
        $asset_type->update_by = Auth::user()->id;

        if($asset_type->save()){
            return redirect()->back()->with('success_message', 'Asset Type Successfully Saved');
        }else{
            return redirect()->back()->with('error_message', 'Failed to Save Asset Type');
        }

    }

    public function asset_head(Request $request)
    {
        $input_rules['asset_type'] = 'required';
        $input_rules['asset_head'] = 'required';

        $validator = Validator::make($request->all(), $input_rules);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        if(isset($_POST['asset_head_id']) && $_POST['asset_head_id'])
            $asset_head = AssetHead::find($request->get('asset_head_id'));
        else
            $asset_head = new AssetHead();

        $asset_head->asset_type_id = $request->get('asset_type');
        $asset_head->asset_head = $request->get('asset_head');
        $asset_head->status = $request->get('status');
        $asset_head->create_by = Auth::user()->id;
        $asset_head->update_by = Auth::user()->id;

        if($asset_head->save()){
            return redirect()->back()->with('success_message', 'Asset Head Successfully Saved');
        }else{
            return redirect()->back()->with('error_message', 'Failed to Save Asset Head');
        }

    }

    public function parts_accessories()
    {
        $data['category'] = Category::all();
        $data['brand'] = Brand::all();
        $data['warranties'] = Warranty::all();
        $data['parts'] = Parts::all();

        return view('setup.parts_accessories')->with('data', $data);
    }

    public function add_parts_accessoris(Request $request)
    {

        //dmd($_POST);

        $input_rules['category_id'] = 'required';
        $input_rules['compatible_brand_id'] = 'required';
        $input_rules['parts_name'] = 'required';
        $input_rules['avg_price'] = 'required';
        $input_rules['margin'] = 'required';
        $input_rules['sales_price'] = 'required';
        $input_rules['warranty_id'] = 'required';

        $validator = Validator::make($request->all(), $input_rules);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        $parts_number = 0;
        $parts_number = Parts::max('parts_number');
        $parts_number++;

        $category_code  = Category::where('id', $_POST['category_id'])->value('category_code');
        $brand_code  = Brand::where('id', $_POST['category_id'])->value('brand_code');

        $parts_code = $parts_number;
        if($parts_code < 10){
            $parts_code = '000'.$parts_code;
        }
        else if($parts_code < 100){
            $parts_code = '00'.$parts_code;
        }
        else if($parts_code < 1000){
            $parts_code = '0'.$parts_code;
        }

        $full_code = $category_code.'.'.$brand_code.'.'.$parts_code;

        if(isset($_POST['parts_id']) && $_POST['parts_id'])
            $parts = Parts::find($request->get('parts_id'));
        else
            $parts = new Parts();

        $parts->category_id = $request->get('category_id');
        $parts->compatible_brand_id = $request->get('compatible_brand_id');
        $parts->parts_number = $parts_number;
        $parts->parts_code = $parts_code;
        $parts->full_code = $full_code;
        $parts->parts_name = $request->get('parts_name');
        $parts->details = $request->get('details');
        $parts->avg_price = $request->get('avg_price');
        $parts->margin = $request->get('margin');
        $parts->sales_price = $request->get('sales_price');
        $parts->warranty_id = $request->get('warranty_id');
        $parts->status = $request->get('status');
        $parts->create_by = Auth::user()->id;
        $parts->update_by = Auth::user()->id;

        if($parts->save()){
            return redirect()->back()->with('success_message', 'Parts/Accessories Successfully Saved');
        }else{
            return redirect()->back()->with('error_message', 'Failed to Save Parts/Accessories');
        }
    }

    public function warranty()
    {
        $data['warranties'] = Warranty::all();
        return view('setup.warranty')->with('data', $data);
    }

    public function permission()
    {
        $data['permission'] = '';
        return view('setup.permission')->with('data', $data);
    }

    public function add_warranty(Request $request)
    {
        $input_rules['warranty_period'] = 'required'; 

        $validator = Validator::make($request->all(), $input_rules);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        if(isset($_POST['warranty_id']) && $_POST['warranty_id'])
            $warranty = Warranty::find($request->get('warranty_id'));
        else
            $warranty = new Warranty();

        $warranty->warranty_period = $request->get('warranty_period'); 
        $warranty->status = $request->get('status');  

        if($warranty->save()){
            return redirect()->back()->with('success_message', 'Warranty Period  Successfully Saved');
        }else{
            return redirect()->back()->with('error_message', 'Failed to Save Warranty Period');
        }

    }

    public function check_parts_name(Request $request)
    {
        $code = Brand::where('brand_code', $_POST['code'])->first();

        if(isset($code)){
            return response()->json(['status' => true]);
        }else{
            return response()->json(['status' => false]);
        }
    }

    public function employee_role(Request $request)
    {
        // if ($request->ajax()) {
        //     $data = Role::all();
        //     return Datatables::of($data)
        //             ->addIndexColumn()
        //             ->editColumn('Status', function ($data) {
        //                 if($data->status == 1){
        //                     $output = 'Active';
        //                 }else{
        //                     $output = 'Inactive';
        //                 }
        //                 return $output;
        //             })
        //             ->addColumn('action', function($row){

        //                     $output = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';     
        //                     return $output;
        //             })

        //             ->rawColumns(['action'])
        //             ->make(true);
        // }

        $data['role'] = Role::all();
        return view('setup.employee_role')->with('data', $data);
    }

    public function add_role(Request $request)
    {
        $input_rules['role_name'] = 'required'; 

        $validator = Validator::make($request->all(), $input_rules);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        if(isset($_POST['role_id']) && $_POST['role_id'])
            $role = Role::find($request->get('role_id'));
        else
            $role = new Role();

        $role->role_name = $request->get('role_name'); 
        $role->status = $request->get('status');  

        if($role->save()){
            return redirect()->back()->with('success_message', 'Role Successfully Saved');
        }else{
            return redirect()->back()->with('error_message', 'Failed to Save Role');
        }

    }

    public function supplier()
    {
        $data['supplier'] = Supplier::all();
        return view('setup.supplier')->with('data', $data);
    }


    public function add_supplier(Request $request)
    {

        $input_rules['supplier_name'] = 'required';
        $input_rules['supplier_contact'] = 'required';

        $validator = Validator::make($request->all(), $input_rules);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        if(isset($_POST['supplier_id']) && $_POST['supplier_id'])
            $supplier = Supplier::find($request->get('supplier_id'));
        else
            $supplier = new Supplier();

        $supplier->supplier_name = $request->get('supplier_name');
        $supplier->supplier_contact = $request->get('supplier_contact');
        $supplier->supplier_address = $request->get('supplier_address');
        $supplier->opening_amount = $request->get('opening_amount');
        $supplier->create_by = Auth::user()->id;
        $supplier->update_by = Auth::user()->id;
        $supplier->status = $request->get('status');  

        if($supplier->save()){
            return redirect()->back()->with('success_message', 'Supplier Successfully Saved');
        }else{
            return redirect()->back()->with('error_message', 'Failed to Save Supplier');
        }

    }

    public function service()
    {
        $data['service'] = Service::all();
        return view('setup.service')->with('data', $data);
    }


    public function add_service(Request $request)
    {

        $input_rules['service_name'] = 'required';
        $input_rules['service_details'] = 'required';

        $validator = Validator::make($request->all(), $input_rules);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        if(isset($_POST['service_id']) && $_POST['service_id'])
            $service = Service::find($request->get('service_id'));
        else
            $service = new Service();

        $service->service_name = $request->get('service_name');
        $service->service_details = $request->get('service_details');
        $service->create_by = Auth::user()->id;
        $service->update_by = Auth::user()->id;
        $service->status = $request->get('status');  

        if($service->save()){
            return redirect()->back()->with('success_message', 'Service Successfully Saved');
        }else{
            return redirect()->back()->with('error_message', 'Failed to Save Service');
        }

    }

    public function users()
    {
        $data['users'] = User::all();
        $data['role'] = Role::all();
        $data['location'] = Location::all();
        $data['users'] = User::all();

        return view('setup.user_list')->with('data', $data);
    }

    public function add_user()
    {
        $data['users'] = User::all();
        $data['role'] = Role::all();
        $data['location'] = Location::all();
        $data['users'] = User::all();

        return view('setup.user')->with('data', $data);
    }

    public function post_add_user(Request $request)
    {

        $input_rules['user_name'] = 'required';
        $input_rules['designation'] = 'required';
        $input_rules['contact_no'] = 'required';
        $input_rules['rs_id'] = 'required';
        $input_rules['role_id'] = 'required';
        $input_rules['location_id'] = 'required';
        $input_rules['username'] = 'required';
        $input_rules['password'] = 'required';
        $input_rules['email'] = 'required';

        $validator = Validator::make($request->all(), $input_rules);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }


        $fileName = 'default';

        if (request()->hasFile('file')) {
            $file = request()->file('file');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/user_image/', $fileName);    
        }

        //dmd(request()->hasFile('file'));

        if(isset($_POST['user_id']) && $_POST['user_id'])
            $user = User::find($request->get('user_id'));
        else
            $user = new User();

        $user->name = $request->get('user_name');
        $user->designation = $request->get('designation');
        $user->contact_no = $request->get('contact_no');
        $user->rs_id = $request->get('rs_id');
        $user->user_role_id = $request->get('role_id');
        $user->location_id = $request->get('location_id');
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->image = $fileName;
        $user->create_by = Auth::user()->id;
        $user->update_by = Auth::user()->id;
        $user->status = $request->get('status');  

        if($user->save()){
            return redirect()->back()->with('success_message', 'Service Successfully Saved');
        }else{
            return redirect()->back()->with('error_message', 'Failed to Save Service');
        }
    }
}
