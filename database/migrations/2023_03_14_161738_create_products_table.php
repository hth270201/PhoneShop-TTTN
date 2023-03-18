<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('slug')->nullable();
            $table->jsonb('price_with_color')->default(DB::raw("('{}')"));
            $table->jsonb('price_with_config')->default(DB::raw("('{}')"));
            $table->jsonb('thumb')->default(DB::raw("('{}')"));
            $table->jsonb('details')->default(DB::raw("('{}')"));
            $table->string('producer')->nullable();
            $table->text('source')->nullable();
            $table->float('rate')->nullable()->default('0');
            $table->text('reviews')->nullable();
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
};
