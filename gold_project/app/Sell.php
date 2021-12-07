<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    protected $fillable = ['gold_id', 'date_time', 'user_id', 'sell_price','type_gold','weight','wage','price_of_gold'];
    protected $table = 'sells';
}
