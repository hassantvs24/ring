<?php

namespace App;

use App\Scopes\BusinessScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $vet_texes_id
 * @property integer $supplier_categories_id
 * @property integer $warehouses_id
 * @property integer $business_id
 * @property integer $users_id
 * @property string $name
 * @property string $code
 * @property string $address
 * @property string $email
 * @property string $contact
 * @property string $phone
 * @property string $alternate_contact
 * @property mixed $description
 * @property string $pay_term
 * @property float $credit_limit
 * @property float $balance
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Business $business
 * @property SupplierCategory $supplierCategory
 * @property User $user
 * @property VetTex $vetTex
 * @property Warehouse $warehouse
 * @property ProductReturn[] $productReturns
 * @property PurchaseInvoice[] $purchaseInvoices
 * @property PurchaseTransaction[] $purchaseTransactions
 * @property SupplierTransaction[] $supplierTransactions
 */
class Supplier extends Model
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
    protected $fillable = ['vet_texes_id', 'supplier_categories_id', 'warehouses_id', 'business_id', 'users_id', 'name', 'code', 'address', 'email', 'contact', 'phone', 'alternate_contact', 'description', 'pay_term', 'credit_limit', 'balance', 'deleted_at', 'created_at', 'updated_at'];

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
    public function supplierCategory()
    {
        return $this->belongsTo('App\SupplierCategory', 'supplier_categories_id');
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
    public function vetTex()
    {
        return $this->belongsTo('App\VetTex', 'vet_texes_id');
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
    public function productReturns()
    {
        return $this->hasMany('App\ProductReturn', 'suppliers_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchaseInvoices()
    {
        return $this->hasMany('App\PurchaseInvoice', 'suppliers_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchaseTransactions()
    {
        return $this->hasMany('App\PurchaseTransaction', 'suppliers_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function supplierTransactions()
    {
        return $this->hasMany('App\SupplierTransaction', 'suppliers_id');
    }

    public function dueBalance(){
        $opening_balance = $this->balance;

        return $opening_balance;
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BusinessScope);
    }
}
