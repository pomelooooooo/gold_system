<?php

namespace App\Http\Controllers;

use App\ProductDetails;
use App\Product;
use App\FormBuy;
use App\TypeGold;
use App\Striped;
use Carbon\Carbon;
use App\User;
use App\FormSell;
use App\Customer;
use App\HistoryPledges;
use App\Pledge;
use App\PledgeLine;
use PDF;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function report_buy(Request $request)
    {
        $keyword = $request->get('search');
        $form = FormBuy::select('formbuy.*', 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'customer.idcard as idcardcustomer', 'customer.address as addresscustomer','customer.tel as telcustomer', 'product_details.details as detail', 'product_details.gram as gram', 'product_details.allprice')
            ->leftJoin('customer', 'formbuy.customer_id', '=', 'customer.id')->leftJoin('product_details', 'formbuy.product_detail_id', '=', 'product_details.id');
            if (!empty($keyword)) {
                $form = $form->where('formbuy.id', 'like', "%$keyword%")
                    ->orWhere('formbuy.customer_id', 'like', "%$keyword%");
            }
            $filter_customer = $request->get('filter_customer');
            if (!empty($filter_customer)) {
                $form = $form->where('formbuy.customer_id', $filter_customer);
            }
            $filter_date = $request->get('filter_date');
            if (!empty($filter_date)) {
                $form = $form->where('formbuy.created_at', '>=', $filter_date);
            }
            $filter_date_end = $request->get('filter_date_end');
            if (!empty($filter_date_end)) {
                $form = $form->where('formbuy.created_at', '<=', $filter_date_end);
            }
            $form = $form->groupBy('group_id')->paginate(10);
            $customer = Customer::all();
        return view('admin.report.index_buy', compact('customer', 'form', 'keyword', 'filter_customer','filter_date', 'filter_date_end'));
    }
    public function formbuy($id)
    {
        $form = FormBuy::select('formbuy.*', 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'customer.idcard as idcardcustomer', 'customer.address as addresscustomer', 'product_details.details as detail', 'product_details.gram as gram', 'product_details.allprice')
            ->leftJoin('customer', 'formbuy.customer_id', '=', 'customer.id')->leftJoin('product_details', 'formbuy.product_detail_id', '=', 'product_details.id')->where('group_id', $id)->get();
        $count = count($form);
        $customer = Customer::all();
        $productdetail = ProductDetails::all();
        $pdf = PDF::loadView('admin.report.form_buy', compact('productdetail', 'customer', 'form','count'));
        return $pdf->stream('formbuy.pdf');
    }
    public function report_sell(Request $request)
    {
        $keyword = $request->get('search');
        $form = FormSell::select('formsell.*', 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'customer.idcard as idcardcustomer', 'customer.address as addresscustomer','customer.tel as telcustomer','product_details.details as detail','product_details.gram as gram','product_details.sellprice')
        ->leftJoin('customer', 'formsell.customer_id', '=', 'customer.id')->leftJoin('product_details', 'formsell.product_detail_id', '=', 'product_details.id');
        if (!empty($keyword)) {
            $form = $form->where('formsell.id', 'like', "%$keyword%")
                ->orWhere('formsell.customer_id', 'like', "%$keyword%");
        }
        $filter_customer = $request->get('filter_customer');
        if (!empty($filter_customer)) {
            $form = $form->where('formsell.customer_id', $filter_customer);
        }
        $filter_date = $request->get('filter_date');
        if (!empty($filter_date)) {
            $form = $form->where('formsell.created_at', '>=', $filter_date);
        }
        $filter_date_end = $request->get('filter_date_end');
        if (!empty($filter_date_end)) {
            $form = $form->where('formsell.created_at', '<=', $filter_date_end);
        }
        $form = $form->groupBy('group_id')->paginate(10);
        $customer = Customer::all();
        return view('admin.report.index_sell', compact('customer', 'form', 'keyword', 'filter_customer','filter_date', 'filter_date_end'));
    }
    public function formsell($id)
    {
        $form = FormSell::select('formsell.*', 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'customer.idcard as idcardcustomer', 'customer.address as addresscustomer','product_details.details as detail','product_details.gram as gram','product_details.sellprice')
        ->leftJoin('customer', 'formsell.customer_id', '=', 'customer.id')->leftJoin('product_details', 'formsell.product_detail_id', '=', 'product_details.id')->where('group_id', $id)->get();
        $count = count($form);
        $customer = Customer::all();
        $productdetail = ProductDetails::all();
        $pdf = PDF::loadView('admin.report.form_sell', compact('productdetail', 'customer', 'form','count'));
        return $pdf->stream('formsell.pdf');
    }
    public function report_pledge(Request $request)
    {
        $keyword = $request->get('search');
        $pledge = Pledge::select("pledges.*", 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'customer.tel as telcustomer')->leftJoin('customer', 'pledges.customer_id', '=', 'customer.id')->orderBy('created_at', "desc");
        // dd($pledge->get());
        if (!empty($keyword)) {
            $pledge = $pledge->where('pledges.id', 'like', "%$keyword%")
                ->orWhere('pledges.customer_id', 'like', "%$keyword%");
        }
        $filter_customer = $request->get('filter_customer');
        if (!empty($filter_customer)) {
            $pledge = $pledge->where('pledges.customer_id', $filter_customer);
        }
        $filter_date = $request->get('filter_date');
        if (!empty($filter_date)) {
            $pledge = $pledge->where('pledges.installment_start', '>=', $filter_date);
        }
        $filter_date_end = $request->get('filter_date_end');
        if (!empty($filter_date_end)) {
            $pledge = $pledge->where('pledges.installment_start', '<=', $filter_date_end);
        }
        $pledge = $pledge->paginate(10);
        $customer = Customer::all();
        return view('admin.report.index_pledge', compact('customer', 'pledge', 'keyword', 'filter_customer','filter_date', 'filter_date_end'));
    }
    public function formpledge($id)
    {
        $pledges = Pledge::select('pledges.*', 'type_gold.name as type_gold_name', 'product_details.id as product_detail_id', 'product_details.code', 'product_details.type_gold_id', 'product_details.size', 'product_details.gram', 'product_details.striped_id', 'product_details.details', 'product_details.allprice', 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'customer.tel as telcustomer', 'customer.address as addresscustomer', 'pledges_line.id as pledges_line_id', 'pledges_line.status_check as pledges_line_status_check', 'history_pledges.customer_name as customername', 'history_pledges.due_date', 'history_pledges.deposit', 'history_pledges.created_at as created_history_pledges')->join('pledges_line', 'pledges_line.pledges_id', '=', 'pledges.id')->leftJoin('history_pledges', 'history_pledges.pledges_id', '=', 'pledges.id')->join('product_details', 'pledges_line.product_detail_id', '=', 'product_details.id')->join('customer', 'pledges.customer_id', '=', 'customer.id')->join('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->orderBy('created_at', "desc")->where('pledges.id', $id)->get();
        $count = count($pledges);
        $customer = Customer::all();
        $productdetail = ProductDetails::all();
        $pdf = PDF::loadView('admin.report.form_pledge', compact('productdetail', 'customer', 'pledges','count'));
        return $pdf->stream('formpledge.pdf');
    }
}
