<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_number',
        'pin',
        'nip',
        'nama',
        'jabatan',
        'departemen',
        'kantor',
        'izin_libur',
        'jumlah_hadir',
        'jam_terlambat',
        'jumlah_terlambat',
        'jam_pulang_awal',
        'jml_pulang_awal',
        'jam_istirahat_lebih',
        'jumlah_istirahat_lebih',
        'scan_kerja_masuk',
        'scan_kerja_keluar',
        'jam_lembur',
        'menit_lembur',
        'scan_lembur',
        'tidak_hadir_tanpa_izin',
        'libur',
        'izin_tidak_masuk_pribadi',
        'izin_pulang_awal_pribadi',
        'izin_datang_terlambat_pribadi',
        'sakit_dengan_surat_dokter',
        'sakit_tanpa_surat_dokter',
        'izin_meninggal_tempat_kerja',
        'izin_dinas_kantor',
        'izin_datang_terlambat_kantor',
        'izin_pulang_awal_kantor',
        'cuti_normatif',
        'cuti_pribadi',
        'tidak_scan_masuk',
        'tidak_scan_pulang',
        'tidak_scan_istirahat',
        'tidak_scan_selesai_istirahat',
        'tidak_scan_mulai_lembur',
        'tidak_scan_selesai_lembur',
        'izin_lainlai',
    ];
    public function absensi()
    {
        return $this->hasMany(Employee::class, 'id_number', 'id_number');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_number', 'id_number');
    }
}
