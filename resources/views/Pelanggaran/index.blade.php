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
                            <li class="breadcrumb-item"><a href="{{route ('home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route ('karyawan.inputPelanggaran')}}">Tambah Data</a></li>
                            <li class="breadcrumb-item active">Data Pelanggaran</li>
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
                            <th>NIK Karyawan</th>
                            <th>Jenis Pelanggaran</th>
                            <th>Tanggal Pelanggaran</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->id_number }}</td>
                                <td>{{ $employee->offense_type }}</td>
                                <td>{{ $employee->offense_date }}</td>
                                <td>{{ $employee->description }}</td>
                                <td>
                                    <form action="{{ route('pelanggaran.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                
                                        @can('isadmin')
                                            <a href="{{ route('pelanggaran.edit', $employee->id) }}" class="btn btn-primary">Edit</a>
                                            <button type="submit" class="btn btn-primary mt-1">Catatan HRD</button>
                                        @endcan
                                
                                        @can('ismanager')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                            <a href="{{ route('pelanggaran.edit', $employee->id) }}" class="btn btn-primary">Edit</a>
                                            <button type="submit" class="btn btn-primary mt-1">Catatan HRD</button>
                                        @endcan
                                    </form>
                                </td>
                                
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
