<?php

namespace App\Observers;

use App\AllTransaction;
use App\CustomerTransaction;

class CustomerTransactionObserver
{
    /**
     * Handle the customer transaction "created" event.
     *
     * @param  \App\CustomerTransaction  $customerTransaction
     * @return void
     */
    public function created(CustomerTransaction $customerTransaction)
    {
        if($customerTransaction->amount > 0){
            $all_transaction = new AllTransaction();
            $all_transaction->transaction_point = 'Customer';
            $all_transaction->transaction_type = 'IN';
            $all_transaction->customer_transactions_id = $customerTransaction->id;
            $all_transaction->amount = $customerTransaction->amount;
            $all_transaction->payment_method = $customerTransaction->payment_method;
            $all_transaction->cheque_number = $customerTransaction->cheque_number;
            $all_transaction->bank_account_no = $customerTransaction->bank_account_no;
            $all_transaction->transaction_no = $customerTransaction->transaction_no;
            $all_transaction->description = $customerTransaction->description;
            $all_transaction->warehouses_id = $customerTransaction->warehouses_id;
            $all_transaction->created_at = $customerTransaction->created_at;
            $all_transaction->save();
        }
    }

    /**
     * Handle the customer transaction "updated" event.
     *
     * @param  \App\CustomerTransaction  $customerTransaction
     * @return void
     */
    public function updated(CustomerTransaction $customerTransaction)
    {
        if($customerTransaction->amount > 0){
            AllTransaction::where('customer_transactions_id', $customerTransaction->id)->where('transaction_point', 'Customer')->update([
                'amount' => $customerTransaction->amount,
                'payment_method' => $customerTransaction->payment_method,
                'cheque_number' => $customerTransaction->cheque_number,
                'bank_account_no' => $customerTransaction->bank_account_no,
                'transaction_no' => $customerTransaction->transaction_no,
                'description' => $customerTransaction->description,
                'warehouses_id' => $customerTransaction->warehouses_id,
                'created_at' => $customerTransaction->created_at
            ]);
        }else{
            AllTransaction::where('customer_transactions_id', $customerTransaction->id)->where('transaction_point', 'Customer')->forceDelete();
        }
    }

    /**
     * Handle the customer transaction "deleted" event.
     *
     * @param  \App\CustomerTransaction  $customerTransaction
     * @return void
     */
    public function deleted(CustomerTransaction $customerTransaction)
    {
        AllTransaction::where('customer_transactions_id', $customerTransaction->id)->where('transaction_point', 'Customer')->delete();
    }

    /**
     * Handle the customer transaction "restored" event.
     *
     * @param  \App\CustomerTransaction  $customerTransaction
     * @return void
     */
    public function restored(CustomerTransaction $customerTransaction)
    {
        AllTransaction::onlyTrashed()->where('customer_transactions_id', $customerTransaction->id)->where('transaction_point', 'Customer')->restore();
    }

    /**
     * Handle the customer transaction "force deleted" event.
     *
     * @param  \App\CustomerTransaction  $customerTransaction
     * @return void
     */
    public function forceDeleted(CustomerTransaction $customerTransaction)
    {
        AllTransaction::where('customer_transactions_id', $customerTransaction->id)->where('transaction_point', 'Customer')->forceDelete();
    }
}
