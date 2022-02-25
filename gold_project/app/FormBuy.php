<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormBuy extends Model
{
    protected $fillable = ['group_id', 'product_detail_id', 'customer_id', 'gold_buy_gram_medain_price'];
    protected $table = 'formbuy';
}
