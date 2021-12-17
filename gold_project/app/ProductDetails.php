<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    protected $fillable = ['code', 'details', 'type_gold_id', 'striped', 'size', 'gram', 'status', 'lot_id','user_id','customer_id', 'gratuity', 'tray', 'allprice', 'pic', 'type', 'datetime'];
    protected $table = 'product_details';
}
