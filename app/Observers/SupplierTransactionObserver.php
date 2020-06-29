<?php

namespace App\Observers;

use App\AllTransaction;
use App\SupplierTransaction;

class SupplierTransactionObserver
{
    /**
     * Handle the supplier transaction "created" event.
     *
     * @param  \App\SupplierTransaction  $supplierTransaction
     * @return void
     */
    public function created(SupplierTransaction $supplierTransaction)
    {
        if($supplierTransaction->amount > 0){
            $all_transaction = new AllTransaction();
            $all_transaction->transaction_point = 'Supplier';
            $all_transaction->transaction_type = 'OUT';
            $all_transaction->supplier_transactions_id = $supplierTransaction->id;
            $all_transaction->amount = $supplierTransaction->amount;
            $all_transaction->payment_method = $supplierTransaction->payment_method;
            $all_transaction->cheque_number = $supplierTransaction->cheque_number;
            $all_transaction->bank_account_no = $supplierTransaction->bank_account_no;
            $all_transaction->transaction_no = $supplierTransaction->transaction_no;
            $all_transaction->description = $supplierTransaction->description;
            $all_transaction->warehouses_id = $supplierTransaction->warehouses_id;
            $all_transaction->created_at = $supplierTransaction->created_at;
            $all_transaction->save();
        }
    }

    /**
     * Handle the supplier transaction "updated" event.
     *
     * @param  \App\SupplierTransaction  $supplierTransaction
     * @return void
     */
    public function updated(SupplierTransaction $supplierTransaction)
    {
        if($supplierTransaction->amount > 0){
            AllTransaction::where('supplier_transactions_id', $supplierTransaction->id)->where('transaction_point', 'Supplier')->update([
                'amount' => $supplierTransaction->amount,
                'payment_method' => $supplierTransaction->payment_method,
                'cheque_number' => $supplierTransaction->cheque_number,
                'bank_account_no' => $supplierTransaction->bank_account_no,
                'transaction_no' => $supplierTransaction->transaction_no,
                'description' => $supplierTransaction->description,
                'warehouses_id' => $supplierTransaction->warehouses_id,
                'created_at' => $supplierTransaction->created_at
            ]);
        }else{
            AllTransaction::where('supplier_transactions_id', $supplierTransaction->id)->where('transaction_point', 'Supplier')->forceDelete();
        }
    }

    /**
     * Handle the supplier transaction "deleted" event.
     *
     * @param  \App\SupplierTransaction  $supplierTransaction
     * @return void
     */
    public function deleted(SupplierTransaction $supplierTransaction)
    {
        AllTransaction::where('supplier_transactions_id', $supplierTransaction->id)->where('transaction_point', 'Supplier')->delete();
    }

    /**
     * Handle the supplier transaction "restored" event.
     *
     * @param  \App\SupplierTransaction  $supplierTransaction
     * @return void
     */
    public function restored(SupplierTransaction $supplierTransaction)
    {
        AllTransaction::onlyTrashed()->where('supplier_transactions_id', $supplierTransaction->id)->where('transaction_point', 'Supplier')->restore();
    }

    /**
     * Handle the supplier transaction "force deleted" event.
     *
     * @param  \App\SupplierTransaction  $supplierTransaction
     * @return void
     */
    public function forceDeleted(SupplierTransaction $supplierTransaction)
    {
        AllTransaction::where('supplier_transactions_id', $supplierTransaction->id)->where('transaction_point', 'Supplier')->forceDelete();
    }
}
