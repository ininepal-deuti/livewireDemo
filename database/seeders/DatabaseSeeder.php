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
         //\App\Models\User::factory(10)->create();
         //\App\Models\Post::factory(50)->create();

         \App\Models\Admin::factory(2)->create();
         \App\Models\Customer::factory(2)->create();


    }
}
