<?php

namespace App;

use App\Scopes\BusinessScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $warehouses_id
 * @property integer $business_id
 * @property integer $users_id
 * @property string $name
 * @property string $account_number
 * @property mixed $description
 * @property boolean $status
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Business $business
 * @property User $user
 * @property Warehouse $warehouse
 * @property AgentTransaction[] $agentTransactions
 * @property AllTransaction[] $allTransactions
 * @property CustomerTransaction[] $customerTransactions
 * @property PurchaseTransaction[] $purchaseTransactions
 * @property SellTransaction[] $sellTransactions
 * @property SupplierTransaction[] $supplierTransactions
 * @property VatTaxTransaction[] $vatTaxTransactions
 */
class AccountBook extends Model
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
    protected $fillable = ['warehouses_id', 'business_id', 'users_id', 'name', 'account_number', 'description', 'status', 'deleted_at', 'created_at', 'updated_at'];

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
    public function agentTransactions()
    {
        return $this->hasMany('App\AgentTransaction', 'account_books_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function allTransactions()
    {
        return $this->hasMany('App\AllTransaction', 'account_books_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customerTransactions()
    {
        return $this->hasMany('App\CustomerTransaction', 'account_books_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchaseTransactions()
    {
        return $this->hasMany('App\PurchaseTransaction', 'account_books_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sellTransactions()
    {
        return $this->hasMany('App\SellTransaction', 'account_books_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function supplierTransactions()
    {
        return $this->hasMany('App\SupplierTransaction', 'account_books_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vatTaxTransactions()
    {
        return $this->hasMany('App\VatTaxTransaction', 'account_books_id');
    }


    /**
     * Add Global Scope where selected business id getting from Auth
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BusinessScope);
    }
}
