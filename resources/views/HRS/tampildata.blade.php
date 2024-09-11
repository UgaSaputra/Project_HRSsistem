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
                        <h1 class="m-0">Data Karyawan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('karyawan.inputPage') }}">Tambah Data</a></li>
                            <li class="breadcrumb-item active">Data Karyawan</li>
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
            <div class="modal fade" id="createEmployeeModal" tabindex="-1" role="dialog"
                aria-labelledby="createEmployeeModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                </div>
            </div>
            <a href="{{ route('export') }}" class="btn btn-primary">Export Data</a>
            <a href="{{ route('export') }}" class="btn btn-primary">Import Data</a>

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
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->id_number }}</td>
                                <td>{{ $employee->full_name }}</td>
                                <td>{{ $employee->nickname }}</td>
                                <td>{{ $employee->contract_date }}</td>
                                <td>{{ $employee->work_date }}</td>
                                <td>{{ $employee->date_fixed }}</td>
                                <td>{{ $employee->status }}</td>
                                <td>{{ $employee->position }}</td>
                                <td>{{ $employee->nuptk }}</td>
                                <td>{{ $employee->gender }}</td>
                                <td>{{ $employee->place_birth }}</td>
                                <td>{{ $employee->birth_date }}</td>
                                <td>{{ $employee->religion }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->hobby }}</td>
                                <td>{{ $employee->marital_status }}</td>
                                <td>{{ $employee->residence_address }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>{{ $employee->address_emergency }}</td>
                                <td>{{ $employee->phone_emergency }}</td>
                                <td>{{ $employee->blood_type }}</td>
                                <td>{{ $employee->last_education }}</td>
                                <td>{{ $employee->agency }}</td>
                                <td>{{ $employee->graduation_year }}</td>
                                <td>{{ $employee->competency_training_place }}</td>
                                <td>{{ $employee->organizational_experience }}</td>
                                <td>{{ $employee->familyData->mate_name ?? '-' }}</td>
                                <td>{{ $employee->familyData->child_name ?? '-' }}</td>
                                <td>{{ $employee->familyData->wedding_date ?? '-' }}</td>
                                <td>{{ $employee->familyData->wedding_certificate_number ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('employee.edit', $employee->id_number) }}"
                                        class="btn btn-primary">Edit</a>
                                        <form action="{{ route('employee.archive', $employee->id_number) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-warning">Arsipkan</button>
                                        </form>                                        
                                    {{-- <form action="{{ route('employee.destroy', $employee->id_number) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <form action="{{ route('employee.archive', $employee->id_number) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger mt-1">Arsipan</button>
                                        </form>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const maritalStatusSelect = document.getElementById('marital_status');
                const mateNameInput = document.getElementById('mate_name');
                const childNameInput = document.getElementById('child_name');
                const weddingDateInput = document.getElementById('wedding_date');
                const weddingCertificateNumberInput = document.getElementById('wedding_certificate_number');

                function toggleFields() {
                    const isMarried = maritalStatusSelect.value === 'menikah';

                    [mateNameInput, childNameInput, weddingDateInput, weddingCertificateNumberInput].forEach(input => {
                        input.disabled = !isMarried;
                        if (input.disabled) {
                            input.style.backgroundColor = '#fff';
                            input.style.color = '#000';
                            input.style.cursor = 'not-allowed';
                        } else {
                            input.style.backgroundColor = '';
                            input.style.color = '';
                            input.style.cursor = '';
                        }
                    });
                }

                maritalStatusSelect.addEventListener('change', toggleFields);
                toggleFields();
            });
        </script>



    </div>
@endsection
