<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeOffModel extends Model
{
    use HasFactory;

    protected $table = 'time_off';
    protected $primaryKey = 'time_off_id';
    public $timestamps = false;

    protected $fillable = 
    [
        'employee_id',
        'start_date',
        'end_date',
        'reason',
        'letter',
        'status',
        'created_at',
    ];

    public function employee()
    {
        return $this->belongsTo(EmployeeModel::class, 'employee_id');
    }
}
