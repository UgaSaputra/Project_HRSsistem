<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absensi extends Model
{
    use HasFactory;
    protected $fillable = ['id_number','keterangan','waktu_masuk','waktu_ubah'];
    public function absensi()
    {
        return $this->hasMany(Employee::class, 'id_number', 'id_number');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_number', 'id_number');
    }
}
