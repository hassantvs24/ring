<?php

namespace App;

use App\Scopes\BusinessScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $zones_id
 * @property integer $unions_id
 * @property integer $upa_zillas_id
 * @property integer $zillas_id
 * @property integer $divisions_id
 * @property integer $vet_texes_id
 * @property integer $customer_categories_id
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
 * @property string $image
 * @property string $pay_term
 * @property float $credit_limit
 * @property float $balance
 * @property float $sells_target
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Business $business
 * @property CustomerCategory $customerCategory
 * @property Division $division
 * @property Union $union
 * @property UpaZilla $upaZilla
 * @property User $user
 * @property VetTex $vetTex
 * @property Warehouse $warehouse
 * @property Zilla $zilla
 * @property Zone $zone
 * @property CustomerTransaction[] $customerTransactions
 * @property ProductReturn[] $productReturns
 * @property SellInvoice[] $sellInvoices
 * @property SellTransaction[] $sellTransactions
 */
class Customer extends Model
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
    protected $fillable = ['zones_id', 'unions_id', 'upa_zillas_id', 'zillas_id', 'divisions_id', 'vet_texes_id', 'customer_categories_id', 'warehouses_id', 'business_id', 'users_id', 'name', 'code', 'address', 'email', 'contact', 'phone', 'alternate_contact', 'description', 'image', 'pay_term', 'credit_limit', 'balance', 'sells_target', 'deleted_at', 'created_at', 'updated_at'];

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
    public function customerCategory()
    {
        return $this->belongsTo('App\CustomerCategory', 'customer_categories_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function division()
    {
        return $this->belongsTo('App\Division', 'divisions_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function union()
    {
        return $this->belongsTo('App\Union', 'unions_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function upaZilla()
    {
        return $this->belongsTo('App\UpaZilla', 'upa_zillas_id');
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zilla()
    {
        return $this->belongsTo('App\Zilla', 'zillas_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zone()
    {
        return $this->belongsTo('App\Zone', 'zones_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customerTransactions()
    {
        return $this->hasMany('App\CustomerTransaction', 'customers_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productReturns()
    {
        return $this->hasMany('App\ProductReturn', 'customers_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sellInvoices()
    {
        return $this->hasMany('App\SellInvoice', 'customers_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sellTransactions()
    {
        return $this->hasMany('App\SellTransaction', 'customers_id');
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
