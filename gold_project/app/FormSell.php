<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormSell extends Model
{
    protected $fillable = ['group_id', 'product_detail_id','customer_id','goldBar_buy_medain_price','goldBar_sell_medain_price','gold_buy_medain_price','gold_buy_gram_medain_price'];
    protected $table = 'formsell';
}
