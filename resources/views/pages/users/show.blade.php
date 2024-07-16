@extends('layouts.app')

@section('title', 'Profil')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profil</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img src="{{ $student->foto_profil ? URL::asset('storage/'.$student->foto_profil) : asset('img/avatar/avatar-5.png') }}" alt="{{ $student->nama_lengkap }}" class="rounded-circle profile-picture mb-3" style="max-width: 150px; max-height: 150px;">
                                <h5>{{ $student->nama_lengkap }}</h5>
                                <a>{{ $student->nim }}</a>
                            </div>
                        </div>
                            <div class="card">
                                <div class="card-body">
                                    <!-- <h5>History Presensi</h5> -->
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>Alpa</span>
                                            <span class="badge bg-danger rounded-pill">{{ $attendanceStatuses['alpa'] }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>Hadir</span>
                                            <span class="badge bg-success rounded-pill">{{ $attendanceStatuses['hadir'] }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>Izin</span>
                                            <span class="badge bg-info rounded-pill">{{ $attendanceStatuses['izin'] }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>Sakit</span>
                                            <span class="badge bg-warning rounded-pill">{{ $attendanceStatuses['sakit'] }}</span>
                                        </li>
                                    </ul>
                                    {{ $presences->links() }}
                                </div>
                            </div>
                        </div>
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5>Informasi Profil</h5>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="text" class="form-control" name="tanggal_lahir" value="{{ $student->tanggal_lahir ? date('d-m-Y', strtotime($student->tanggal_lahir)) : '' }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <input type="text" class="form-control" name="jenis_kelamin" value="{{ $student->jenis_kelamin == 'L' ? 'Laki-laki' : ($student->jenis_kelamin == 'P' ? 'Perempuan' : '') }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Program Studi</label>
                                    <input type="text" class="form-control" name="program_studi" value="{{ $student->program_studi == 'TI' ? 'Teknik Informatika' : ($student->program_studi == 'Listrik' ? 'Teknik Listrik' : ($student->program_studi == 'SIKC' ? 'Sistem Informasi Kota Cerdas' : '')) }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Angkatan Mahasiswa</label>
                                    <input type="text" class="form-control" name="angkatan_mahasiswa" value="{{ $student->angkatan_mahasiswa }}" disabled>
                                </div>
                                <div class="card-footer text-right">
                                    <a class="btn btn-danger" href="{{ route('user.index') }}">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
