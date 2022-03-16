<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PledgeLine extends Model
{
    protected $fillable = ['pledges_id', 'product_detail_id', 'interest_per', 'interest_bath', 'status_check'];
    // protected $primaryKey = 'lot_id';
    protected $table = 'pledges_line';
}
