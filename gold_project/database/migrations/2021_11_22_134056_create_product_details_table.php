<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('details');
            $table->integer('type_gold_id');
            $table->integer('striped_id');
            $table->enum('size', ['ครึ่งสลึง', '1 สลึง', '2 สลึง', '3 สลึง', '6 สลึง', '1 บาท', '2 บาท', '3 บาท', '4 บาท', '5 บาท', '10 บาท']);
            $table->string('gram')->nullable();
            $table->enum('status', ['0', '1'])->nullable();
            $table->enum('status_trade', ['0', '1', '2', '3', '4', '5'])->default('0');
            $table->enum('status_check', ['0', '1', '2', '3', '4'])->nullable();
            $table->enum('type', ['ทองเก่า', 'ทองใหม่', 'ทองจำนำ'])->nullable();
            $table->integer('gratuity')->nullable();
            $table->string('tray')->nullable();
            $table->decimal('allprice', 15, 2)->nullable();
            $table->string('pic')->nullable();
            $table->string('note')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->string('lot_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('sellprice')->nullable();
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
        Schema::dropIfExists('product_details');
    }
}
