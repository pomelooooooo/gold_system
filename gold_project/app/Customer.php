<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'lastname', 'tel', 'idcard', 'address', 'address_now', 'date_card_start', 'date_card_end', 'picture'];
    protected $table = 'customer';
}
