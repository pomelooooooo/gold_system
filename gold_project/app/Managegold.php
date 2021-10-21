<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Managegold extends Model
{
    protected $fillable = ['code', 'details', 'unit', 'weight', 'price', 'gratuity', 'allprice', 'pic'];
    protected $table = 'managegolds';
}
