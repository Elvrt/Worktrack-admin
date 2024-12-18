<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenceModel extends Model
{
    use HasFactory;

    protected $table = 'absence';
    protected $primaryKey = 'absence_id';
    public $timestamps = false;

    protected $fillable =
    [
        'employee_id',
        'absence_date',
        'clock_in',
        'clock_out',
        'location',
        'status',
        'created_at',
    ];

    public function employee()
    {
        return $this->belongsTo(EmployeeModel::class, 'employee_id');
    }

    public function report()
    {
        return $this->hasMany(ReportModel::class, 'report_id');
    }
}
