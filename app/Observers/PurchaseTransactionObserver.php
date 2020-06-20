<?php

namespace App\Observers;

use App\AllTransaction;
use App\PurchaseTransaction;
use App\SupplierTransaction;

class PurchaseTransactionObserver
{
    /**
     * Handle the purchase transaction "created" event.
     *
     * @param  \App\PurchaseTransaction  $purchaseTransaction
     * @return void
     */
    public function created(PurchaseTransaction $purchaseTransaction)
    {
        if($purchaseTransaction->amount > 0){
            $supplierTransaction = new SupplierTransaction();
            $supplierTransaction->suppliers_id = $purchaseTransaction->suppliers_id;
            $supplierTransaction->payment_type = 'Purchase Payment';
            $supplierTransaction->transaction_type = 'IN';
            $supplierTransaction->amount = $purchaseTransaction->amount;
            $supplierTransaction->payment_method = $purchaseTransaction->payment_method;
            $supplierTransaction->cheque_number = $purchaseTransaction->cheque_number;
            $supplierTransaction->bank_account_no = $purchaseTransaction->bank_account_no;
            $supplierTransaction->transaction_no = $purchaseTransaction->transaction_no;
            $supplierTransaction->description = $purchaseTransaction->description;
            $supplierTransaction->account_books_id = $purchaseTransaction->account_books_id;
            $supplierTransaction->purchase_transactions_id = $purchaseTransaction->id;
            $supplierTransaction->purchase_invoices_id = $purchaseTransaction->purchase_invoices_id;
            $supplierTransaction->status = $purchaseTransaction->status;
            $supplierTransaction->warehouses_id = $purchaseTransaction->warehouses_id;
            $supplierTransaction->created_at = $purchaseTransaction->created_at;
            $supplierTransaction->save();
            $supplierTransaction_id = $supplierTransaction->id;

            $all_transaction = new AllTransaction();
            $all_transaction->transaction_point = 'Purchase';
            $all_transaction->transaction_type = 'OUT';
            $all_transaction->amount = $purchaseTransaction->amount;
            $all_transaction->payment_method = $purchaseTransaction->payment_method;
            $all_transaction->cheque_number = $purchaseTransaction->cheque_number;
            $all_transaction->bank_account_no = $purchaseTransaction->bank_account_no;
            $all_transaction->transaction_no = $purchaseTransaction->transaction_no;
            $all_transaction->description = $purchaseTransaction->description;
            $all_transaction->account_books_id = $purchaseTransaction->account_books_id;
            $all_transaction->status = $purchaseTransaction->status;
            $all_transaction->purchase_transactions_id = $purchaseTransaction->id;
            $all_transaction->supplier_transactions_id = $supplierTransaction_id;
            $all_transaction->warehouses_id = $purchaseTransaction->warehouses_id;
            $all_transaction->created_at = $purchaseTransaction->created_at;
            $all_transaction->save();
        }
    }

    /**
     * Handle the purchase transaction "updated" event.
     *
     * @param  \App\PurchaseTransaction  $purchaseTransaction
     * @return void
     */
    public function updated(PurchaseTransaction $purchaseTransaction)
    {
        if($purchaseTransaction->amount > 0){
            SupplierTransaction::where('purchase_transactions_id', $purchaseTransaction->id)->where('payment_type', 'Purchase Payment')->update([
                'amount' => $purchaseTransaction->amount,
                'suppliers_id' => $purchaseTransaction->suppliers_id,
                'payment_method' => $purchaseTransaction->payment_method,
                'cheque_number' => $purchaseTransaction->cheque_number,
                'bank_account_no' => $purchaseTransaction->bank_account_no,
                'transaction_no' => $purchaseTransaction->transaction_no,
                'description' => $purchaseTransaction->description,
                'status' => $purchaseTransaction->status,
                'account_books_id' => $purchaseTransaction->account_books_id,
                'purchase_invoices_id' => $purchaseTransaction->purchase_invoices_id,
                'warehouses_id' => $purchaseTransaction->warehouses_id,
                'created_at' => $purchaseTransaction->created_at
            ]);

            AllTransaction::where('purchase_transactions_id', $purchaseTransaction->id)->update([
                'amount' => $purchaseTransaction->amount,
                'payment_method' => $purchaseTransaction->payment_method,
                'cheque_number' => $purchaseTransaction->cheque_number,
                'bank_account_no' => $purchaseTransaction->bank_account_no,
                'transaction_no' => $purchaseTransaction->transaction_no,
                'description' => $purchaseTransaction->description,
                'status' => $purchaseTransaction->status,
                'account_books_id' => $purchaseTransaction->account_books_id,
                'warehouses_id' => $purchaseTransaction->warehouses_id,
                'created_at' => $purchaseTransaction->created_at
            ]);
        }else{
            SupplierTransaction::where('purchase_transactions_id', $purchaseTransaction->id)->where('payment_type', 'Purchase Payment')->forceDelete();
            AllTransaction::where('purchase_transactions_id', $purchaseTransaction->id)->forceDelete();
        }
    }

    /**
     * Handle the purchase transaction "deleted" event.
     *
     * @param  \App\PurchaseTransaction  $purchaseTransaction
     * @return void
     */
    public function deleted(PurchaseTransaction $purchaseTransaction)
    {
        SupplierTransaction::where('purchase_transactions_id', $purchaseTransaction->id)->where('payment_type', 'Purchase Payment')->delete();
        AllTransaction::where('purchase_transactions_id', $purchaseTransaction->id)->delete();
    }

    /**
     * Handle the purchase transaction "restored" event.
     *
     * @param  \App\PurchaseTransaction  $purchaseTransaction
     * @return void
     */
    public function restored(PurchaseTransaction $purchaseTransaction)
    {
        SupplierTransaction::onlyTrashed()->where('purchase_transactions_id', $purchaseTransaction->id)->where('payment_type', 'Purchase Payment')->restore();
        AllTransaction::onlyTrashed()->where('purchase_transactions_id', $purchaseTransaction->id)->restore();
    }

    /**
     * Handle the purchase transaction "force deleted" event.
     *
     * @param  \App\PurchaseTransaction  $purchaseTransaction
     * @return void
     */
    public function forceDeleted(PurchaseTransaction $purchaseTransaction)
    {
        SupplierTransaction::where('purchase_transactions_id', $purchaseTransaction->id)->where('payment_type', 'Purchase Payment')->forceDelete();
        AllTransaction::where('purchase_transactions_id', $purchaseTransaction->id)->forceDelete();
    }
}
