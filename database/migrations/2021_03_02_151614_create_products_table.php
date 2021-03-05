<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255);
            $table->string('slug',255);//tên không dấu
            $table->string('import_price',255);//giá nhập
            $table->string('price',255);//giá bán
            $table->integer('amount');//số lượng
            $table->integer('sold_amount')->default(0);//số lượng đã bán
            $table->string('sku',255);//mã hàng lưu kho
            $table->text('des')->nullable();// mô tả
            $table->string('summary',255)->nullable();// tóm tắt
            $table->integer('status')->default(1);//trang thái
            $table->string('images',255);
            $table->integer('category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
