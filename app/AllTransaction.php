<?php

namespace App;

use App\Scopes\BusinessScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $expenses_id
 * @property integer $sell_transactions_id
 * @property integer $purchase_transactions_id
 * @property integer $stock_transfers_id
 * @property integer $agent_transactions_id
 * @property integer $vat_tax_transactions_id
 * @property integer $customer_transactions_id
 * @property integer $supplier_transactions_id
 * @property integer $warehouses_id
 * @property integer $account_books_id
 * @property integer $business_id
 * @property integer $users_id
 * @property string $transaction_point
 * @property string $transaction_type
 * @property string $source_type
 * @property float $amount
 * @property string $payment_method
 * @property string $card_number
 * @property string $card_holder_name
 * @property string $card_transaction_no
 * @property string $card_type
 * @property string $card_month
 * @property integer $card_year
 * @property integer $csv
 * @property string $cheque_number
 * @property string $bank_account_no
 * @property string $transaction_no
 * @property mixed $description
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property AccountBook $accountBook
 * @property AgentTransaction $agentTransaction
 * @property Business $business
 * @property CustomerTransaction $customerTransaction
 * @property Expense $expense
 * @property PurchaseTransaction $purchaseTransaction
 * @property SellTransaction $sellTransaction
 * @property StockTransfer $stockTransfer
 * @property SupplierTransaction $supplierTransaction
 * @property User $users
 * @property VatTaxTransaction $vatTaxTransaction
 * @property Warehouse $warehouse
 */
class AllTransaction extends Model
{
   // use SoftDeletes;
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['status', 'expenses_id', 'sell_transactions_id', 'purchase_transactions_id', 'stock_transfers_id', 'agent_transactions_id', 'vat_tax_transactions_id', 'customer_transactions_id', 'supplier_transactions_id', 'warehouses_id', 'account_books_id', 'business_id', 'users_id', 'transaction_point', 'transaction_type', 'source_type', 'amount', 'payment_method', 'card_number', 'card_holder_name', 'card_transaction_no', 'card_type', 'card_month', 'card_year', 'csv', 'cheque_number', 'bank_account_no', 'transaction_no', 'description', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accountBook()
    {
        return $this->belongsTo('App\AccountBook', 'account_books_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agentTransaction()
    {
        return $this->belongsTo('App\AgentTransaction', 'agent_transactions_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function business()
    {
        return $this->belongsTo('App\Business');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customerTransaction()
    {
        return $this->belongsTo('App\CustomerTransaction', 'customer_transactions_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function expense()
    {
        return $this->belongsTo('App\Expense', 'expenses_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchaseTransaction()
    {
        return $this->belongsTo('App\PurchaseTransaction', 'purchase_transactions_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellTransaction()
    {
        return $this->belongsTo('App\SellTransaction', 'sell_transactions_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stockTransfer()
    {
        return $this->belongsTo('App\StockTransfer', 'stock_transfers_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplierTransaction()
    {
        return $this->belongsTo('App\SupplierTransaction', 'supplier_transactions_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vatTaxTransaction()
    {
        return $this->belongsTo('App\VatTaxTransaction', 'vat_tax_transactions_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse', 'warehouses_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BusinessScope);
    }
}
