<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormBuy extends Model
{
    protected $fillable = ['group_id', 'product_detail_id','customer_id'];
    protected $table = 'formbuy';
}
