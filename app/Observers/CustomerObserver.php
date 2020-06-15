<?php

namespace App\Observers;

use App\AllTransaction;
use App\Customer;
use App\CustomerTransaction;

class CustomerObserver
{
    /**
     * Handle the customer "created" event.
     *
     * @param  \App\Customer  $customer
     * @return void
     */
    public function created(Customer $customer)
    {
        if($customer->balance > 0){
            $customerTransaction = new CustomerTransaction();
            $customerTransaction->customers_id = $customer->id;
            $customerTransaction->payment_type = 'Opening Balance';
            $customerTransaction->transaction_type = 'IN';
            $customerTransaction->amount = $customer->balance;
            $customerTransaction->warehouses_id = $customer->warehouses_id;
            $customerTransaction->save();
            $customerTransaction_id = $customerTransaction->id;

            $all_transaction = new AllTransaction();
            $all_transaction->customer_transactions_id = $customerTransaction_id;
            $all_transaction->transaction_point = 'Customer';
            $all_transaction->transaction_type = 'IN';
            $all_transaction->source_type = 'Opening';
            $all_transaction->amount = $customer->balance;
            $all_transaction->warehouses_id = $customer->warehouses_id;
            $all_transaction->save();
        }
    }

    /**
     * Handle the customer "updated" event.
     *
     * @param  \App\Customer  $customer
     * @return void
     */
    public function updated(Customer $customer)
    {
        if($customer->balance > 0) {
            $customerTransaction = CustomerTransaction::updateOrCreate(
                ['customers_id' => $customer->id, 'payment_type' => 'Opening Balance'],
                [
                    'amount' => $customer->balance,
                    'warehouses_id' => $customer->warehouses_id
                ]
            );

            AllTransaction::updateOrCreate([
                'customer_transactions_id' => $customerTransaction->id, 'transaction_point' => 'Customer', 'source_type' => 'Opening'
            ], [
                'amount' => $customer->balance,
                'warehouses_id' => $customer->warehouses_id
            ]);
        }else{
            $customerTransaction = CustomerTransaction::where('customers_id',  $customer->id)->where('payment_type', 'Opening Balance')->first();
            CustomerTransaction::where('customers_id',  $customer->id)->where('payment_type', 'Opening Stock')->forceDelete();
            AllTransaction::where('customer_transactions_id',  $customerTransaction->id)->where('transaction_point', 'Customer')->where('source_type', 'Opening')->forceDelete();
        }
    }

    /**
     * Handle the customer "deleted" event.
     *
     * @param  \App\Customer  $customer
     * @return void
     */
    public function deleted(Customer $customer)
    {
        $customerTransaction = CustomerTransaction::where('customers_id',  $customer->id)->where('payment_type', 'Opening Balance')->first();
        CustomerTransaction::where('customers_id',  $customer->id)->where('payment_type', 'Opening Balance')->delete();
        AllTransaction::where('customer_transactions_id',  $customerTransaction->id)->where('transaction_point', 'Customer')->where('source_type', 'Opening')->delete();
    }

    /**
     * Handle the customer "restored" event.
     *
     * @param  \App\Customer  $customer
     * @return void
     */
    public function restored(Customer $customer)
    {
        $customerTransaction = CustomerTransaction::onlyTrashed()->where('customers_id',  $customer->id)->where('payment_type', 'Opening Balance')->first();
        CustomerTransaction::onlyTrashed()->where('customers_id',  $customer->id)->where('payment_type', 'Opening Balance')->restore();
        AllTransaction::where('customer_transactions_id',  $customerTransaction->id)->where('transaction_point', 'Customer')->where('source_type', 'Opening')->first();
    }

    /**
     * Handle the customer "force deleted" event.
     *
     * @param  \App\Customer  $customer
     * @return void
     */
    public function forceDeleted(Customer $customer)
    {
        $customerTransaction = CustomerTransaction::onlyTrashed()->where('customers_id',  $customer->id)->where('payment_type', 'Opening Balance')->first();
        CustomerTransaction::where('customers_id',  $customer->id)->where('payment_type', 'Opening Balance')->forceDelete();
        AllTransaction::where('customer_transactions_id',  $customerTransaction->id)->where('transaction_point', 'Customer')->where('source_type', 'Opening')->forceDelete();
    }
}
