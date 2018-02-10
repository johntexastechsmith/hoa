<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoa', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('street_address_line_1');
            $table->text('street_address_line_2')->nullable();
            $table->text('city');
            $table->string('state', 2);
            $table->string('zip', 5);
            $table->text('uri');
            $table->timestamps();

            $table->unique(['name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hoa');
    }
}
