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

        // $data['stock_list'] = PartsStockView::Leftjoin('parts', 'parts.id', '=', 'parts_stock_views.parts_id')
        //                                     ->Leftjoin('categories', 'categories.id', '=', 'parts.category_id')
        //                                     ->Leftjoin('brands', 'brands.id', '=', 'parts.compatible_brand_id')
        //                                     ->Leftjoin('warranties', 'warranties.id', '=', 'parts.warranty_id')
        //                                     ->Leftjoin('locations', 'locations.id', '=', 'parts_stock_views.location_id')
        //                                     ->select('*')
        //                                     ->get()
        //                                     ->toArray();


                                                

    	// $data['stock_list'] = PartsStockView::all()
     //                                        ->groupBy('parts_id')
     //                                        ->toArray();
     //    dmd($data['stock_list']);


     $data['stock_list'] = $stock_list = PartsStockView::select('parts_id', DB::raw('SUM(`quantity`) as total_qty'))
                                           // ->join('parts', 'parts.id', '=', 'parts_stock_views.parts_id')
                                           // ->join('categories', 'categories.id', '=', 'parts.category_id')
                                           // ->join('brands', 'brands.id', '=', 'parts.compatible_brand_id')
                                           // ->join('warranties', 'warranties.id', '=', 'parts.warranty_id')
                                           // ->join('locations', 'locations.id', '=', 'parts_stock_views.location_id')
                                           ->groupBy('parts_id')
                                           ->orderBy('parts_id', 'ASC')
                                           ->get()
                                           ->toArray();

        // foreach ($stock_list as $key => $stock) {
        //     $parts_quantity = Serial::where('parts_id', $stock['parts_id'])->get()->toArray();
        //     dmd($stock, $parts_quantity);
        // }


        //dmd($data['stock_list']);

        // $location_ids = array();
        // $location_short_names = array();
        // $qtys = array();

        $data['locations'] = Location::where('status', 1)->get();

        // foreach ($data['locations']->toArray() as $key => $value) {
        //     $location_ids[] = $value['id'];
        //     $location_short_names[] = $value['location_short_name'];
        //     $qtys[] = 0;
        // }

        // $data['location_count'] = $location_count = count($location_ids);
        // $data['location_ids'] = $location_ids;

        $stock_data = array();
        $parts_id = array();

        //dmd($data['stock_list']);


        
        foreach ($data['stock_list'] as $key => $stock) {

            $parts_info = Parts::where('parts.id', $stock['parts_id'])
                            ->Leftjoin('categories', 'categories.id', '=', 'parts.category_id')
                            ->Leftjoin('brands', 'brands.id', '=', 'parts.compatible_brand_id')
                            ->Leftjoin('warranties', 'warranties.id', '=', 'parts.warranty_id')
                            ->first()
                            ->toArray();

            $parts_details = PartsStockView::where('parts_id', $stock['parts_id'])
                                                    ->join('parts', 'parts.id', '=', 'parts_stock_views.parts_id')
                                                    ->get()->toArray();

                                                    //dmd($parts_details);

                $stock_data[$key]['category'] = $parts_info['category_name'];
                $stock_data[$key]['brand'] = $parts_info['brand_name'];
                $stock_data[$key]['full_code'] = $parts_info['full_code'];
                $stock_data[$key]['parts_name'] = $parts_info['parts_name'];
                $stock_data[$key]['sales_price'] = $parts_info['sales_price'];
                $stock_data[$key]['warranty_period'] = $parts_info['warranty_period'];
                $stock_data[$key]['ave_purchase'] = $parts_info['avg_price'];
                $stock_data[$key]['stock_level'] = $parts_info['stock_level'];

                $quantity = 0;
                foreach ($parts_details as $key1 => $parts) { 
                    
                    $stock_data[$key]['location_ids'][$parts['location_id']] = $parts['quantity'];
                    $quantity += $parts['quantity'];

                }

                $stock_data[$key]['stock_value'] =  $parts_info['avg_price']*$quantity;
                $stock_data[$key]['quantity'] = $quantity;                  


        }

        $data['location_data'] = $stock_data;

        //dmd($data['location_data']);

    	$data['users'] = User::all();
    	return view('report.stock_list')->with('data', $data);
    }
}