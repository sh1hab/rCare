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
use App\PartsStockView;

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
    	$data['stock_list'] = PartsStockView::Leftjoin('parts', 'parts.id', '=', 'parts_stock_views.parts_id')
                                            ->Leftjoin('categories', 'categories.id', '=', 'parts.category_id')
                                            ->Leftjoin('brands', 'brands.id', '=', 'parts.compatible_brand_id')
                                            ->Leftjoin('warranties', 'warranties.id', '=', 'parts.warranty_id')
                                            // ->orderBy('parts.category_id')
                                            // ->orderBy('parts.compatible_brand_id')
                                            // ->orderBy('parts_stock_views.parts_id')
                                            //->groupBy('parts_id')
                                            //->select('*', DB::raw('SUM(`quantity`) as total_qty', 'parts_name as name'))
                                            ->get()
                                            ->toArray();


        dmd($data['stock_list']);

		$location_ids = array();
		$location_short_names = array();
		$qtys = array();

        $data['locations'] = Location::where('status', 1)->get();

    	foreach ($data['locations']->toArray() as $key => $value) {
			$location_ids[] = $value['id'];
		    $location_short_names[] = $value['location_short_name'];
		    $qtys[] = 0;
    	}

		$data['location_count'] = $location_count = count($location_ids);
        $data['location_ids'] = $location_ids;

        $stock_data = array();
        $parts_id = array();


        
        foreach ($data['stock_list']->toArray() as $key => $stock) {

                $stock_data[$key]['category'] = $stock['category_name'];
                $stock_data[$key]['brand'] = $stock['brand_name'];
                $stock_data[$key]['full_code'] = $stock['full_code'];
                $stock_data[$key]['parts_name'] = $stock['parts_name'];
                $stock_data[$key]['sales_price'] = $stock['sales_price'];
                $stock_data[$key]['warranty_period'] = $stock['warranty_period'];
                $stock_data[$key]['location_id'] = $stock['location_id'];
                $stock_data[$key]['quantity'] = $stock['quantity'];
                $stock_data[$key]['ave_purchase'] = $stock['avg_price'];
                $stock_data[$key]['stock_level'] = $stock['stock_level'];

                $locs = '';
                for($i = 0; $i < $location_count; $i++){
                    if($locs!='') $locs .= ',';
                    $locs .= $qtys_inner[$i];
                    $qtys_inner[$i];                
                }

                $loc = $location_id;
                $key = array_search($loc, $location_ids);
                if($key || $key===0) {
                    $qtys_inner[$key] = $quantity;
                }

                $parts_row_total += $quantity;
                $total_qty += $quantity;

                $pre_parts_id = $parts_id;


        }


        dmd($data['stock_list']->toArray(), $location_count, $location_ids);

    	$data['users'] = User::all();
    	return view('report.stock_list')->with('data', $data);
    }
}