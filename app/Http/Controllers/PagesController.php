<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product,Product_sale,Expense,Purchase};
use Carbon\Carbon;
use DB;
use Log;

class PagesController extends Controller
{
    public function loadDashboardPage() {

        $date = Carbon::now()->timezone('Asia/Kolkata')->toDateString();

        $query = DB::table('product_sales')->where('date','=', $date);

        $todays_sale = $query->sum('product_price') - $query->sum('discount');
        
        $total_sales = Product_sale::sum('product_price') - Product_sale::sum('discount');
        
        $todays_expense = Expense::where('date','=', $date)->sum('expense_amount');

        $total_expenses = Expense::sum('expense_amount');

        $total_purchase = Purchase::where('is_active',1)->sum('amount');

        $query = DB::table('product_sales as ps')->select('ps.product_price','ps.discount','p.purchase_price')->
        leftjoin('products as p', 'p.product_id', '=', 'p.product_id');
        
        $total_purchase_price = $query->groupBy('p.product_id')->sum('p.purchase_price');

        $total_profit = ($total_sales - $total_purchase_price) - $total_expenses;

        $todays_purchase_price = $query->where('ps.date', '=',$date)->groupBy('p.purchase_price')->sum('p.purchase_price');

        $todays_profit = ($todays_sale - $todays_purchase_price - $todays_expense);

        return view('Admin.admin',compact('todays_sale','total_sales','todays_expense','total_expenses','total_purchase','total_profit','todays_profit'));
    }

    public function loadSalesPageForAdmin() {
        $products = Product::where('is_active',1)->get();
        $date = Carbon::now()->timezone('Asia/Kolkata');
        $sales = DB::table('product_sales as s')->select('s.id','s.product_id','p.product_name','p.product_price')->
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
        
        $query = DB::table('product_sales as s')->select('s.product_id','s.product_price','p.product_name','s.discount',DB::raw("s.product_price - s.discount as total"))->
        leftjoin('products as p','p.product_id','=','s.product_id');

        $query->when(!empty($from_date) ?? false, fn($query) => $query->where('s.date', '>=',$from_date));

        $query->when(!empty($to_date) ?? false, fn($query) => $query->where('s.date', '<=', $to_date));

        $query->when(empty($to_date) && empty($from_date) ?? false, fn($query) => $query->where('s.date','=', $date->format('Y-m-d')));

        $net_amount = $query->sum('s.product_price') - $query->sum('s.discount');
        
        $sales = $query->get();

        return view('Admin.sales-report', compact('sales','net_amount'));
    }

    public function loadExpensePage() {

        $expenses = Expense::all();
        return view('Admin.expense',compact('expenses'));
    }

    public function getAllPurchase() {

        $purchases = Purchase::where('is_active',1)->get();
        return view('Admin.purchase',compact('purchases'));
    }
}
