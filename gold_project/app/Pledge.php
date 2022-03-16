<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pledge extends Model
{
    protected $fillable = ['group_id', 'customer_id', 'user_id', 'price_pledge', 'status_check', 'installment_start', 'installment_next', 'piece', 'weight'];
    // protected $primaryKey = 'lot_id';
    protected $table = 'pledges';
}
