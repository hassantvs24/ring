<?php

use App\User;
use Illuminate\Database\Seeder;

class UserRoleUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = User::find(1);
        $table->user_roles_id = 1;
        $table->save();
    }
}
