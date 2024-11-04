<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaceModel extends Model
{
    use HasFactory;

    protected $table = 'face';
    protected $primaryKey = 'face_id';
    public $timestamps = false;

    protected $fillable =
    [
        'employee_id',
        'photo',
        'created_at',
    ];

    public function employee()
    {
        return $this->belongsTo(EmployeeModel::class, 'employee_id');
    }
}
