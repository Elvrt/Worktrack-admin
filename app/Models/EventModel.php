<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    use HasFactory;

    protected $table = 'event';
    protected $primaryKey = 'event_id';
    public $timestamps = false;

    protected $fillable = 
    [
        'event_date',
        'event_time',
        'information'
    ];

    
}
