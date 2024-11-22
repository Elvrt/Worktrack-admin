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
    ];

    public function absence()
    {
        return $this->belongsTo(AbsenceModel::class, 'absence_id');
    }
}
