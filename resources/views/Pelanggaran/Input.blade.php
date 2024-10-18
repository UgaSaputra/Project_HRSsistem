@extends('layout.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('Pelanggaran.index')}}">Lihat Data</a></li>
                            <li class="breadcrumb-item active">Tambah Pelanggaran</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <h1 class="text-center mb-3">TAMBAH DATA PELANGGARAN</h1>
        </div>

        <!-- Form Section -->
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('Pelanggaran.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="id_number">NIK Karyawan</label>
                    <select id="id_number" name="id_number" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id_number }}" data-full-name="{{ $employee->full_name }}">
                                {{ $employee->id_number }} - {{ $employee->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>                
                <div class="form-group">
                    <label for="offense_type">Jenis Pelanggaran</label>
                    <input type="text" id="offense_type" name="offense_type" class="form-control"
                        placeholder="Masukkan Jenis Pelanggaran" required>
                </div>
                <div class="form-group">
                    <label for="offense_date">Tanggal Pelanggaran</label>
                    <input type="date" id="offense_date" name="offense_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" placeholder="Masukkan Deskripsi" required
                        rows="4"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('Pelanggaran.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
