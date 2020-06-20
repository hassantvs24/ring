<?php

namespace App\Observers;

use App\AllTransaction;
use App\Expense;

class ExpenseObserver
{
    /**
     * Handle the expense "created" event.
     *
     * @param  \App\Expense  $expense
     * @return void
     */
    public function created(Expense $expense)
    {
        if($expense->amount > 0){
            $all_transaction = new AllTransaction();
            $all_transaction->expenses_id = $expense->id;
            $all_transaction->transaction_point = 'Expense';
            $all_transaction->transaction_type = 'OUT';
            $all_transaction->source_type = 'Withdraw';
            $all_transaction->amount = $expense->amount;
            $all_transaction->warehouses_id = $expense->warehouses_id;
            $all_transaction->created_at = $expense->created_at;
            $all_transaction->save();
        }
    }

    /**
     * Handle the expense "updated" event.
     *
     * @param  \App\Expense  $expense
     * @return void
     */
    public function updated(Expense $expense)
    {
        if($expense->amount > 0){
            AllTransaction::updateOrCreate([
                'expenses_id' => $expense->id
            ], [
                'amount' => $expense->amount,
                'warehouses_id' => $expense->warehouses_id,
                'created_at' => $expense->created_at
            ]);
        }else{
            AllTransaction::where('expenses_id',  $expense->id)->forceDelete();
        }
    }

    /**
     * Handle the expense "deleted" event.
     *
     * @param  \App\Expense  $expense
     * @return void
     */
    public function deleted(Expense $expense)
    {
        AllTransaction::where('expenses_id',  $expense->id)->delete();
    }

    /**
     * Handle the expense "restored" event.
     *
     * @param  \App\Expense  $expense
     * @return void
     */
    public function restored(Expense $expense)
    {
        AllTransaction::onlyTrashed()->where('expenses_id',  $expense->id)->restore();
    }

    /**
     * Handle the expense "force deleted" event.
     *
     * @param  \App\Expense  $expense
     * @return void
     */
    public function forceDeleted(Expense $expense)
    {
        AllTransaction::where('expenses_id',  $expense->id)->forceDelete();
    }
}
