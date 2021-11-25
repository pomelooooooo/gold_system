<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeGold extends Model
{
    protected $fillable = ['category', 'name'];
    protected $table = 'type_gold';
}
