    @extends('layout.admin')

    @section('content')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('karyawan.index') }}">Lihat Data</a></li>
                                <li class="breadcrumb-item active">Data Karyawan</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <div class="container">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif


                <div class="container">
                    
                    <h1 class="text-center mb-4">DATA ABSEN KARYAWAN</h1>

                    <button class="btn btn-success mb-5">Import</button>

                    <form action="{{ route('absen.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="marital_status">Pilih Nama Anda</label>
                            <select id="marital_status" name="id_number" class="form-control" required>
                                    <option value="pilih" disabled>pilih</option>
                                    @foreach($absensi as $absensis)
                                        <option value="{{ $absensis->id_number }}">{{ $absensis->full_name }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </form>
                </div>
                <table class="table mt-5" style="text-align: center">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Status</th>
                            <th scope="col">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($absensi as $absensis)
                            <tr>
                                <th scope="row">{{ $no++ }}</th>
                                <td>{{ $absensis->employee->full_name ?? 'Nama Tidak Tersedia' }}</td>
                                <td>{{ $absensis->keterangan }}</td>
                                <td>{{ $absensis->waktu_masuk }}  {{ $absensis->waktu_ubah }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    @endsection
