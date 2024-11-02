<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    use HasFactory;

    protected $table = 'Employee';
    protected $primaryKey = 'employee_id';

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
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    public function face()
    {
        return $this->hasMany(FaceModel::class, 'face_id');
    }

    public function assigment()
    {
        return $this->hasMany(AssigmentModel::class, 'assigment_id');
    }

    public function absence()
    {
        return $this->hasMany(AbsenceModel::class, 'absence_id');
    }

    public function take_off()
    {
        return $this->hasMany(Model::class, 'take_off_id');
    }
}
