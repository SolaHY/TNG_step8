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
            // usersのidと同じデータ型に設定する
            // bigIncrementsで設定されるデータ型はunsignedBigInteger
            $table->unsignedBigInteger('user_id');
            //$table->string('company_id');
            $table->unsignedBigInteger('company_id');
            $table->string('product_name');
            $table->unsignedinteger('price');
            $table->unsignedinteger('stock');
            $table->text('comment');
            $table->string('img_path');
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
