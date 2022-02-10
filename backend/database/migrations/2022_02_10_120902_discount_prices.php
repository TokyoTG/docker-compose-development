<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DiscountPrices extends Migration
{
        /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('book_id')->references('id')->on('books');
            $table->float('price',8,2);
            $table->timestamp('start_date');
            $table->timestamp('end_date');
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
        Schema::dropIfExists('discount_prices');
    }
}
