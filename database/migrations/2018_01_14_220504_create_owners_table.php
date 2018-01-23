<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id');
            $table->integer('hoa_id');
            $table->text('account_name');
            $table->text('first_name');
            $table->text('last_name');
            $table->text('phone_number');
            $table->text('email_address');
            $table->boolean('active');
            $table->timestamps();

            $table->foreign('hoa_id')->references('id')->on('hoa')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('owners');
    }
}
