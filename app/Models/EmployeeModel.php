<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    use HasFactory;

    protected $table = 'employee';
    protected $primaryKey = 'employee_id';
    public $timestamps = false;

    protected $fillable =
    [
        'employee_number',
        'name',
        'date_of_birth',
        'phone_number',
        'address',
        'profil',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }

    public function face()
    {
        return $this->hasMany(FaceModel::class, 'face_id');
    }

    public function assignment()
    {
        return $this->hasMany(AssignmentModel::class, 'assignment_id');
    }

    public function absence()
    {
        return $this->hasMany(AbsenceModel::class, 'absence_id');
    }

    public function time_off()
    {
        return $this->hasMany(TimeOffModel::class, 'time_off_id');
    }
}
