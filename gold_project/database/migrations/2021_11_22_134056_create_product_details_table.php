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
            $table->enum('category', ['ทองแท่ง','สร้อยคอ', 'สร้อยข้อมือ', 'แหวน', 'กำไล', 'ต่างหู', 'จี้']);
            $table->string('striped');
            $table->enum('size',['ครึ่งสลึง','1 สลึง','2 สลึง','3 สลึง','6 สลึง','1 บาท','2 บาท','3 บาท','4 บาท','5 บาท','10 บาท']);
            $table->string('gram')->nullable();
            $table->enum('status', ['0', '1']);
            $table->enum('type', ['ทองเก่า', 'ทองใหม่'])->nullable();
            $table->integer('gratuity')->nullable();
            $table->string('tray')->nullable();
            $table->integer('allprice')->nullable();
            $table->string('pic')->nullable();
            $table->dateTime('datetime');
            $table->string('lot_id')->nullable();
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
