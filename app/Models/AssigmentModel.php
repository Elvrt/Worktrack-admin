<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssigmentModel extends Model
{
    use HasFactory;
    protected $table = 'assigment';
    protected $primaryKey = 'assignment_id';
    protected $fillable = ['employee_id', 'goal_id'];

    // Relasi ke Employee
    public function employee()
    {
        return $this->belongsTo(EmployeeModel::class, 'employee_id');
    }

    // Relasi ke Goal
    public function goal()
    {
        return $this->belongsTo(GoalModel::class, 'goal_id');
    }
}
