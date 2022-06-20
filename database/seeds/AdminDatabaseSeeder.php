<?php

use Illuminate\Database\Seeder;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::create([
           'name'=>'admin',
           'email'=>'admin@admin.com',
           'password'=>bcrypt('123456789')
        ]);
    }
}
