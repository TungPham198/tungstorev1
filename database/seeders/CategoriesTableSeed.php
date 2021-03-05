<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CategoriesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' =>'Iphone','index'=>1],
            ['name' =>'Samsung','index'=>2],
            ['name' =>'Oppo','index'=>3],
            ['name' =>'Xiaomi','index'=>4],
            ['name' =>'Other','index'=>5],
        ]);
    }
}
