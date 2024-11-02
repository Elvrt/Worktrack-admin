<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    use HasFactory;

    // Nama tabel dalam database
    protected $table = 'user';

    // Kolom primary key
    protected $primaryKey = 'user_id';

    // Kolom yang boleh diisi (fillable)
    protected $fillable = [
        'role_id',
        'employee_id',
        'username',
        'password',
        'created_at',
    ];

    // Karena `user_id` adalah bigint, set properti `keyType` sebagai integer
    protected $keyType = 'int';

    // Menonaktifkan timestamps default Laravel karena kolom 'created_at' sudah ada dan sesuai dengan timestamp
    public $timestamps = false;

    // Casting untuk kolom tertentu
    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Relasi one-to-one ke model Employee
    
    // public function employee()
    // {
    //     return $this->hasOne(Employee::class, 'employee_id', 'employee_id');
    // }

    // public function users()
    // {
    //     return $this->hasMany(User::class, 'role_id', 'role_id');
    // }

}
