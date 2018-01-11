<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id');
            $table->integer('hoa_id');
            $table->text('type');
            $table->dateTime('opened_at');
            $table->integer('opened_by');
            $table->dateTime('closed_at')->nullable();
            $table->integer('closed_by')->nullable();
            $table->text('status');
            $table->text('description');
            $table->timestamps();

            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('hoa_id')->references('id')->on('hoa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
