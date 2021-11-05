<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Managegold extends Model
{
    protected $fillable = ['code', 'details', 'unit', 'striped','bath','salung','gram','status','date_of_import', 'price_of_gold', 'gratuity','tray', 'allprice', 'pic'];
    protected $table = 'managegolds';
}
