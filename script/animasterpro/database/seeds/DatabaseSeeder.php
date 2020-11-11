<?php

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
        // $this->call(UsersTableSeeder::class);
        //$this->call(AdminsTableSeeder::class);
        //$this->call(create_categories_seeder::class);
        $this->call(userseeder::class);
    }
}
