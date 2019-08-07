<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->unsignedBigInteger('group');
            //$table->foreign('group')->references('id')->on('user_groups');
            $table->unsignedBigInteger('access');
            //$table->foreign('access')->references('id')->on('user_accesses');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('password')->nullable();
            $table->string('street')->nullable();
            $table->integer('barangay')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('zone')->nullable();
            $table->string('region')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('photo')->nullable();
            $table->string('sales_coordinator')->nullable();
            $table->integer('capacity')->nullable();
            $table->boolean('is_owner')->default(false);
            $table->boolean('status')->default(true);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
