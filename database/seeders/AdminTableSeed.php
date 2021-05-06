<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AdminTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            ['name'=>'tung pham','email' =>'tung@gmail.com','password'=>'$2y$10$epOoLPWnUN3MAaGtMObhGOInCjP5.xi7ZH8uPypGPaevArVX9mkYi','status'=>'1'],
        ]);
    }
}
