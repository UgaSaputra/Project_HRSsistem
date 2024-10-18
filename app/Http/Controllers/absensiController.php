<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    public function showForm()
    {
        $absensi = Absensi::all();
        return view('Absensi.index', compact('absensi'));
    }

    public function import(Request $request)
{
    // Validasi file yang di-upload
    $validator = Validator::make($request->all(), [
        'file' => 'required|mimes:xlsx,xls',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $file = $request->file('file');
    $spreadsheet = IOFactory::load($file->path());
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray();

    // Menghapus header dari data
    $header = array_shift($data);

    // Debug: tampilkan header untuk memastikan key yang benar
    // dd($header);

    foreach ($data as $row) {
        // Memastikan data row memiliki jumlah kolom yang benar
        if (count($row) == count($header)) {
            $dataRow = array_combine($header, $row);

            // Debug: tampilkan dataRow untuk memastikan key yang benar
            // dd($dataRow);

            // Pastikan id_number tidak kosong
            if (!empty($dataRow['id_number'])) {
                // Mengupdate atau menyimpan data ke database
                Absensi::updateOrCreate(
                    ['id_number' => $dataRow['id_number']],
                    [
                        'pin' => $dataRow['pin'] ?? null,
                        'nip' => $dataRow['nip'] ?? null,
                        'nama' => $dataRow['nama'] ?? null,
                        'jabatan' => $dataRow['jabatan'] ?? null,
                        'departemen' => $dataRow['departemen'] ?? null,
                        'kantor' => $dataRow['kantor'] ?? null,
                        'izin_libur' => $dataRow['izin_libur'] ?? null,
                        'jumlah_hadir' => $dataRow['jumlah_hadir'] ?? null,
                        'jam_terlambat' => $dataRow['jam_terlambat'] ?? null,
                        'jumlah_terlambat' => $dataRow['jumlah_terlambat'] ?? null,
                        'jam_pulang_awal' => $dataRow['jam_pulang_awal'] ?? null,
                        'jml_pulang_awal' => $dataRow['jml_pulang_awal'] ?? null,
                        'jam_istirahat_lebih' => $dataRow['jam_istirahat_lebih'] ?? null,
                        'jumlah_istirahat_lebih' => $dataRow['jumlah_istirahat_lebih'] ?? null,
                        'scan_kerja_masuk' => $dataRow['scan_kerja_masuk'] ?? null,
                        'scan_kerja_keluar' => $dataRow['scan_kerja_keluar'] ?? null,
                        'jam_lembur' => $dataRow['jam_lembur'] ?? null,
                        'menit_lembur' => $dataRow['menit_lembur'] ?? null,
                        'scan_lembur' => $dataRow['scan_lembur'] ?? null,
                        'tidak_hadir_tanpa_izin' => $dataRow['tidak_hadir_tanpa_izin'] ?? null,
                        'libur' => $dataRow['libur'] ?? null,
                        'izin_tidak_masuk_pribadi' => $dataRow['izin_tidak_masuk_pribadi'] ?? null,
                        'izin_pulang_awal_pribadi' => $dataRow['izin_pulang_awal_pribadi'] ?? null,
                        'izin_datang_terlambat_pribadi' => $dataRow['izin_datang_terlambat_pribadi'] ?? null,
                        'sakit_dengan_surat_dokter' => $dataRow['sakit_dengan_surat_dokter'] ?? null,
                        'sakit_tanpa_surat_dokter' => $dataRow['sakit_tanpa_surat_dokter'] ?? null,
                        'izin_meninggal_tempat_kerja' => $dataRow['izin_meninggal_tempat_kerja'] ?? null,
                        'izin_dinas_kantor' => $dataRow['izin_dinas_kantor'] ?? null,
                        'izin_datang_terlambat_kantor' => $dataRow['izin_datang_terlambat_kantor'] ?? null,
                        'izin_pulang_awal_kantor' => $dataRow['izin_pulang_awal_kantor'] ?? null,
                        'cuti_normatif' => $dataRow['cuti_normatif'] ?? null,
                        'cuti_pribadi' => $dataRow['cuti_pribadi'] ?? null,
                        'tidak_scan_masuk' => $dataRow['tidak_scan_masuk'] ?? null,
                        'tidak_scan_pulang' => $dataRow['tidak_scan_pulang'] ?? null,
                        'tidak_scan_istirahat' => $dataRow['tidak_scan_istirahat'] ?? null,
                        'tidak_scan_selesai_istirahat' => $dataRow['tidak_scan_selesai_istirahat'] ?? null,
                        'tidak_scan_mulai_lembur' => $dataRow['tidak_scan_mulai_lembur'] ?? null,
                        'tidak_scan_selesai_lembur' => $dataRow['tidak_scan_selesai_lembur'] ?? null,
                        'izin_lainlain' => $dataRow['izin_lainlain'] ?? null,
                    ]
                );
            } else {
                // Jika 'id_number' kosong, log peringatan
                Log::warning('Data skipped due to missing id_number', $dataRow);
            }
        }
    }

    return back()->with('success', 'Data berhasil diimpor!');
}


}
