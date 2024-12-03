<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensi';
    protected $fillable = [
        'user_id',
        'timestamp',
        'status',
        'qr_code_data',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
