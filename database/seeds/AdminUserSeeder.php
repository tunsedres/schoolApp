<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(App\User::class)->create();
        $role = factory(App\Role::class)->create();

        Db::table('user_roles')->insert([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);
    }
}
