<?php

namespace App\Observers;

use App\InvoiceItem;
use App\SellInvoice;
use App\SellTransaction;

class SalesOvserver
{
    /**
     * Handle the sell invoice "created" event.
     *
     * @param  \App\SellInvoice  $sellInvoice
     * @return void
     */
    public function created(SellInvoice $sellInvoice)
    {
        //
    }

    /**
     * Handle the sell invoice "updated" event.
     *
     * @param  \App\SellInvoice  $sellInvoice
     * @return void
     */
    public function updated(SellInvoice $sellInvoice)
    {
        //
    }

    /**
     * Handle the sell invoice "deleted" event.
     *
     * @param  \App\SellInvoice  $sellInvoice
     * @return void
     */
    public function deleted(SellInvoice $sellInvoice)
    {
        InvoiceItem::where('sell_invoices_id', $sellInvoice->id)->delete();
        SellTransaction::where('sell_invoices_id', $sellInvoice->id)->delete();
    }

    /**
     * Handle the sell invoice "restored" event.
     *
     * @param  \App\SellInvoice  $sellInvoice
     * @return void
     */
    public function restored(SellInvoice $sellInvoice)
    {
        InvoiceItem::onlyTrashed()->where('sell_invoices_id', $sellInvoice->id)->restore();
        SellTransaction::onlyTrashed()->where('sell_invoices_id', $sellInvoice->id)->restore();
    }

    /**
     * Handle the sell invoice "force deleted" event.
     *
     * @param  \App\SellInvoice  $sellInvoice
     * @return void
     */
    public function forceDeleted(SellInvoice $sellInvoice)
    {
        InvoiceItem::where('sell_invoices_id', $sellInvoice->id)->forceDelete();
        SellTransaction::where('sell_invoices_id', $sellInvoice->id)->forceDelete();
    }
}