<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('compliance_officers', function (Blueprint $table) {
            $table->foreign('hoa_id')->references('id')->on('hoa')->onDelete('cascade');
        });

        Schema::table('owners', function (Blueprint $table) {
            $table->foreign('hoa_id')->references('id')->on('hoa')->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('compliance_officer_id')->references('id')->on('compliance_officers')->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('board_member_id')->references('id')->on('board_members')->onDelete('cascade');
        });

        Schema::table('properties', function (Blueprint $table) {
            $table->foreign('hoa_id')->references('id')->on('hoa')->onDelete('cascade');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('hoa_id')->references('id')->on('hoa')->onDelete('cascade');
        });

        Schema::table('ticket_notes', function (Blueprint $table) {
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
        });

        Schema::table('owner_addresses', function (Blueprint $table) {
            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade');
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->foreign('hoa_id')->references('id')->on('hoa')->onDelete('cascade');
        });

        Schema::table('owner_property', function (Blueprint $table) {
            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });

        Schema::table('board_members', function (Blueprint $table) {
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
        Schema::table('compliance_officers', function (Blueprint $table) {
            $table->dropForeign('owners_hoa_id_foreign');
        });

        Schema::table('owners', function (Blueprint $table) {
            $table->dropForeign('owners_hoa_id_foreign');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_compliance_officers_id_foreign');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_owner_id_foreign');
        });

        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign('properties_hoa_id_foreign');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign('tickets_hoa_id_foreign');
            $table->dropForeign('tickets_property_id_foreign');
        });

        Schema::table('ticket_notes', function (Blueprint $table) {
            $table->dropForeign('ticket_notes_ticket_id_foreign');
        });

        Schema::table('owner_addresses', function (Blueprint $table) {
            $table->dropForeign('owner_addresses_owner_id_foreign');
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->dropForeign('settings_hoa_id_foreign');
        });

        Schema::table('owner_property', function (Blueprint $table) {
            $table->dropForeign('owner_property_owner_id_foreign');
            $table->dropForeign('owner_property_property_id_foreign');
        });

        Schema::table('board_members', function (Blueprint $table) {
            $table->dropForeign('board_members_hoa_id_foreign');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_board_member_id_foreign');
        });


    }
}
