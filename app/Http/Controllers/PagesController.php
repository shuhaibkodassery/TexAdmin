<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_sale;
use Carbon\Carbon;
use DB;
use Log;

class PagesController extends Controller
{
    public function loadDashboardPage() {

        return view('Admin.admin');
    }

    public function loadSalesPageForAdmin() {
        $products = Product::where('is_active',1)->get();
        $date = Carbon::now()->timezone('Asia/Kolkata');
        $sales = DB::table('product_sales as s')->select('s.product_id','p.product_name','p.product_price')->
        leftjoin('products as p', 'p.product_id','=','s.product_id')->where('date',$date->format('Y-m-d'))->get();

        return view('Admin.sales',compact('products','sales'));
    }

    public function loadProductPageForAdmin() {

        $products = Product::where('is_active',1)->get();
        return view('Admin.product',compact('products'));
    }

    public function SalesReportForAdmin(Request $request) {

        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $date = Carbon::now()->timezone('Asia/Kolkata');
        
        $query = DB::table('product_sales as s')->select('s.product_id','s.product_price','p.product_name','s.discount')->
        leftjoin('products as p','p.product_id','=','s.product_id');

        $query->when(!empty($from_date) ?? false, fn($query) => $query->where('s.date', '>=',$from_date));

        $query->when(!empty($to_date) ?? false, fn($query) => $query->where('s.date', '<=', $to_date));

        $query->when(empty($to_date) && empty($from_date) ?? false, fn($query) => $query->where('s.date','=', $date->format('Y-m-d')));

        $sales = $query->get();

        return view('Admin.sales-report', compact('sales'));
    }
}
