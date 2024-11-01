<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeOffData extends Model
{
    use HasFactory;

    // Tentukan nama tabel, jika berbeda dari nama model secara default
    protected $table = 'take_off';

    // Kolom primary key tabel
    protected $primaryKey = 'take_off_id';

    // Kolom yang boleh diisi (fillable)
    protected $fillable = [
        'employee_id',
        'start_date',
        'end_date',
        'reason',
        'letter',
        'created_at'
    ];

    // Karena `take_off_id` adalah bigint, set properti `keyType` sebagai integer
    protected $keyType = 'int';

    // Menonaktifkan timestamps default Laravel karena sudah ada `created_at`
    public $timestamps = false;

    // Jika ingin menggunakan format timestamp dari kolom Supabase 'created_at'
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'created_at' => 'datetime',
    ];

    // public function employee()
    // {
    //     return $this->belongsTo(Employee::class, 'employee_id');
    // }
}
