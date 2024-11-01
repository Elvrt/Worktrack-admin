<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reportmodel extends Model
{
    use HasFactory;

    protected $table = 'report';

    protected $primaryKey = 'report_id';

    public $timestamps = false;

    protected $fillable = [
        'absence_id',
        'activity_title',
        'activity_description',
        'activity_photo',
        'comment'
    ];

    // Define relationship with another table (for example, if absence_id is a foreign key to an 'Absence' model)
    public function absence()
    {
        return $this->belongsTo(absence::class, 'absence_id');
    }
}
