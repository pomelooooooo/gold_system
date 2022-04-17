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
            $table->integer('customer_id')->nullable();
            $table->decimal('goldBar_buy_medain_price',15,2);
            $table->decimal('goldBar_sell_medain_price',15,2);
            $table->decimal('gold_buy_medain_price',15,2);
            $table->decimal('gold_buy_gram_medain_price',15,2);
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
