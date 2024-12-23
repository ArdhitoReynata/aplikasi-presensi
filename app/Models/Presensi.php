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
        'keterangan',
        'qr_code_data',
        'image_path',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
