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
                            <li class="breadcrumb-item"><a href="{{ route('karyawan.index') }}">Lihat Data</a></li>
                            <li class="breadcrumb-item active">Data Karyawan</li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
    
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
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

            <div class="container">
                <h1 class="text-center mb-4">TAMBAH DATA KARYAWAN</h1>

                <form action="{{ route('karyawan.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="id_number">Nomor KTP</label>
                        <input type="text" id="id_number" name="id_number" class="form-control"
                            placeholder="Masukkan Nomor Ktp" required>
                    </div>
                    <div class="form-group">
                        <label for="full_name">Nama Lengkap</label>
                        <input type="text" id="full_name" name="full_name" class="form-control"
                            placeholder="Masukkan Nama Lengkap" required>
                    </div>
                    <div class="form-group">
                        <label for="nickname">Nama Panggilan</label>
                        <input type="text" id="nickname" name="nickname" class="form-control"
                            placeholder="Masukkan Nama Panggilan" required>
                    </div>
                    <div class="form-group">
                        <label for="contract_date">Tanggal Kontrak</label>
                        <input type="date" id="contract_date" name="contract_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="date_fixed">Tanggal Angkat Tetap</label>
                        <input type="date" id="date_fixed" name="date_fixed" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="work_date">Tanggal Mulai Bekerja</label>
                        <input type="date" id="work_date" name="work_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Berhenti">Berhenti</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="position">Jabatan</label>
                        <input type="text" id="position" name="position" class="form-control"
                            placeholder="Masukkan Jabatan" required>
                    </div>
                    <div class="form-group">
                        <label for="nuptk">NUPTK</label>
                        <input type="text" id="nuptk" name="nuptk" class="form-control"
                            placeholder="Masukkan NUPTK" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <select id="gender" name="gender" class="form-control" required>
                            <option value="pria">Pria</option>
                            <option value="wanita">Wanita</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="place_birth">Tempat Lahir</label>
                        <input type="text" id="place_birth" name="place_birth" class="form-control"
                            placeholder="Masukkan Tempat Lahir" required>
                    </div>
                    <div class="form-group">
                        <label for="birth_date">Tanggal Lahir</label>
                        <input type="date" id="birth_date" name="birth_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="religion">Agama</label>
                        <select id="religion" name="religion" class="form-control" required>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control"
                            placeholder="Masukkan email" required>
                    </div>
                    <div class="form-group">
                        <label for="hobby">Hobi</label>
                        <input type="text" id="hobby" name="hobby" class="form-control"
                            placeholder="Masukkan Hobi" required>
                    </div>
                    <div class="form-group">
                        <label for="marital_status">Status Pernikahan</label>
                        <select id="marital_status" name="marital_status" class="form-control" required>
                            <option value="menikah">Menikah</option>
                            <option value="belum">Belum Menikah</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="residence_address">Alamat Tempat Tinggal</label>
                        <input type="text" id="residence_address" name="residence_address" class="form-control"
                            placeholder="Masukkan Alamat Tempat Tinggal" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor Telepon</label>
                        <input type="tel" id="phone" name="phone" class="form-control"
                            placeholder="Masukkan Nomor Telepon" required>
                    </div>
                    <div class="form-group">
                        <label for="address_emergency">Alamat Darurat</label>
                        <input type="text" id="address_emergency" name="address_emergency" class="form-control"
                            placeholder="Masukkan Alamat Darurat" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_emergency">Telepon Darurat</label>
                        <input type="tel" id="phone_emergency" name="phone_emergency" class="form-control"
                            placeholder="Masukkan Telepon Darurat" required>
                    </div>
                    <div class="form-group">
                        <label for="blood_type">Golongan Darah</label>
                        <input type="text" id="blood_type" name="blood_type" class="form-control"
                            placeholder="Masukkan Golongan Darah" required>
                    </div>
                    <div class="form-group">
                        <label for="last_education">Pendidikan Terakhir</label>
                        <input type="text" id="last_education" name="last_education" class="form-control"
                            placeholder="Masukkan Pendidikan Terakhir" required>
                    </div>
                    <div class="form-group">
                        <label for="agency">Instansi</label>
                        <input type="text" id="agency" name="agency" class="form-control"
                            placeholder="Masukkan Instansi" required>
                    </div>
                    <div class="form-group">
                        <label for="graduation_year">Tahun Lulus</label>
                        <input type="text" id="graduation_year" name="graduation_year" class="form-control"
                            placeholder="Masukkan Tahun Lulus" required>
                    </div>
                    <div class="form-group">
                        <label for="competency_training_place">Tempat Pelatihan Kompetensi</label>
                        <input type="text" id="competency_training_place" name="competency_training_place"
                            class="form-control" placeholder="Masukkan Tempat Pelatihan Kompetensi" required>
                    </div>
                    <div class="form-group">
                        <label for="organizational_experience">Pengalaman Organisasi</label>
                        <textarea id="organizational_experience" name="organizational_experience" class="form-control" rows="4"
                            placeholder="Masukkan Pengalaman Organisasi" required></textarea>
                    </div>

                    <h2 class="mt-4 mb-3">DATA KELUARGA</h2>
                    <div class="form-group">
                        <label for="mate_name">Nama Pasangan</label>
                        <input type="text" id="mate_name" name="mate_name" class="form-control"
                            placeholder="Masukkan Nama Pasangan">
                    </div>
                    <div class="form-group">
                        <label for="child_name">Nama Anak</label>
                        <input type="text" id="child_name" name="child_name" class="form-control"
                            placeholder="Masukkan Nama Anak" required>
                    </div>
                    <div class="form-group">
                        <label for="wedding_date">Tanggal Menikah</label>
                        <input type="date" id="wedding_date" name="wedding_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="wedding_certificate_number">Nomor Surat Nikah</label>
                        <input type="text" id="wedding_certificate_number" name="wedding_certificate_number"
                            class="form-control" placeholder="Masukkan Nomor Surat Nikah" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>

            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
                                input.style.backgroundColor = '#f8f9fa';
                                input.style.color = '#6c757d';
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
    </div>
@endsection
