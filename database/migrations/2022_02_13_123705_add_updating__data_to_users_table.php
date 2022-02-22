<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpdatingDataToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->longText('address_one');
            $table->longText('address_two');
            $table->integer('provinces_id');
            $table->integer('regencies_id');
            $table->integer('zip_code');
            $table->string('country');
            $table->string('phone_number');
            $table->string('store_name');
            $table->integer('categories_id');
            $table->integer('store_status');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
