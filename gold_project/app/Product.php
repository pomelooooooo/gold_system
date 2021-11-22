<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['lot_id','lot_count','date_of_import', 'price_of_gold', 'wage'];
    protected $primaryKey = 'lot_id';
    protected $table = 'products';
}
