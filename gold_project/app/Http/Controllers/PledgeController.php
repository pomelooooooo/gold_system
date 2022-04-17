<?php

namespace App\Http\Controllers;

use App\ProductDetails;
use App\Product;
use App\TypeGold;
use App\Striped;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Customer;
use App\HistoryPledges;
use App\Pledge;
use App\PledgeLine;
use PDF;
use Illuminate\Support\Facades\File;

class PledgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $pledge = Pledge::select("pledges.*", 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'customer.tel as telcustomer')->leftJoin('customer', 'pledges.customer_id', '=', 'customer.id')->orderBy('created_at', "desc");
        if (!empty($keyword)) {
            $pledge = $pledge->where('pledges.id', 'like', "%$keyword%")
                ->orWhere('pledges.customer_id', 'like', "%$keyword%");
        }
        $filter_customer = $request->get('filter_customer');
        if (!empty($filter_customer)) {
            $pledge = $pledge->where('pledges.customer_id', $filter_customer);
        }
        $pledge = $pledge->paginate(10);
        $customer = Customer::all();
        $users = User::all();
        return view('admin.pledge.index', compact('customer', 'users', 'pledge', 'keyword', 'filter_customer',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gold_type = ["ทองในถาด", "ทองในสต๊อค"];
        $productdetail = ProductDetails::select('code')->where('code', 'LIKE', 'D%')->orderBy('code', "desc")->first();
        if (!empty($productdetail)) {
            $productdetail->code = substr($productdetail->code, 1);
            // dd($productdetail->code);
            $code = $productdetail->code + 1;
            $num = "0";
            // dd(strlen(str_replace('0', '', $code)));
            if (strlen($code) <= 3) {
                for ($i = strlen($code); $i < 3; $i++) {
                    $num .= "0";
                }
                $code = $num . $code;
            }
        } else {
            $code = "0001";
        }
        $code = "D" . $code;
        $pledge = Pledge::all();
        $product = Product::all();
        $producttype = TypeGold::all();
        $users = User::all();
        $customer = Customer::all();
        $striped = Striped::all();
        return view('admin.pledge.create', compact('product', 'gold_type', 'users', 'customer', 'striped', 'code', 'pledge', 'producttype'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pledge = Pledge::select('group_id')->orderBy('group_id', "desc")->first();
        if (!empty($pledge)) {
            $group_id = $pledge->group_id + 1;
        } else {
            $group_id = 1;
        }
        $price_pledge = $weight = $piece = 0;
        foreach ($request->allprice as $key => $price) {
            $price_pledge += $price;
            $weight += $request->gram[$key];
            $piece++;
        }
        $pledges = new Pledge(
            [
                'group_id' => $group_id,
                'user_id' => $request->get('user_id'),
                'customer_id' => $request->get('customer_id'),
                'status_check' => '0',
                'piece' => $piece,
                'weight' => $weight,
                'price_pledge' => $price_pledge,
                'interest_per' => $request->get('interest_per'),
                'interest_bath' => $request->get('interest_bath'),
                'installment_start' => $request->get('installment_start'),
                'installment_next' => $request->get('installment_next'),
            ]
        );
        $pledges->save();

        foreach ($request->get('code') as $key => $value) {
            $productdetail = new ProductDetails(
                [
                    'code' => $request->get('code')[$key],
                    'details' => $request->get('details')[$key],
                    'type_gold_id' => $request->get('type_gold_id')[$key],
                    'striped_id' => $request->get('striped_id')[$key],
                    'size' => $request->get('size')[$key],
                    'gram' => $request->get('gram')[$key],
                    'status' => '1',
                    'status_trade' => '3',
                    'type' => 'ทองจำนำ',
                    'allprice' => $request->get('allprice')[$key],
                    'user_id' => $request->get('user_id'),
                    'customer_id' => $request->get('customer_id'),
                    'datetime' => $request->get('datetime'),
                ]
            );
            $productdetail->save();

            $pledgeLine = new PledgeLine([
                'pledges_id' => $pledges->id,
                'product_detail_id' => $productdetail->id,
                'status_check' => '0',
            ]);
            $pledgeLine->save();
        }

        return response()->json(['status' => true, 'id' => $pledges->id], 200);
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
        $pledges = Pledge::select('pledges.*', 'product_details.id as product_detail_id', 'product_details.code', 'product_details.type_gold_id', 'product_details.size', 'product_details.gram', 'product_details.striped_id', 'product_details.details', 'product_details.allprice', 'customer.tel', 'customer.address', 'pledges_line.id as pledges_line_id', 'pledges_line.status_check as pledges_line_status_check')->join('pledges_line', 'pledges_line.pledges_id', '=', 'pledges.id')->join('product_details', 'pledges_line.product_detail_id', '=', 'product_details.id')->join('customer', 'pledges.customer_id', '=', 'customer.id')->orderBy('created_at', "desc")->where('pledges.id', $id)->get();
        // dd($pledges);

        $history_pledges_due_date = HistoryPledges::select('due_date')->where('pledges_id', $pledges[0]->id)->orderBy('id', 'desc')->first();
        if (!empty($history_pledges_due_date)) {
            $history_pledges_due_date = Carbon::parse($history_pledges_due_date->due_date)->addMonth();
        } else {
            $history_pledges_due_date = Carbon::parse($pledges[0]->installment_start)->addMonth();
        }
        $history_pledges = HistoryPledges::where('pledges_id', $pledges[0]->id)->get();
        $deposit = 0;
        // $interest_per = 0;
        foreach ($history_pledges as $key => $value) {
            $deposit += $value->deposit;
        }
        $deposit = (float)$pledges[0]->price_pledge - $deposit;
        $interest_bath = ($deposit * $pledges[0]->interest_per) / 100;
        $producttype = TypeGold::all();
        $users = User::all();
        $customer = Customer::all();
        $striped = Striped::all();
        return view('admin.pledge.edit', compact('producttype', 'striped', 'pledges', 'customer', 'users', 'id', 'interest_bath', 'deposit', 'history_pledges_due_date'));
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
        // dd($request);
        $pledges = Pledge::find($id);
        $pledges->user_id = $request->get('user_id');
        $pledges->customer_id = $request->get('customer_id');
        $pledges->installment_start = $request->get('installment_start');
        $pledges->installment_next = $request->get('installment_next');
        $pledges->interest_per = $request->get('interest_per');
        $pledges->updated_at = Carbon::now();
        $pledges->save();

        foreach ($request->pledges_line_id as $key => $value) {
            $pledgeLine = PledgeLine::find($value);
            $pledgeLine->updated_at = Carbon::now();
            $pledgeLine->save();

            $productdetail = ProductDetails::find($request->product_detail_id[$key]);
            $productdetail->type_gold_id = $request->type_gold_id[$key];
            $productdetail->size = $request->size[$key];
            $productdetail->gram = $request->gram[$key];
            $productdetail->striped_id = $request->striped_id[$key];
            $productdetail->details = $request->details[$key];
            $productdetail->allprice = $request->allprice[$key];
            // dd($productdetail);
            $productdetail->save();
        }
        $customer = Customer::all();
        $users = User::all();

        return redirect()->route('pledge.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pledges = Pledge::find($id);
        $pledges_line = PledgeLine::where('pledges_id', $id)->get();
        foreach($pledges_line as $key => $value){
            $productDetail = ProductDetails::find($value->product_detail_id);
            $productDetail->delete();
        }
        $pledges->delete();
        PledgeLine::where('pledges_id', $id)->delete();
        return response()->json(['status' => true], 200);
    }

    public function getTel($id)
    {
        $customer = Customer::where('id', $id)->first();
        // dd($customer);
        return response()->json(["customer" => $customer]);
    }

    public function interest($id)
    {
        $pledges = Pledge::select('pledges.*', 'product_details.code', 'product_details.type_gold_id', 'product_details.size', 'product_details.gram', 'product_details.striped_id', 'product_details.details', 'product_details.allprice', 'customer.tel', 'customer.address', 'pledges_line.id as pledges_line_id', 'pledges_line.status_check as pledges_line_status_check')->join('pledges_line', 'pledges_line.pledges_id', '=', 'pledges.id')->join('product_details', 'pledges_line.product_detail_id', '=', 'product_details.id')->join('customer', 'pledges.customer_id', '=', 'customer.id')->orderBy('created_at', "desc")->where('pledges.id', $id)->get();
        // dd($pledges);
        $history_pledges_due_date = HistoryPledges::select('due_date')->where('pledges_id', $pledges[0]->id)->orderBy('id', 'desc')->first();
        if (!empty($history_pledges_due_date)) {
            $history_pledges_due_date = Carbon::parse($history_pledges_due_date->due_date)->addMonth();
        } else {
            $history_pledges_due_date = Carbon::parse($pledges[0]->installment_start)->addMonth();
        }
        $history_pledges = HistoryPledges::select('history_pledges.*','pledges.interest_per as per')->join('pledges','history_pledges.pledges_id','=','pledges.id')->where('pledges_id', $pledges[0]->id)->get();
        $deposit = 0;
        // dd($history_pledges);
        // $interest_per = 0;
        foreach ($history_pledges as $key => $value) {
            $deposit += $value->deposit;
        }
        $deposit = (float)$pledges[0]->price_pledge - $deposit;
        $interest_bath = ($deposit * $pledges[0]->interest_per) / 100;
        $producttype = TypeGold::all();
        $users = User::all();
        $customer = Customer::all();
        $striped = Striped::all();
        return view('admin.pledge.interest', compact('producttype', 'striped', 'pledges', 'customer', 'users', 'id', 'interest_bath', 'deposit', 'history_pledges_due_date','history_pledges'));
    }

    public function interest_update(Request $request, $id)
    {
        $pledges = Pledge::find($id);
        // dd($request->status_check);
        $request->status_check = array_values($request->status_check);
        // dd($request->status_check);
        if(count(array_unique($request->status_check)) == 1){
            $pledges->status_check = $request->status_check[0];
        }
        $pledges->interest_bath = $request->get('interest_bath');
        $pledges->updated_at = Carbon::now();
        $pledges->save();
        // dd($request->pledges_line_id);
        foreach ($request->pledges_line_id as $key => $value) {
            $pledgeLine = PledgeLine::find($value);
            $pledgeLine->status_check = $request->status_check[$key];
            $pledgeLine->updated_at = Carbon::now();
            $pledgeLine->save();
        }

        $pledge_history = new HistoryPledges([
            'pledges_id' => $pledges->id,
            'deposit' => $request->get('deposit'),
            'due_date' => $request->get('due_date'),
            'customer_name' => $request->get('customer_name'),
        ]);
        $pledge_history->save();

        $customer = Customer::all();
        $users = User::all();

        return redirect()->route('pledge.index');
    }

    public function formpledge($id)
    {
        $pledges = Pledge::select('pledges.*', 'type_gold.name as type_gold_name', 'product_details.id as product_detail_id', 'product_details.code', 'product_details.type_gold_id', 'product_details.size', 'product_details.gram', 'product_details.striped_id', 'product_details.details', 'product_details.allprice', 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'customer.tel as telcustomer', 'customer.address as addresscustomer', 'pledges_line.id as pledges_line_id', 'pledges_line.status_check as pledges_line_status_check', 'history_pledges.customer_name as customername', 'history_pledges.due_date', 'history_pledges.deposit', 'history_pledges.created_at as created_history_pledges')->join('pledges_line', 'pledges_line.pledges_id', '=', 'pledges.id')->leftJoin('history_pledges', 'history_pledges.pledges_id', '=', 'pledges.id')->join('product_details', 'pledges_line.product_detail_id', '=', 'product_details.id')->join('customer', 'pledges.customer_id', '=', 'customer.id')->join('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->orderBy('created_at', "desc")->where('pledges.id', $id)->get();
        $count = count($pledges);
        $customer = Customer::all();
        $productdetail = ProductDetails::all();
        $pdf = PDF::loadView('admin.pledge.form', compact('productdetail', 'customer', 'pledges','count'));
        return $pdf->stream('formpledge.pdf');
    }
}
