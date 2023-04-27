<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->index();
            $table->bigInteger('address_id')->unsigned()->nullable();
            $table->bigInteger('cart_id')->unsigned()->nullable();
            $table->string('google_id')->nullable();
            $table->bigInteger('role_id')->unsigned()->default(0);
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
            $table->string('phone')->nullable()->index();
            $table->bigInteger('address_id')->unsigned()->nullable();
            $table->bigInteger('cart_id')->unsigned()->nullable();
            $table->string('google_id')->nullable();
            $table->bigInteger('role_id')->unsigned()->default(0);
        });
    }
};
