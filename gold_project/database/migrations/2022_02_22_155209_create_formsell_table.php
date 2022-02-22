<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsellTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formsell', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id');
            $table->integer('product_detail_id');
            $table->integer('customer_id');
            $table->float('goldBar_buy_medain_price');
            $table->float('goldBar_sell_medain_price');
            $table->float('gold_buy_medain_price');
            $table->float('gold_buy_gram_medain_price');
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
        Schema::dropIfExists('formsell');
    }
}
