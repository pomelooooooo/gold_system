<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['lot_id','lot_count','weight','date_of_import', 'price_of_gold', 'wage','type_gold_id'];
    // protected $primaryKey = 'lot_id';
    protected $table = 'products';
}
