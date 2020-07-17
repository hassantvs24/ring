<?php

use App\AccountBook;
use App\User;
use App\Warehouse;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PreInstallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::create([
            'id' => 1,
            'name' => 'Super Admin'
        ]);

        $warehouse = new Warehouse();
        $warehouse->id = 1;
        $warehouse->name = 'Infinity Flame Soft';
        $warehouse->contact = '01675870047';
        $warehouse->contact_alternate = '01558654525';
        $warehouse->address = 'Rongmohol Tower, Bondor Bazar, Sylhet';
        $warehouse->website = 'www.infinityflamesoft.com';
        $warehouse->proprietor = 'Nazmul Hossain';
        $warehouse->logo = 'logo.png';
        $warehouse->business_id = 1;
        $warehouse->users_id = 1;
        $warehouse->save();

        $ac_book = new AccountBook();
        $ac_book->id = 1;
        $ac_book->name = 'General Accounts';
        $ac_book->account_number = '00';
        $ac_book->description = 'Default Account';
        $ac_book->business_id = 1;
        $ac_book->users_id = 1;
        $ac_book->save();


        $user = User::find(1);
        $user->warehouses_id = 1;
        $user->account_books_id = 1;
        $user->save();

        $user->assignRole(1);


    }
}
