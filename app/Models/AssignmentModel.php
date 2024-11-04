<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentModel extends Model
{
    use HasFactory;

    protected $table = 'assignment';
    protected $primaryKey = 'assignment_id';
    public $timestamps = false;

    protected $fillable = 
    [
        'employee_id', 
        'goal_id',
        'created_at',
    ];

    public function employee()
    {
        return $this->belongsTo(EmployeeModel::class, 'employee_id');
    }

    public function goal()
    {
        return $this->belongsTo(GoalModel::class, 'goal_id');
    }
}
