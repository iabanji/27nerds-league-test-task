<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    protected $table = 'leagues';

    protected $fillable = [
        'name',
        'tier',
        'region',
        'total_prize_pool',
        'most_recent_activity',
        'start_timestamp',
        'end_timestamp',
        'status',
    ];
}
