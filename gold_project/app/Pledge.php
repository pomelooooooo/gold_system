<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pledge extends Model
{
    protected $fillable = ['product_detail_id', 'group_id', 'customer_id', 'user_id', 'price_pledge', 'status_check', 'interest_per','interest_bath','installment_start','installment_next','installment_end'];
    // protected $primaryKey = 'lot_id';
    protected $table = 'pledges';
}
