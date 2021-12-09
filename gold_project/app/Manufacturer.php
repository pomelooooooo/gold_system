<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $fillable = ['code', 'name','tel','address'];
    protected $table = 'manufacturers';
}
