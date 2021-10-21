<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateManagegoldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managegolds', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('details');
            $table->string('unit');
            $table->string('weight');
            $table->string('price');
            $table->string('gratuity');
            $table->string('allprice');
            $table->string('pic')->nullable();
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
        Schema::dropIfExists('managegolds');
    }
}
