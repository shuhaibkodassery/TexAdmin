<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_sale;
use Carbon\Carbon;
use DB;
use Log;

class ProductController extends Controller
{
    /**
     * @author Shuhaib Malik
     * on 04 Jan 2024
     */
    public function createProduct(Request $request) {
        try {
            DB::BeginTransaction();
            $product = Product::create([
                'product_code' => $request->product_code,
                'product_name' => $request->product_name,
                'purchase_price' => $request->purchase_price,
                'product_price' => $request->product_price,
                'is_active' => 1
            ]);
            DB::commit();
            return response()->json($product,200);
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
            return 3;
        }
    }

    public function deleteProductByid($id) {
        try {
            DB::BeginTransaction();
            $delete = Product::where('product_id',$id)->update([
                'is_active' => false,
            ]);
            DB::commit();
            return $delete;
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
            return 3;
        }
    }

    public function createSale(Request $request) {
        try {
            DB::BeginTransaction();
            $date = Carbon::now()->timezone('Asia/Kolkata')->toDateString();
            $sale = Product_sale::create([
                'product_id' => $request->product_id,
                'product_price' => $request->product_price,
                'date' =>  $request->date ?? $date,
                'discount' => $request->discount ?? 0,
            ]);
            DB::commit();
            return $sale;
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
            return 3;
        }
    }

    public function deleteSale($id) {
        try {
            DB::beginTransaction();
            $delete = Product_sale::where('id', $id)->delete();
            DB::commit();
        } catch (\Exception $e) { 
            Log::error($e);
            DB::rollback();
            return 3;
        }
    }

}
