<?php

namespace App;

use App\Scopes\BusinessScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * @property integer $id
 * @property integer $suppliers_id
 * @property integer $shipments_id
 * @property integer $discounts_id
 * @property integer $vet_texes_id
 * @property integer $warehouses_id
 * @property integer $business_id
 * @property integer $users_id
 * @property string $code
 * @property string $name
 * @property string $address
 * @property string $email
 * @property string $contact
 * @property string $status
 * @property float $labor_cost
 * @property float $discount_amount
 * @property float $vet_texes_amount
 * @property float $shipping_charges
 * @property float $additional_charges
 * @property float $due_date
 * @property mixed $description
 * @property string $documents
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Business $business
 * @property Discount $discount
 * @property Shipment $shipment
 * @property Supplier $supplier
 * @property User $user
 * @property VetTex $vetTex
 * @property Warehouse $warehouse
 * @property ProductReturn[] $productReturns
 * @property PurchaseItem[] $purchaseItems
 * @property PurchaseTransaction[] $purchaseTransactions
 * @property SupplierTransaction[] $supplierTransactions
 */
class PurchaseInvoice extends Model
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
    protected $fillable = ['suppliers_id', 'shipments_id', 'discounts_id', 'vet_texes_id', 'warehouses_id', 'business_id', 'users_id', 'code', 'name', 'address', 'email', 'contact', 'status', 'labor_cost', 'discount_amount', 'vet_texes_amount', 'shipping_charges', 'additional_charges', 'due_date', 'description', 'documents', 'deleted_at', 'created_at', 'updated_at'];

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
    public function discount()
    {
        return $this->belongsTo('App\Discount', 'discounts_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shipment()
    {
        return $this->belongsTo('App\Shipment', 'shipments_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo('App\Supplier', 'suppliers_id');
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
        return $this->hasMany('App\ProductReturn', 'purchase_invoices_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchaseItems()
    {
        return $this->hasMany('App\PurchaseItem', 'purchase_invoices_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchaseTransactions()
    {
        return $this->hasMany('App\PurchaseTransaction', 'purchase_invoices_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function supplierTransactions()
    {
        return $this->hasMany('App\SupplierTransaction', 'purchase_invoices_id');
    }


    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = db_date($value);
    }



    public function invoice_total(){
        $total = $this->purchaseItems()->sum(DB::raw('quantity * amount'));
        return $total;
    }

    public function invoice_paid(){
        $total = $this->purchaseTransactions()->sum('amount');
        return $total;
    }

    public function invoice_sub_total(){
        $total = $this->invoice_total();
        return $total + $this->additional_charges + $this->vet_texes_amount - $this->discount_amount;
    }

    public function invoice_due(){
        return $this->invoice_sub_total() - $this->invoice_paid();
    }





    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BusinessScope);
    }
}
