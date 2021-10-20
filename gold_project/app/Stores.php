<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    protected $fillable = ['name', 'address', 'tel','tax_identification_number','commercial_registration_number'];
    protected $table = 'stores';
}
