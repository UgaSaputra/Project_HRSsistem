@extends('layout.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pelanggaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Pelanggaran</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

<div class="container">
    <h1 class="text-center mb-4">EDIT DATA PELANGGARAN</h1>

    <form action="{{ route('pelanggaran.update', $employeeRecord->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="id_number">NIK Karyawan</label>
            <input type="text" id="id_number" name="id_number" class="form-control"
                value="{{ old('id_number', $employeeRecord->id_number) }}" placeholder="Masukkan NIK Karyawan" readonly>
        </div>
        <div class="form-group">
            <label for="offense_type">Jenis Pelanggaran</label>
            <input type="text" id="offense_type" name="offense_type" class="form-control"
                value="{{ old('offense_type', $employeeRecord->offense_type) }}" placeholder="Masukkan Jenis Pelanggaran" required>
        </div>
        <div class="form-group">
            <label for="offense_date">Tanggal Pelanggaran</label>
            <input type="date" id="offense_date" name="offense_date" class="form-control"
                value="{{ old('offense_date', $employeeRecord->offense_date) }}" placeholder="Masukkan Tanggal Pelanggaran">
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea id="description" name="description" class="form-control" required rows="4"
                placeholder="Masukkan Deskripsi">{{ old('description', $employeeRecord->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Update</button>
    </form>
</div>
</div>

@endsection
 