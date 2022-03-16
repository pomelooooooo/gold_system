<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePledgesLine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pledges_line', function (Blueprint $table) {
            $table->id();
            $table->integer('pledges_id');
            $table->integer('product_detail_id');
            $table->decimal('interest_per', 15, 2);
            $table->decimal('interest_bath', 15, 2);
            $table->enum('status_check', ['0', '1'])->nullable();
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
        Schema::dropIfExists('pledges_line');
    }
}
