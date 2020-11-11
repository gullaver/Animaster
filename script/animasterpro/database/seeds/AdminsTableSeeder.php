<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
            ['id'=>1, 'name'=>'admin', 'email'=>'test@test.com', 'password'=>'$2y$10$RnyaosD0NGj5RSfkkMnOT.8A4qu2EDwnwGW5u2IM2HSOL8Pb88JmS'],
        ];

        DB::table('admins')->insert($adminRecords);
    }
}
