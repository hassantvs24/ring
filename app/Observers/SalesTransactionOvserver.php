<?php

namespace App\Observers;

use App\AllTransaction;
use App\CustomerTransaction;
use App\SellTransaction;

class SalesTransactionOvserver
{
    /**
     * Handle the sell transaction "created" event.
     *
     * @param  \App\SellTransaction  $sellTransaction
     * @return void
     */
    public function created(SellTransaction $sellTransaction)
    {
        if($sellTransaction->amount > 0){
            $customerTransaction = new CustomerTransaction();
            $customerTransaction->customers_id = $sellTransaction->customers_id;
            $customerTransaction->payment_type = 'Sells Payment';
            $customerTransaction->transaction_type = 'OUT';
            $customerTransaction->amount = $sellTransaction->amount;
            $customerTransaction->payment_method = $sellTransaction->payment_method;
            $customerTransaction->cheque_number = $sellTransaction->cheque_number;
            $customerTransaction->bank_account_no = $sellTransaction->bank_account_no;
            $customerTransaction->transaction_no = $sellTransaction->transaction_no;
            $customerTransaction->description = $sellTransaction->description;
            $customerTransaction->account_books_id = $sellTransaction->account_books_id;
            $customerTransaction->sell_transactions_id = $sellTransaction->id;
            $customerTransaction->sell_invoices_id = $sellTransaction->sell_invoices_id;
            $customerTransaction->status = $sellTransaction->status;
            $customerTransaction->warehouses_id = $sellTransaction->warehouses_id;
            $customerTransaction->created_at = $sellTransaction->created_at;
            $customerTransaction->save();
            $customerTransaction_id = $customerTransaction->id;

            $all_transaction = new AllTransaction();
            $all_transaction->transaction_point = 'Sells';
            $all_transaction->transaction_type = 'IN';
            $all_transaction->amount = $sellTransaction->amount;
            $all_transaction->payment_method = $sellTransaction->payment_method;
            $all_transaction->cheque_number = $sellTransaction->cheque_number;
            $all_transaction->bank_account_no = $sellTransaction->bank_account_no;
            $all_transaction->transaction_no = $sellTransaction->transaction_no;
            $all_transaction->description = $sellTransaction->description;
            $all_transaction->account_books_id = $sellTransaction->account_books_id;
            $all_transaction->sell_transactions_id = $sellTransaction->id;
            $all_transaction->status = $sellTransaction->status;
            $all_transaction->customer_transactions_id = $customerTransaction_id;
            $all_transaction->warehouses_id = $sellTransaction->warehouses_id;
            $all_transaction->created_at = $sellTransaction->created_at;
            $all_transaction->save();
        }
    }

    /**
     * Handle the sell transaction "updated" event.
     *
     * @param  \App\SellTransaction  $sellTransaction
     * @return void
     */
    public function updated(SellTransaction $sellTransaction)
    {
        if($sellTransaction->amount > 0){
            CustomerTransaction::where('sell_transactions_id', $sellTransaction->id)->where('payment_type', 'Sells Payment')->update([
                'amount' => $sellTransaction->amount,
                'customers_id' => $sellTransaction->customers_id,
                'payment_method' => $sellTransaction->payment_method,
                'cheque_number' => $sellTransaction->cheque_number,
                'bank_account_no' => $sellTransaction->bank_account_no,
                'transaction_no' => $sellTransaction->transaction_no,
                'description' => $sellTransaction->description,
                'account_books_id' => $sellTransaction->account_books_id,
                'sell_invoices_id' => $sellTransaction->sell_invoices_id,
                'status' => $sellTransaction->status,
                'warehouses_id' => $sellTransaction->warehouses_id,
                'created_at' => $sellTransaction->created_at
            ]);

            AllTransaction::where('sell_transactions_id', $sellTransaction->id)->update([
                'amount' => $sellTransaction->amount,
                'payment_method' => $sellTransaction->payment_method,
                'cheque_number' => $sellTransaction->cheque_number,
                'bank_account_no' => $sellTransaction->bank_account_no,
                'transaction_no' => $sellTransaction->transaction_no,
                'description' => $sellTransaction->description,
                'account_books_id' => $sellTransaction->account_books_id,
                'status' => $sellTransaction->status,
                'warehouses_id' => $sellTransaction->warehouses_id,
                'created_at' => $sellTransaction->created_at
            ]);
        }else{
            CustomerTransaction::where('sell_transactions_id', $sellTransaction->id)->where('payment_type', 'Sells Payment')->forceDelete();
            AllTransaction::where('sell_transactions_id', $sellTransaction->id)->forceDelete();
        }
    }

    /**
     * Handle the sell transaction "deleted" event.
     *
     * @param  \App\SellTransaction  $sellTransaction
     * @return void
     */
    public function deleted(SellTransaction $sellTransaction)
    {
        CustomerTransaction::where('sell_transactions_id', $sellTransaction->id)->where('payment_type', 'Sells Payment')->delete();
        AllTransaction::where('sell_transactions_id', $sellTransaction->id)->delete();
    }

    /**
     * Handle the sell transaction "restored" event.
     *
     * @param  \App\SellTransaction  $sellTransaction
     * @return void
     */
    public function restored(SellTransaction $sellTransaction)
    {
        CustomerTransaction::onlyTrashed()->where('sell_transactions_id', $sellTransaction->id)->where('payment_type', 'Sells Payment')->restore();
        AllTransaction::onlyTrashed()->where('sell_transactions_id', $sellTransaction->id)->restore();
    }

    /**
     * Handle the sell transaction "force deleted" event.
     *
     * @param  \App\SellTransaction  $sellTransaction
     * @return void
     */
    public function forceDeleted(SellTransaction $sellTransaction)
    {
        CustomerTransaction::where('sell_transactions_id', $sellTransaction->id)->where('payment_type', 'Sells Payment')->forceDelete();
        AllTransaction::where('sell_transactions_id', $sellTransaction->id)->forceDelete();
    }
}
