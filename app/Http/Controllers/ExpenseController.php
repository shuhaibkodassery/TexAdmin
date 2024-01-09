<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use DB;
use Log;

class ExpenseController extends Controller
{
    public function createExpense(Request $request) {
        try{
            DB::BeginTransaction();
            $expense = (string) $request->expense;
            $expense_amount = (int) $request->expense_amount;
            $date = $request->date;
            $todays_date = Carbon::now()->timezone('Asia/Kolkata')->toDateString();

            $expense = Expense::create([
                'expense_name' => $expense,
                'expense_amount' => $expense_amount,
                'date' => $date ?? $todays_date, 
            ]);
            DB::commit();
            return $expense;
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
            return 3;
        }
    }

    public function updateExpense(Request $request,$expense_id) {
        try {
            DB::beginTransaction();
            $expense = (string) $request->expense;
            $expense_amount = (int) $request->expense_amount;
            $date = $request->date;

            $update = Expense::where('expense_id',$expense_id)->update([
                'expense_name' => $expense,
                'expense_amount' => $expense_amount,
                'date' => $date,
            ]);

            DB::commit();
            return $update;
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
            return 3;
        }
    }

    public function deleteExpense($expense_id) {
        try{
            DB::beginTransaction();
            $delete = Expense::where('expense_id',$expense_id)->delete();
            DB::commit();
            return $delete;
        }catch(\Exception $e) {
            Log::error($e);
            DB::rollBack();
            return 3;
        }
    }
}
