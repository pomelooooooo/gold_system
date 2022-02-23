<?php

namespace App\Http\Controllers;

use App\ProductDetails;
use App\Product;
use App\TypeGold;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Customer;
use App\Manufacturer;
use App\ReportSmelter;
use App\Striped;
use DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $stocknew = ProductDetails::select("product_details.*", 'type_gold.name')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->orderBy('code', "desc")->where('type', 'ทองใหม่');
        if (!empty($keyword)) {
            $stocknew = $stocknew->where('product_details.code', 'like', "%$keyword%")
                ->orWhere('product_details.details', 'like', "%$keyword%");
        }
        $filter_type = $request->get('filter_type');
        if (!empty($filter_type)) {
            $stocknew = $stocknew->where('product_details.type_gold_id', $filter_type);
        }
        $filter_size = $request->get('filter_size');
        if (!empty($filter_size)) {
            $stocknew = $stocknew->where('product_details.size', $filter_size);
        }
        $filter_status = $request->get('filter_status');
        if ($filter_status == '0' || $filter_status == '1') {
            $stocknew = $stocknew->where('product_details.status_trade', "$filter_status");
        }
        $filter_date = $request->get('filter_date');
        if (!empty($filter_date)) {
            $stocknew = $stocknew->where('product_details.created_at', '>=', $filter_date);
        }
        $filter_date_end = $request->get('filter_date_end');
        if (!empty($filter_date_end)) {
            $stocknew = $stocknew->where('product_details.created_at', '<=', $filter_date_end);
        }
        $stocknew = $stocknew->paginate(5);

        $keyword2 = $request->get('search2');
        $stockold = ProductDetails::select("product_details.*", 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'users.name as nameemployee', 'users.lastname as lastnameemployee', 'type_gold.name')->leftJoin('customer', 'product_details.customer_id', '=', 'customer.id')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->leftJoin('users', 'product_details.user_id', '=', 'users.id')->orderBy('code', "desc")->where('type', 'ทองเก่า');
        if (!empty($keyword2)) {
            $stockold = $stockold->where('product_details.code', 'like', "%$keyword2%")
                ->orWhere('product_details.details', 'like', "%$keyword2%");
        }
        $filter_type2 = $request->get('filter_type2');
        if (!empty($filter_type2)) {
            $stockold = $stockold->where('product_details.type_gold_id', $filter_type2);
        }
        $filter_size2 = $request->get('filter_size2');
        if (!empty($filter_size2)) {
            $stockold = $stockold->where('product_details.size', $filter_size2);
        }
        $filter_date2 = $request->get('filter_date2');
        if (!empty($filter_date2)) {
            $stockold = $stockold->where('product_details.created_at', '>=', $filter_date2);
        }
        $filter_date_end2 = $request->get('filter_date_end2');
        if (!empty($filter_date_end2)) {
            $stocknew = $stocknew->where('product_details.created_at', '<=', $filter_date_end2);
        }
        $stockold = $stockold->paginate(5);
        $product = Product::all();
        $typegold = TypeGold::all();
        $user = User::all();
        $customer = Customer::all();
        $striped = Striped::all();
        // dd($filter_status);
        return view('admin.stock.index', compact('product', 'stocknew', 'stockold', 'typegold', 'user', 'customer', 'striped', 'keyword', 'filter_type', 'filter_size', 'filter_status', 'filter_date', 'filter_date_end', 'keyword2', 'filter_type2', 'filter_size2', 'filter_date2', 'filter_date_end2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function stocknew(Request $request)
    {
        $keyword = $request->get('search');
        $stocknew = ProductDetails::select("product_details.*", 'type_gold.name')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->orderBy('code', "desc")->where('type', 'ทองใหม่');
        if (!empty($keyword)) {
            $stocknew = $stocknew->where('product_details.code', 'like', "%$keyword%")
                ->orWhere('product_details.details', 'like', "%$keyword%");
        }
        $filter_type = $request->get('filter_type');
        if (!empty($filter_type)) {
            $stocknew = $stocknew->where('product_details.type_gold_id', $filter_type);
        }
        $filter_size = $request->get('filter_size');
        if (!empty($filter_size)) {
            $stocknew = $stocknew->where('product_details.size', $filter_size);
        }
        $filter_status = $request->get('filter_status');
        if ($filter_status == '0' || $filter_status == '1') {
            $stocknew = $stocknew->where('product_details.status_trade', "$filter_status");
        }
        $filter_status_gold = $request->get('filter_status_gold');
        if ($filter_status_gold == '0' || $filter_status_gold == '1') {
            $stocknew = $stocknew->where('product_details.status', "$filter_status_gold");
        }
        $filter_date = $request->get('filter_date');
        $filter_date_end = $request->get('filter_date_end');
        if (!empty($filter_date)) {
            $stocknew = $stocknew->whereDate('product_details.created_at', '>=', $filter_date);
        }
        if (!empty($filter_date_end)) {
            $stocknew = $stocknew->whereDate('product_details.created_at', '<=', $filter_date_end);
        }
        $stocknew = $stocknew->paginate(15);
        $product = Product::all();
        $typegold = TypeGold::all();
        $user = User::all();
        $customer = Customer::all();
        $striped = Striped::all();
        $stocknewCount = ProductDetails::select("product_details.*", 'type_gold.name', DB::raw('count(*) as total'), DB::raw('sum(gram) as total_gram'))->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->where('type', 'ทองใหม่')->where('status_trade', '0')->groupBy('type_gold_id')->get();

        return view('admin.stock.stocknew', compact('product', 'stocknew', 'typegold', 'user', 'customer', 'striped', 'keyword', 'filter_type', 'filter_size', 'filter_status', 'filter_status_gold', 'filter_date', 'filter_date_end', 'stocknewCount'));
    }
    public function stockold(Request $request)
    {
        $keyword2 = $request->get('search2');
        $stockold = ProductDetails::select("product_details.*", 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'users.name as nameemployee', 'users.lastname as lastnameemployee', 'type_gold.name')->leftJoin('customer', 'product_details.customer_id', '=', 'customer.id')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->leftJoin('users', 'product_details.user_id', '=', 'users.id')->orderBy('code', "desc")->where('type', 'ทองเก่า')->where('status_trade', '0');
        if (!empty($keyword2)) {
            $stockold = $stockold->where('product_details.code', 'like', "%$keyword2%")
                ->orWhere('product_details.details', 'like', "%$keyword2%");
        }
        $filter_type2 = $request->get('filter_type2');
        if (!empty($filter_type2)) {
            $stockold = $stockold->where('product_details.type_gold_id', $filter_type2);
        }
        $filter_size2 = $request->get('filter_size2');
        if (!empty($filter_size2)) {
            $stockold = $stockold->where('product_details.size', $filter_size2);
        }
        $filter_date2 = $request->get('filter_date2');
        $filter_date_end2 = $request->get('filter_date_end2');
        if (!empty($filter_date2)) {
            $stockold = $stockold->whereDate('product_details.created_at', '>=', $filter_date2);
        }
        if (!empty($filter_date_end2)) {
            $stockold = $stockold->whereDate('product_details.created_at', '<=', $filter_date_end2);
        }
        $stockold = $stockold->paginate(15);
        $product = Product::all();
        $typegold = TypeGold::all();
        $user = User::all();
        $customer = Customer::all();
        $striped = Striped::all();


        return view('admin.stock.stockold', compact('product',  'stockold', 'typegold', 'user', 'customer', 'striped', 'keyword2', 'filter_type2', 'filter_size2', 'filter_date2', 'filter_date_end2'));
    }

    public function stock_old(Request $request)
    {
        $keyword3 = $request->get('search3');
        $stock_old = ProductDetails::select("product_details.*", 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'users.name as nameemployee', 'users.lastname as lastnameemployee', 'type_gold.name')->leftJoin('customer', 'product_details.customer_id', '=', 'customer.id')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->leftJoin('users', 'product_details.user_id', '=', 'users.id')->where('type', 'ทองเก่า')->orderBy('code', "desc");
        if (!empty($keyword3)) {
            $stock_old = $stock_old->where('product_details.code', 'like', "%$keyword3%")
                ->orWhere('product_details.details', 'like', "%$keyword3%");
        }
        $filter_type3 = $request->get('filter_type3');
        if (!empty($filter_type3)) {
            $stock_old = $stock_old->where('product_details.type_gold_id', $filter_type3);
        }
        $filter_size3 = $request->get('filter_size3');
        if (!empty($filter_size3)) {
            $stock_old = $stock_old->where('product_details.size', $filter_size3);
        }
        $filter_date3 = $request->get('filter_date3');
        if (!empty($filter_date3)) {
            $stock_old = $stock_old->whereDate('product_details.created_at', '>=', $filter_date3);
        }
        $filter_status3 = $request->get('filter_status3');
        if ($filter_status3 == '2' || $filter_status3 == '0') {
            $stock_old = $stock_old->where('product_details.status_trade', "$filter_status3");
        }
        $filter_date_end3 = $request->get('filter_date_end3');
        if (!empty($filter_date_end3)) {
            $stock_old = $stock_old->whereDate('product_details.created_at', '<=', $filter_date_end3);
        }
        $stock_old = $stock_old->paginate(15);
        $product = Product::all();
        $typegold = TypeGold::all();
        $user = User::all();
        $customer = Customer::all();
        $striped = Striped::all();
        $stockoldCount = ProductDetails::select("product_details.*", 'type_gold.name', DB::raw('count(*) as total'), DB::raw('sum(gram) as total_gram'))->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->where('type', 'ทองเก่า')->where('status_trade', '0')->groupBy('type_gold_id')->get();

        return view('admin.stock.stock_old', compact('product',  'stock_old', 'typegold', 'user', 'customer', 'striped', 'keyword3', 'filter_type3', 'filter_size3', 'filter_status3', 'filter_date3', 'filter_date_end3', 'stockoldCount'));
    }

    public function updateGroup(Request $request)
    {
        ProductDetails::whereIn('id', explode(",", $request->id))->update(['status_trade' => '2']);

        return response()->json(['status' => true], 200);
    }

    public function updateStatusCheck(Request $request)
    {
        ProductDetails::whereIn('id', explode(",", $request->id))->update(['status_check' => "$request->status_check", 'note' => "$request->note"]);

        return response()->json(['status' => true], 200);
    }

    public function updateStatusCheckNew(Request $request)
    {
        ProductDetails::whereIn('id', explode(",", $request->id))->update(['status_check' => "$request->status_check", 'note' => "$request->note"]);

        return response()->json(['status' => true], 200);
    }

    public function reportSmelters(Request $request)
    {
        $pd_id = explode(',', $request->json('pd_Id'));

        $reportSmelter = ReportSmelter::select('name_group')->orderBy('name_group', "desc")->first();
        if (!empty($reportSmelter)) {
            $name_group = $reportSmelter->name_group + 1;
        } else {
            $name_group = 1;
        }
        foreach ($pd_id as $key => $id) {
            $report_smelter = new ReportSmelter(
                [
                    'name_group' => $name_group,
                    'product_detail_id' => $id,
                    'manufacturer' => $request->json('manufacturer'),
                    'total_size' => $request->json('total_size'),
                    'total_price' => $request->json('total_price'),
                ]
            );
            $report_smelter->save();
        }

        return response()->json(['status' => true], 200);
    }

    public function getManusactor()
    {
        $manufacturer = Manufacturer::all();

        return response()->json(['status' => true, 'data' => $manufacturer]);
    }
}
