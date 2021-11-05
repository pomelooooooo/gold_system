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
            $table->enum('unit', ['เส้น', 'แท่ง', 'วง']);
            $table->string('striped');
            $table->integer('bath');
            $table->integer('salung');
            $table->string('gram');
            $table->enum('status', ['ทองเก่า', 'ทองใหม่']);
            $table->date('date_of_import');
            $table->integer('price_of_gold');
            $table->integer('gratuity')->nullable();
            $table->string('tray');
            $table->integer('allprice')->nullable();
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
