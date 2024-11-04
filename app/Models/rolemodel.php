<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    use HasFactory;

    protected $table = 'role';
    protected $primaryKey = 'role_id';
    public $timestamps = false;

    protected $fillable = 
    [
        'position',
        'created_at',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'user_id');
    }
}
