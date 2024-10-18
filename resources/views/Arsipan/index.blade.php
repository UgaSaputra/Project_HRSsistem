@extends('layout.admin')

@section('content')
    <style>
        .disabled-input {
            background-color: #fff;
            color: #000;
            cursor: not-allowed;
        }
    </style>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Arsipan Karyawan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('karyawan.index') }}">Lihat Data</a></li>
                            <li class="breadcrumb-item active">Data Arsipan</li>
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

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nomor KTP</th>
                            <th>Nama Lengkap</th>
                            <th>Nama Panggilan</th>
                            <th>Tanggal Kontrak</th>
                            <th>Tanggal DI Angkat Tetap</th>
                            <th>Tanggal Mulai Bekerja</th>
                            <th>Status</th>
                            <th>Jabatan</th>
                            <th>NUPTK</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Agama</th>
                            <th>Email</th>
                            <th>Hobi</th>
                            <th>Status Pernikahan</th>
                            <th>Alamat Tempat Tinggal</th>
                            <th>Nomor Telepon</th>
                            <th>Alamat Darurat</th>
                            <th>Telepon Darurat</th>
                            <th>Golongan Darah</th>
                            <th>Pendidikan Terakhir</th>
                            <th>Instansi</th>
                            <th>Tahun Lulus</th>
                            <th>Tempat Pelatihan Kompetensi</th>
                            <th>Pengalaman Organisasi</th>
                            <th>Nama Pasangan</th>
                            <th>Nama Anak</th>
                            <th>Tanggal Menikah</th>
                            <th>Nomor Surat Nikah</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Arsipan as $Arsipan)
                            <tr>
                                <td>{{ $Arsipan->id_number }}</td>
                                <td>{{ $Arsipan->full_name }}</td>
                                <td>{{ $Arsipan->nickname }}</td>
                                <td>{{ $Arsipan->contract_date }}</td>
                                <td>{{ $Arsipan->work_date }}</td>
                                <td>{{ $Arsipan->date_fixed }}</td>
                                <td>{{ $Arsipan->status }}</td>
                                <td>{{ $Arsipan->position }}</td>
                                <td>{{ $Arsipan->nuptk }}</td>
                                <td>{{ $Arsipan->gender }}</td>
                                <td>{{ $Arsipan->place_birth }}</td>
                                <td>{{ $Arsipan->birth_date }}</td>
                                <td>{{ $Arsipan->religion }}</td>
                                <td>{{ $Arsipan->email }}</td>
                                <td>{{ $Arsipan->hobby }}</td>
                                <td>{{ $Arsipan->marital_status }}</td>
                                <td>{{ $Arsipan->residence_address }}</td>
                                <td>{{ $Arsipan->phone }}</td>
                                <td>{{ $Arsipan->address_emergency }}</td>
                                <td>{{ $Arsipan->phone_emergency }}</td>
                                <td>{{ $Arsipan->blood_type }}</td>
                                <td>{{ $Arsipan->last_education }}</td>
                                <td>{{ $Arsipan->agency }}</td>
                                <td>{{ $Arsipan->graduation_year }}</td>
                                <td>{{ $Arsipan->competency_training_place }}</td>
                                <td>{{ $Arsipan->organizational_experience }}</td>
                                <td>{{ $Arsipan->mate_name ?? '-' }}</td>
                                <td>{{ $Arsipan->child_name ?? '-' }}</td>
                                <td>{{ $Arsipan->wedding_date ?? '-' }}</td>
                                <td>{{ $Arsipan->wedding_certificate_number ?? '-' }}</td>
                                <td>
                                    @can('ismanager')                                     
                                    <form action="{{ route('employee.destroy', $Arsipan->id_number) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mt-1">Delete</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
