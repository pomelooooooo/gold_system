<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    protected $fillable = ['code', 'details', 'type', 'striped', 'size', 'gram', 'status', 'lot_id', 'gratuity', 'tray', 'allprice', 'pic', 'category', 'datetime'];
    protected $table = 'product_details';
}
