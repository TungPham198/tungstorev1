<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('google_id', 255)->nullable();
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->integer('gender')->nullable();
            $table->string('address', 255)->nullable();
            $table->string('avatar', 255)->nullable();
            $table->string('birthday', 255)->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->rememberToken();
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'tung@gmail.com',
            'password' => bcrypt('123456'),
            'status' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
