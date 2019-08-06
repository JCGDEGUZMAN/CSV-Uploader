<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('product_number');
            $table->string('product_name');
            $table->string('product_description')->nullable();
            $table->unsignedBigInteger('category');
            //$table->foreign('category')->references('id')->on('categories');
            $table->string('photo')->nullable();
            $table->string('unit')->nullable();
            $table->string('weight')->nullable();
            $table->string('size')->nullable();
            $table->double('price')->default(0.0);
            $table->double('srp')->default(0.0);
            $table->boolean('is_vatable')->default(false);
            $table->boolean('status')->default(true);
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
