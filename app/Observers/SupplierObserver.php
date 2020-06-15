<?php

namespace App\Observers;

use App\AllTransaction;
use App\Supplier;
use App\SupplierTransaction;

class SupplierObserver
{
    /**
     * Handle the supplier "created" event.
     *
     * @param  \App\Supplier  $supplier
     * @return void
     */

    public function created(Supplier $supplier)
    {
        if($supplier->balance > 0){
            $supplierTransaction = new SupplierTransaction();
            $supplierTransaction->suppliers_id = $supplier->id;
            $supplierTransaction->payment_type = 'Opening Balance';
            $supplierTransaction->transaction_type = 'OUT';
            $supplierTransaction->amount = $supplier->balance;
            $supplierTransaction->warehouses_id = $supplier->warehouses_id;
            $supplierTransaction->save();
            $supplier_transactions_id = $supplierTransaction->id;


            $all_transaction = new AllTransaction();
            $all_transaction->supplier_transactions_id = $supplier_transactions_id;
            $all_transaction->transaction_point = 'Supplier';
            $all_transaction->transaction_type = 'IN';
            $all_transaction->source_type = 'Opening';
            $all_transaction->amount = $supplier->balance;
            $all_transaction->warehouses_id = $supplier->warehouses_id;
            $all_transaction->save();
        }
    }

    /**
     * Handle the supplier "updated" event.
     *
     * @param  \App\Supplier  $supplier
     * @return void
     */

    public function updated(Supplier $supplier)
    {
        if($supplier->balance > 0) {
            $supplierTransaction = SupplierTransaction::updateOrCreate(
                ['suppliers_id' => $supplier->id, 'payment_type' => 'Opening Balance'],
                [
                    'amount' => $supplier->balance,
                    'warehouses_id' => $supplier->warehouses_id
                ]
            );

            AllTransaction::updateOrCreate([
                'supplier_transactions_id' => $supplierTransaction->id, 'transaction_point' => 'Supplier', 'source_type' => 'Opening'
            ], [
                'amount' => $supplier->balance,
                'warehouses_id' => $supplier->warehouses_id
            ]);
        }else{
            $supplierTransaction = SupplierTransaction::where('suppliers_id',  $supplier->id)->where('payment_type', 'Opening Balance')->first();
            SupplierTransaction::where('suppliers_id',  $supplier->id)->where('payment_type', 'Opening Balance')->forceDelete();

            AllTransaction::where('supplier_transactions_id',  $supplierTransaction->id)->where('transaction_point', 'Supplier')->where('source_type', 'Opening')->forceDelete();
        }
    }

    /**
     * Handle the supplier "deleted" event.
     *
     * @param  \App\Supplier  $supplier
     * @return void
     */

    public function deleted(Supplier $supplier)
    {
        $supplierTransaction = SupplierTransaction::where('suppliers_id',  $supplier->id)->where('payment_type', 'Opening Balance')->first();
        SupplierTransaction::where('suppliers_id',  $supplier->id)->where('payment_type', 'Opening Balance')->delete();
        AllTransaction::where('supplier_transactions_id',  $supplierTransaction->id)->where('transaction_point', 'Supplier')->where('source_type', 'Opening')->delete();
    }

    /**
     * Handle the supplier "restored" event.
     *
     * @param  \App\Supplier  $supplier
     * @return void
     */

    public function restored(Supplier $supplier)
    {
        $supplierTransaction = SupplierTransaction::onlyTrashed()->where('suppliers_id',  $supplier->id)->where('payment_type', 'Opening Balance')->first();
        SupplierTransaction::onlyTrashed()->where('suppliers_id',  $supplier->id)->where('payment_type', 'Opening Balance')->restore();
        AllTransaction::onlyTrashed()->where('supplier_transactions_id',  $supplierTransaction->id)->where('transaction_point', 'Supplier')->where('source_type', 'Opening')->restore();
    }

    /**
     * Handle the supplier "force deleted" event.
     *
     * @param  \App\Supplier  $supplier
     * @return void
     */

    public function forceDeleted(Supplier $supplier)
    {
        $supplierTransaction = SupplierTransaction::onlyTrashed()->where('suppliers_id',  $supplier->id)->where('payment_type', 'Opening Balance')->first();
        SupplierTransaction::where('suppliers_id',  $supplier->id)->where('payment_type', 'Opening Balance')->forceDelete();
        AllTransaction::where('supplier_transactions_id',  $supplierTransaction->id)->where('transaction_point', 'Supplier')->where('source_type', 'Opening')->forceDelete();
    }
}
