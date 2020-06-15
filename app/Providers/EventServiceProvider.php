<?php

namespace App\Providers;

use App\AccountBook;
use App\Agent;
use App\AgentTransaction;
use App\AllTransaction;
use App\Brand;
use App\Company;
use App\Customer;
use App\CustomerCategory;
use App\CustomerTransaction;
use App\Discount;
use App\Division;
use App\Expense;
use App\ExpenseCategory;
use App\InvoiceItem;
use App\Observers\CommonObserver;
use App\Product;
use App\ProductCategory;
use App\ProductReturn;
use App\ProductReturnItem;
use App\PurchaseInvoice;
use App\PurchaseItem;
use App\PurchaseTransaction;
use App\RolesAccess;
use App\SellInvoice;
use App\SellTransaction;
use App\Shipment;
use App\StockAdjustment;
use App\StockAdjustmentItem;
use App\StockTransaction;
use App\Supplier;
use App\SupplierCategory;
use App\SupplierTransaction;
use App\Union;
use App\Units;
use App\UpaZilla;
use App\UserRoles;
use App\VatTaxTransaction;
use App\VetTex;
use App\Warehouse;
use App\Zilla;
use App\Zone;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Brand::observe(CommonObserver::class);
        AccountBook::observe(CommonObserver::class);
        Agent::observe(CommonObserver::class);
        AgentTransaction::observe(CommonObserver::class);
        AllTransaction::observe(CommonObserver::class);
        Company::observe(CommonObserver::class);
        Customer::observe(CommonObserver::class);
        CustomerCategory::observe(CommonObserver::class);
        CustomerTransaction::observe(CommonObserver::class);
        Discount::observe(CommonObserver::class);
        Division::observe(CommonObserver::class);
        Expense::observe(CommonObserver::class);
        ExpenseCategory::observe(CommonObserver::class);
        InvoiceItem::observe(CommonObserver::class);
        Product::observe(CommonObserver::class);
        ProductCategory::observe(CommonObserver::class);
        ProductReturn::observe(CommonObserver::class);
        ProductReturnItem::observe(CommonObserver::class);
        PurchaseInvoice::observe(CommonObserver::class);
        PurchaseItem::observe(CommonObserver::class);
        PurchaseTransaction::observe(CommonObserver::class);
        RolesAccess::observe(CommonObserver::class);
        SellInvoice::observe(CommonObserver::class);
        SellTransaction::observe(CommonObserver::class);
        Shipment::observe(CommonObserver::class);
        StockTransaction::observe(CommonObserver::class);
        StockAdjustment::observe(CommonObserver::class);
        StockAdjustmentItem::observe(CommonObserver::class);
        Supplier::observe(CommonObserver::class);
        SupplierCategory::observe(CommonObserver::class);
        SupplierTransaction::observe(CommonObserver::class);
        Union::observe(CommonObserver::class);
        Units::observe(CommonObserver::class);
        UpaZilla::observe(CommonObserver::class);
        UserRoles::observe(CommonObserver::class);//Comment on seeder
        VatTaxTransaction::observe(CommonObserver::class);
        VetTex::observe(CommonObserver::class);
        Warehouse::observe(CommonObserver::class);
        Zilla::observe(CommonObserver::class);
        Zone::observe(CommonObserver::class);
    }
}
