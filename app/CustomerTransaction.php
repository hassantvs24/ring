<?php

namespace App;

use App\Scopes\BusinessScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $sell_transactions_id
 * @property integer $sell_invoices_id
 * @property integer $warehouses_id
 * @property integer $account_books_id
 * @property integer $customers_id
 * @property integer $business_id
 * @property integer $users_id
 * @property string $payment_type
 * @property string $transaction_type
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
 * @property Business $business
 * @property Customer $customer
 * @property SellInvoice $sellInvoice
 * @property SellTransaction $sellTransaction
 * @property User $user
 * @property Warehouse $warehouse
 * @property AllTransaction[] $allTransactions
 */
class CustomerTransaction extends Model
{
    //use SoftDeletes;
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['status', 'sell_transactions_id', 'sell_invoices_id', 'warehouses_id', 'account_books_id', 'customers_id', 'business_id', 'users_id', 'payment_type', 'transaction_type', 'amount', 'payment_method', 'card_number', 'card_holder_name', 'card_transaction_no', 'card_type', 'card_month', 'card_year', 'csv', 'cheque_number', 'bank_account_no', 'transaction_no', 'description', 'deleted_at', 'created_at', 'updated_at'];

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
    public function business()
    {
        return $this->belongsTo('App\Business');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customers_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellInvoice()
    {
        return $this->belongsTo('App\SellInvoice', 'sell_invoices_id');
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
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse', 'warehouses_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function allTransactions()
    {
        return $this->hasMany('App\AllTransaction', 'customer_transactions_id');
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = db_date($value);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BusinessScope);
    }
}
