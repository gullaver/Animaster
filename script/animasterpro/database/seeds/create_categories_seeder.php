<?php

use Illuminate\Database\Seeder;
use App\Category;

class create_categories_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        $cateRecords = [
            ['name'=>'Anime'], ['name'=>'Cartoon'], ['name'=>'Manga']
        ];

        DB::table('categories')->insert($cateRecords);
    }
}
