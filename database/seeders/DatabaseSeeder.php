<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(RoleTableSeeder::class);
        //$this->call(PermissionTableSeeder::class);
        //$this->call(PermissionRoleTableSeeder::class);
        //$this->call(DashboardTablesSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
