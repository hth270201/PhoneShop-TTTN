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
            $table->integer('price')->nullable()->index();
            $table->string('config')->nullable()->index();
            $table->jsonb('thumb')->default(DB::raw("('{}')"));
            $table->jsonb('description')->default(DB::raw("('{}')"));
            $table->text('detail')->nullable();
            $table->string('producer')->nullable();
            $table->float('rate')->nullable()->default('0');
            $table->bigInteger('comment_id')->unsigned()->nullable();
            $table->bigInteger('review_id')->unsigned()->nullable();
            $table->jsonb('payload')->default(DB::raw("('{}')"));
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
