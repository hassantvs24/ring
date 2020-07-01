<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Business Setup',
            
            'Sales List',
            'Sales Create',
            'Sales Edit',
            'Sales Delete',

            'Purchase List',
            'Purchase Create',
            'Purchase Edit',
            'Purchase Delete',

            'Product List',
            'Product Create',
            'Product Edit',
            'Product Delete',

            'Stock-Adjustment List',
            'Stock-Adjustment Create',
            'Stock-Adjustment Edit',
            'Stock-Adjustment Delete',

            'Product-Category List',
            'Product-Category Create',
            'Product-Category Edit',
            'Product-Category Delete',

            'Product-Units List',
            'Product-Units Create',
            'Product-Units Edit',
            'Product-Units Delete',

            'Product-Company List',
            'Product-Company Create',
            'Product-Company Edit',
            'Product-Company Delete',

            'Product-Brand List',
            'Product-Brand Create',
            'Product-Brand Edit',
            'Product-Brand Delete',

            'Customer List',
            'Customer Create',
            'Customer Edit',
            'Customer Delete',

            'Customer-Category List',
            'Customer-Category Create',
            'Customer-Category Edit',
            'Customer-Category Delete',

            'Supplier List',
            'Supplier Create',
            'Supplier Edit',
            'Supplier Delete',

            'Supplier-Category List',
            'Supplier-Category Create',
            'Supplier-Category Edit',
            'Supplier-Category Delete',

            'Accounts List',
            'Accounts Create',
            'Accounts Edit',
            'Accounts Delete',

            'Expense List',
            'Expense Create',
            'Expense Edit',
            'Expense Delete',

            'Expense-Category List',
            'Expense-Category Create',
            'Expense-Category Edit',
            'Expense-Category Delete',

            'Role List',
            'Role Create',
            'Role Edit',
            'Role Delete',
            'Role Permission',

            'User List',
            'User Create',
            'User Edit',
            'User Delete',

            'Warehouse List',
            'Warehouse Create',
            'Warehouse Edit',
            'Warehouse Delete',

            'Discount List',
            'Discount Create',
            'Discount Edit',
            'Discount Delete',

            'Vat List',
            'Vat Create',
            'Vat Edit',
            'Vat Delete',

            'Shipment List',
            'Shipment Create',
            'Shipment Edit',
            'Shipment Delete',

            'Zone List',
            'Zone Create',
            'Zone Edit',
            'Zone Delete'
        ];


        Role::create(['name' => 'Super Admin']); //Create Super Admin By default

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
