<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwnerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owner_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id');
            $table->text('street_number');
            $table->text('street_name');
            $table->text('city');
            $table->string('state', 2);
            $table->string('zip', 5);
            $table->boolean('in_use');
            $table->timestamps();

            $table->unique(['owner_id', 'street_number', 'street_name']);

            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('owner_addresses');
    }
}
