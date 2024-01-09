<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use DB;
use Log;

class PurchaseController extends Controller
{
    public function createPurchase(Request $request) {
        try{
            DB::BeginTransaction();
            $purchase = (string) $request->purchase;
            $purchase_amount = (int) $request->purchase_amount;
            $date = $request->date;
            $todays_date = Carbon::now()->timezone('Asia/Kolkata')->toDateString();

            $purchase = Purchase::create([
                'purchase' => $purchase,
                'amount' => $purchase_amount,
                'purchase_date' => $date ?? $todays_date,
                'is_active' => 1
            ]);
            DB::commit();
            return $purchase;
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
            return 3;
        }
    }

    public function deletePurchase($id) {
        try {
            DB::BeginTransaction();
            $delete = Purchase::where('purchase_id', $id)->update([
                'is_active' => 0
            ]);
            DB::commit();
            return $delete;
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
            return 3;
        }
    }
}
