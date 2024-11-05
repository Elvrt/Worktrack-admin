<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalModel extends Model
{
    use HasFactory;

    protected $table = 'goal';
    protected $primaryKey = 'goal_id';
    public $timestamps = false;

    protected $fillable =
        [
            'project_title',
            'project_description',
            'goal_date',
            'created_at',
        ];

    public function assignment()
    {
        return $this->belongsTo(AssignmentModel::class, 'assignment_id');
    }

    public function employees()
    {
        return $this->belongsToMany(EmployeeModel::class, 'assignment', 'goal_id', 'employee_id');
    }
}
