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

class ReportsController extends Controller
{
    public function stock_list()
    {
    	$data['stock_list'] = PartsStock::Leftjoin('parts', 'parts.id', '=', 'parts_stocks.parts_id')
    						->Leftjoin('purchases', 'purchases.id', '=', 'parts_stocks.purchase_id')
    						->Leftjoin('purchase_details', 'purchase_details.id', '=', 'parts_stocks.purchase_details_id')
    						->Leftjoin('purchase_receives', 'purchase_receives.id', '=', 'parts_stocks.purchase_rcv_id')
    						->Leftjoin('locations', 'locations.id', '=', 'parts_stocks.location_id')
    						->Leftjoin('suppliers', 'suppliers.id', '=', 'purchases.supplier_id')
    						->Leftjoin('categories', 'categories.id', '=', 'parts.category_id')
    						->Leftjoin('warranties', 'warranties.id', '=', 'parts.warranty_id')
    						->Leftjoin('brands', 'brands.id', '=', 'parts.compatible_brand_id')
    						//->groupBy('parts_stocks.parts_id')
    						->select(DB::raw('*', 'parts_stocks.parts_id as parts_id'))
    						->get();

		$location_ids = array();
		$location_short_names = array();
		$qtys = array();

        $data['location'] = Location::get();

    	foreach ($data['location']->toArray() as $key => $value) {
			$location_ids[] = $value['id'];
		    $location_short_names[] = $value['location_short_name'];
		    $qtys[] = 0;
    	}

		$location_count = count($location_ids);
        
    	dmd($location_ids, $location_short_names, $qtys);

    	$data['users'] = User::all();
    	return view('report.stock_list')->with('data', $data);
    }
}