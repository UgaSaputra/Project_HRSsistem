<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulir Karyawan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Style/show.css">
</head>

<body>
    <div class="container">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createEmployeeModal">
            Tambah Karyawan
        </button>
        <div class="modal fade" id="createEmployeeModal" tabindex="-1" role="dialog"
            aria-labelledby="createEmployeeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('karyawan.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="id_number">Nomor KTP</label>
                                <input type="text" id="id_number" name="id_number" class="form-control"
                                    placeholder="Masukkan Nomor KTP" required>
                            </div>
                            <div class="form-group">
                                <label for="full_name">Nama Lengkap</label>
                                <input type="text" id="full_name" name="full_name" class="form-control"
                                    placeholder="Masukkan Nama Lengkap" required>
                            </div>
                            <div class="form-group">
                                <label for="nickname">Nama Panggilan</label>
                                <input type="text" id="nickname" name="nickname" class="form-control"
                                    placeholder="Masukkan Nama Panggilan">
                            </div>
                            <div class="form-group">
                                <label for="contract_date">Tanggal Kontrak</label>
                                <input type="date" id="contract_date" name="contract_date" class="form-control"
                                    required>
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
                                    placeholder="Masukkan Jabatan">
                            </div>
                            <div class="form-group">
                                <label for="nuptk">NUPTK</label>
                                <input type="text" id="nuptk" name="nuptk" class="form-control"
                                    placeholder="Masukkan NUPTK">
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
                                    placeholder="Masukkan Tempat Lahir">
                            </div>
                            <div class="form-group">
                                <label for="birth_date">Tanggal Lahir</label>
                                <input type="date" id="birth_date" name="birth_date" class="form-control"
                                    required>
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
                                <label for="e_mail">Email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Masukkan Email">
                            </div>
                            <div class="form-group">
                                <label for="hobby">Hobi</label>
                                <input type="text" id="hobby" name="hobby" class="form-control"
                                    placeholder="Masukkan Hobi">
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
                                <input type="text" id="residence_address" name="residence_address"
                                    class="form-control" placeholder="Masukkan Alamat Tempat Tinggal">
                            </div>
                            <div class="form-group">
                                <label for="phone">Nomor Telepon</label>
                                <input type="tel" id="phone" name="phone" class="form-control"
                                    placeholder="Masukkan Nomor Telepon">
                            </div>
                            <div class="form-group">
                                <label for="address_emergency">Alamat Darurat</label>
                                <input type="text" id="address_emergency" name="address_emergency"
                                    class="form-control" placeholder="Masukkan Alamat Darurat">
                            </div>
                            <div class="form-group">
                                <label for="phone_emergency">Telepon Darurat</label>
                                <input type="tel" id="phone_emergency" name="phone_emergency"
                                    class="form-control" placeholder="Masukkan Telepon Darurat">
                            </div>
                            <div class="form-group">
                                <label for="blood_type">Golongan Darah</label>
                                <input type="text" id="blood_type" name="blood_type" class="form-control"
                                    placeholder="Masukkan Golongan Darah">
                            </div>
                            <div class="form-group">
                                <label for="last_education">Pendidikan Terakhir</label>
                                <input type="text" id="last_education" name="last_education" class="form-control"
                                    placeholder="Masukkan Pendidikan Terakhir">
                            </div>
                            <div class="form-group">
                                <label for="agency">Instansi</label>
                                <input type="text" id="agency" name="agency" class="form-control"
                                    placeholder="Masukkan Instansi">
                            </div>
                            <div class="form-group">
                                <label for="graduation_year">Tahun Lulus</label>
                                <input type="text" id="graduation_year" name="graduation_year"
                                    class="form-control" placeholder="Masukkan Tahun Lulus">
                            </div>
                            <div class="form-group">
                                <label for="competency_training_place">Tempat Pelatihan Kompetensi</label>
                                <input type="text" id="competency_training_place" name="competency_training_place"
                                    class="form-control" placeholder="Masukkan Tempat Pelatihan Kompetensi">
                            </div>
                            <div class="form-group">
                                <label for="organizational_experience">Pengalaman Organisasi</label>
                                <input type="text" id="organizational_experience" name="organizational_experience"
                                    class="form-control" placeholder="Masukkan Pengalaman Organisasi">
                            </div>
                            <div class="form-group">
                                <label for="mate_name">Nama Pasangan</label>
                                <input type="text" id="mate_name" name="mate_name" class="form-control"
                                    placeholder="Masukkan Nama Pasangan">
                            </div>
                            <div class="form-group">
                                <label for="child_name">Nama Anak</label>
                                <input type="text" id="child_name" name="child_name" class="form-control"
                                    placeholder="Masukkan Nama Anak">
                            </div>
                            <div class="form-group">
                                <label for="wedding_date">Tanggal Menikah</label>
                                <input type="date" id="wedding_date" name="wedding_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="wedding_certificate_number">Nomor Surat Nikah</label>
                                <input type="text" id="wedding_certificate_number"
                                    name="wedding_certificate_number" class="form-control"
                                    placeholder="Masukkan Nomor Surat Nikah">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nomor KTP</th>
                    <th>Nama Lengkap</th>
                    <th>Nama Panggilan</th>
                    <th>Tanggal Kontrak</th>
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
                @foreach ($employee as $employees)
                    <tr>
                        <td>{{ $employees->id_number }}</td>
                        <td>{{ $employees->full_name }}</td>
                        <td>{{ $employees->nickname }}</td>
                        <td>{{ $employees->contract_date }}</td>
                        <td>{{ $employees->work_date }}</td>
                        <td>{{ $employees->status }}</td>
                        <td>{{ $employees->position }}</td>
                        <td>{{ $employees->nuptk }}</td>
                        <td>{{ $employees->gender }}</td>
                        <td>{{ $employees->place_birth }}</td>
                        <td>{{ $employees->birth_date }}</td>
                        <td>{{ $employees->religion }}</td>
                        <td>{{ $employees->email }}</td>
                        <td>{{ $employees->hobby }}</td>
                        <td>{{ $employees->marital_status }}</td>
                        <td>{{ $employees->residence_address }}</td>
                        <td>{{ $employees->phone }}</td>
                        <td>{{ $employees->address_emergency }}</td>
                        <td>{{ $employees->phone_emergency }}</td>
                        <td>{{ $employees->blood_type }}</td>
                        <td>{{ $employees->last_education }}</td>
                        <td>{{ $employees->agency }}</td>
                        <td>{{ $employees->graduation_year }}</td>
                        <td>{{ $employees->competency_training_place }}</td>
                        <td>{{ $employees->organizational_experience }}</td>

                        <td>
                            @if ($employees->familyData)
                                <p>{{ $employees->familyData->mate_name }}</p>
                            @endif
                        </td>
                        <td>
                            @if ($employees->familyData)
                                <p>{{ $employees->familyData->child_name }}</p>
                            @endif
                        </td>
                        <td>
                            @if ($employees->familyData)
                                <p>{{ $employees->familyData->wedding_date }}</p>
                            @endif
                        </td>
                        <td>
                            @if ($employees->familyData)
                                <p>{{ $employees->familyData->wedding_certificate_number }}</p>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('employee.edit', $employees->id_number) }}"
                                class="btn btn-primary">Edit</a>
                            <form action="{{ route('employee.destroy', $employees->id_number) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
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
</body>

</html>
