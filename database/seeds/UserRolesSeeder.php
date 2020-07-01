<?php

use App\UserRoles;
use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = new UserRoles();
        $table->id = 1;
        $table->name = "Super Admin";
        $table->description = "This Type of users access all section";
        $table->business_id = 1;
        $table->users_id = 1;
        $table->save();
    }
}
