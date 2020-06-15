<?php

namespace App\Observers;

use App\AllTransaction;
use App\StockAdjustment;
use App\StockAdjustmentItem;

class StockAdjustmentObserver
{

    public function created(StockAdjustment $stockAdjustment)
    {
        if($stockAdjustment->recover_amount > 0){
            $all_transaction = new AllTransaction();
            $all_transaction->stock_adjustments_id = $stockAdjustment->id;
            $all_transaction->transaction_point = 'Stock Adjustment';
            $all_transaction->transaction_type = 'IN';
            $all_transaction->source_type = 'Recover';
            $all_transaction->amount = $stockAdjustment->recover_amount;
            $all_transaction->warehouses_id = $stockAdjustment->warehouses_id;
            $all_transaction->save();
        }
    }

    public function updated(StockAdjustment $stockAdjustment)
    {
        if($stockAdjustment->recover_amount > 0){
            AllTransaction::updateOrCreate([
                'stock_adjustments_id' => $stockAdjustment->id, 'transaction_point' => 'Stock Adjustment', 'source_type' => 'Recover'
            ], [
                'amount' => $stockAdjustment->recover_amount,
                'warehouses_id' => $stockAdjustment->warehouses_id
            ]);
        }else{
            AllTransaction::where('stock_adjustments_id', $stockAdjustment->id)->where('transaction_point', 'Stock Adjustment')->forceDelete();
        }
    }

    public function deleted(StockAdjustment $stockAdjustment)
    {
        StockAdjustmentItem::where('stock_adjustments_id', $stockAdjustment->id)->delete();
        AllTransaction::where('stock_adjustments_id', $stockAdjustment->id)->where('transaction_point', 'Stock Adjustment')->delete();
    }

    public function restored(StockAdjustment $stockAdjustment)
    {
        StockAdjustmentItem::onlyTrashed()->where('stock_adjustments_id', $stockAdjustment->id)->restore();
        AllTransaction::onlyTrashed()->where('stock_adjustments_id', $stockAdjustment->id)->where('transaction_point', 'Stock Adjustment')->restore();
    }

    public function forceDeleted(StockAdjustment $stockAdjustment)
    {
        StockAdjustmentItem::where('stock_adjustments_id', $stockAdjustment->id)->forceDelete();
        AllTransaction::where('stock_adjustments_id', $stockAdjustment->id)->where('transaction_point', 'Stock Adjustment')->forceDelete();
    }
}
