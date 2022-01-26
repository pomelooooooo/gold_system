<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Striped extends Model
{
    protected $fillable = ['name'];
    protected $table = 'stripeds';
}
