<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('id_number');
            $table->string('pin');
            $table->string('nip');
            $table->string('nama');
            $table->string('jabatan');
            $table->string('departemen');
            $table->string('kantor');
            $table->boolean('izin_libur')->default(false);
            $table->integer('jumlah_hadir')->default(0);
            $table->decimal('jam_terlambat', 5, 2)->default(0.00);
            $table->integer('jumlah_terlambat')->default(0);
            $table->decimal('jam_pulang_awal', 5, 2)->default(0.00);
            $table->integer('jml_pulang_awal')->default(0);
            $table->decimal('jam_istirahat_lebih', 5, 2)->default(0.00);
            $table->integer('jumlah_istirahat_lebih')->default(0);
            $table->boolean('scan_kerja_masuk')->default(false);
            $table->boolean('scan_kerja_keluar')->default(false);
            $table->decimal('jam_lembur', 5, 2)->default(0.00);
            $table->integer('menit_lembur')->default(0);
            $table->boolean('scan_lembur')->default(false);
            $table->boolean('tidak_hadir_tanpa_izin')->default(false);
            $table->boolean('libur')->default(false);
            $table->boolean('izin_tidak_masuk_pribadi')->default(false);
            $table->boolean('izin_pulang_awal_pribadi')->default(false);
            $table->boolean('izin_datang_terlambat_pribadi')->default(false);
            $table->boolean('sakit_dengan_surat_dokter')->default(false);
            $table->boolean('sakit_tanpa_surat_dokter')->default(false);
            $table->boolean('izin_meninggal_tempat_kerja')->default(false);
            $table->boolean('izin_dinas_kantor')->default(false);
            $table->boolean('izin_datang_terlambat_kantor')->default(false);
            $table->boolean('izin_pulang_awal_kantor')->default(false);
            $table->boolean('cuti_normatif')->default(false);
            $table->boolean('cuti_pribadi')->default(false);
            $table->boolean('tidak_scan_masuk')->default(false);
            $table->boolean('tidak_scan_pulang')->default(false);
            $table->boolean('tidak_scan_istirahat')->default(false);
            $table->boolean('tidak_scan_selesai_istirahat')->default(false);
            $table->boolean('tidak_scan_mulai_lembur')->default(false);
            $table->boolean('tidak_scan_selesai_lembur')->default(false);
            $table->boolean('izin_lainlain')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensis');
    }
};
