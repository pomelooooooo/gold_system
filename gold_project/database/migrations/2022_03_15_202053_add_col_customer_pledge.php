<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColCustomerPledge extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pledges', function (Blueprint $table) {
            $table->integer('group_id')->nullable()->after('product_detail_id');
            $table->integer('customer_id')->nullable()->after('group_id');
            $table->integer('user_id')->nullable()->after('customer_id');
            $table->decimal('price_pledge',15,2)->nullable()->after('user_id');
            $table->enum('status_check', ['0', '1'])->nullable()->after('price_pledge');
            $table->decimal('interest_per',3,2)->nullable()->after('status_check');
            $table->decimal('interest_bath',15,2)->nullable()->after('interest_per');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pledges', function (Blueprint $table) {
            $table->dropColumn(['group_id','customer_id','user_id','price_pledge','status_check','interest_per','interest_bath']);
        });
    }
    
}
