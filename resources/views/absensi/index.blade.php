@extends('layout.admin')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Import Absensi Karyawan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <h1 class="text-center mb-3">IMPORT DATA ABSENSI KARYAWAN</h1>
            @can('isadmin')
                <form action="{{ route('absen.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file">Pilih File Excel</label>
                    <input type="file" id="file" name="file" class="form-control" accept=".xlsx, .xls" required>
                </div>
                <button type="submit" class="btn btn-success mt-4">Import</button>
            </form>            
            @endcan

            <h2 class="mt-5">Data Absensi Karyawan</h2>
            <table class="table mt-3" style="text-align: center">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">ID Number</th>
                        <th scope="col">PIN</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Departemen</th>
                        <th scope="col">Kantor</th>
                        <th scope="col">Izin Libur</th>
                        <th scope="col">Jumlah Hadir</th>
                        <th scope="col">Jam Terlambat</th>
                        <th scope="col">Jumlah Terlambat</th>
                        <th scope="col">Jam Pulang Awal</th>
                        <th scope="col">Jumlah Pulang Awal</th>
                        <th scope="col">Jam Istirahat Lebih</th>
                        <th scope="col">Jumlah Istirahat Lebih</th>
                        <th scope="col">Scan Kerja Masuk</th>
                        <th scope="col">Scan Kerja Keluar</th>
                        <th scope="col">Jam Lembur</th>
                        <th scope="col">Menit Lembur</th>
                        <th scope="col">Scan Lembur</th>
                        <th scope="col">Tidak Hadir Tanpa Izin</th>
                        <th scope="col">Libur</th>
                        <th scope="col">Izin Tidak Masuk Pribadi</th>
                        <th scope="col">Izin Pulang Awal Pribadi</th>
                        <th scope="col">Izin Datang Terlambat Pribadi</th>
                        <th scope="col">Sakit Dengan Surat Dokter</th>
                        <th scope="col">Sakit Tanpa Surat Dokter</th>
                        <th scope="col">Izin Meninggal Tempat Kerja</th>
                        <th scope="col">Izin Dinas Kantor</th>
                        <th scope="col">Izin Datang Terlambat Kantor</th>
                        <th scope="col">Izin Pulang Awal Kantor</th>
                        <th scope="col">Cuti Normatif</th>
                        <th scope="col">Cuti Pribadi</th>
                        <th scope="col">Tidak Scan Masuk</th>
                        <th scope="col">Tidak Scan Pulang</th>
                        <th scope="col">Tidak Scan Istirahat</th>
                        <th scope="col">Tidak Scan Selesai Istirahat</th>
                        <th scope="col">Tidak Scan Mulai Lembur</th>
                        <th scope="col">Tidak Scan Selesai Lembur</th>
                        <th scope="col">Izin Lain-Lain</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($absensi as $absensis)
                        <tr>
                            <th scope="row">{{ $no++ }}</th>
                            <td>{{ $absensis->id_number }}</td>
                            <td>{{ $absensis->pin }}</td>
                            <td>{{ $absensis->nip }}</td>
                            <td>{{ $absensis->nama }}</td>
                            <td>{{ $absensis->jabatan }}</td>
                            <td>{{ $absensis->departemen }}</td>
                            <td>{{ $absensis->kantor }}</td>
                            <td>{{ $absensis->izin_libur }}</td>
                            <td>{{ $absensis->jumlah_hadir }}</td>
                            <td>{{ $absensis->jam_terlambat }}</td>
                            <td>{{ $absensis->jumlah_terlambat }}</td>
                            <td>{{ $absensis->jam_pulang_awal }}</td>
                            <td>{{ $absensis->jml_pulang_awal }}</td>
                            <td>{{ $absensis->jam_istirahat_lebih }}</td>
                            <td>{{ $absensis->jumlah_istirahat_lebih }}</td>
                            <td>{{ $absensis->scan_kerja_masuk }}</td>
                            <td>{{ $absensis->scan_kerja_keluar }}</td>
                            <td>{{ $absensis->jam_lembur }}</td>
                            <td>{{ $absensis->menit_lembur }}</td>
                            <td>{{ $absensis->scan_lembur }}</td>
                            <td>{{ $absensis->tidak_hadir_tanpa_izin }}</td>
                            <td>{{ $absensis->libur }}</td>
                            <td>{{ $absensis->izin_tidak_masuk_pribadi }}</td>
                            <td>{{ $absensis->izin_pulang_awal_pribadi }}</td>
                            <td>{{ $absensis->izin_datang_terlambat_pribadi }}</td>
                            <td>{{ $absensis->sakit_dengan_surat_dokter }}</td>
                            <td>{{ $absensis->sakit_tanpa_surat_dokter }}</td>
                            <td>{{ $absensis->izin_meninggal_tempat_kerja }}</td>
                            <td>{{ $absensis->izin_dinas_kantor }}</td>
                            <td>{{ $absensis->izin_datang_terlambat_kantor }}</td>
                            <td>{{ $absensis->izin_pulang_awal_kantor }}</td>
                            <td>{{ $absensis->cuti_normatif }}</td>
                            <td>{{ $absensis->cuti_pribadi }}</td>
                            <td>{{ $absensis->tidak_scan_masuk }}</td>
                            <td>{{ $absensis->tidak_scan_pulang }}</td>
                            <td>{{ $absensis->tidak_scan_istirahat }}</td>
                            <td>{{ $absensis->tidak_scan_selesai_istirahat }}</td>
                            <td>{{ $absensis->tidak_scan_mulai_lembur }}</td>
                            <td>{{ $absensis->tidak_scan_selesai_lembur }}</td>
                            <td>{{ $absensis->izin_lainlain }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
