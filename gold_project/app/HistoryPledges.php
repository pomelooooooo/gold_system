<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryPledges extends Model
{
    protected $fillable = ['pledges_id', 'customer_name','due_date','deposit'];
    protected $table = 'history_pledges';
}
