<?php

namespace App\Observers;

use App\PurchaseInvoice;
use App\PurchaseItem;
use App\PurchaseTransaction;

class PurchaseObserver
{
    /**
     * Handle the purchase invoice "created" event.
     *
     * @param  \App\PurchaseInvoice  $purchaseInvoice
     * @return void
     */
    public function created(PurchaseInvoice $purchaseInvoice)
    {
        //
    }

    /**
     * Handle the purchase invoice "updated" event.
     *
     * @param  \App\PurchaseInvoice  $purchaseInvoice
     * @return void
     */
    public function updated(PurchaseInvoice $purchaseInvoice)
    {
        //
    }

    /**
     * Handle the purchase invoice "deleted" event.
     *
     * @param  \App\PurchaseInvoice  $purchaseInvoice
     * @return void
     */
    public function deleted(PurchaseInvoice $purchaseInvoice)
    {
        PurchaseItem::where('purchase_invoices_id', $purchaseInvoice->id)->delete();
        PurchaseTransaction::where('purchase_invoices_id', $purchaseInvoice->id)->delete();
    }

    /**
     * Handle the purchase invoice "restored" event.
     *
     * @param  \App\PurchaseInvoice  $purchaseInvoice
     * @return void
     */
    public function restored(PurchaseInvoice $purchaseInvoice)
    {
        PurchaseItem::onlyTrashed()->where('purchase_invoices_id', $purchaseInvoice->id)->restore();
        PurchaseTransaction::onlyTrashed()->where('purchase_invoices_id', $purchaseInvoice->id)->restore();
    }

    /**
     * Handle the purchase invoice "force deleted" event.
     *
     * @param  \App\PurchaseInvoice  $purchaseInvoice
     * @return void
     */
    public function forceDeleted(PurchaseInvoice $purchaseInvoice)
    {
        PurchaseItem::where('purchase_invoices_id', $purchaseInvoice->id)->forceDelete();
        PurchaseTransaction::where('purchase_invoices_id', $purchaseInvoice->id)->forceDelete();
    }
}
