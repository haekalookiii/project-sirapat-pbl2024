@extends('layouts.app')

@section('title', 'New Student')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>New Student</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Students</a></div>
                    <div class="breadcrumb-item">New Student</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                    <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <div class="card-header">
                            <h4>New Student</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text"
                                    class="form-control @error('nama_lengkap')
                                    is-invalid
                                @enderror"
                                    name="nama_lengkap">
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nomor Induk Mahasiswa</label>
                                <input type="text"
                                    class="form-control @error('nim')
                                    is-invalid
                                @enderror"
                                    name="nim">
                                @error('nim')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="Date"
                                    class="form-control @error('tanggal_lahir')
                                    is-invalid
                                @enderror"
                                    name="tanggal_lahir">
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror 
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <div class="form-check">
                                    <input type="radio"
                                        class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                        name="jenis_kelamin"
                                        value="L">
                                    <label class="form-check-label">L</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio"
                                        class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                        name="jenis_kelamin"
                                        value="P">
                                    <label class="form-check-label">P</label>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            <div class="form-group">
                                <label>Foto Profil</label>
                                <input type="file"
                                    class="form-control @error('foto_profil')
                                    is-invalid
                                @enderror"
                                    name="foto_profil">
                                @error('foto_profil')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        <div class="form-group">
                                <label>Program Studi</label>
                                <select class="form-control @error('program_studi') is-invalid @enderror" name="program_studi">
                                    <option value="" selected disabled>Pilih Program Studi</option>
                                    <option value="Listrik">Listrik</option>
                                    <option value="TI">TI</option>
                                    <option value="SIKC">SIKC</option>
                                    <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                                </select>
                                @error('angkatan_mahasiswa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        <div class="form-group">
                                <label>Angkatan Mahasiswa</label>
                                <select class="form-control @error('angkatan_mahasiswa') is-invalid @enderror" name="angkatan_mahasiswa">
                                    <option value="" selected disabled>Pilih Tahun Angkatan</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2023</option>
                                    <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                                </select>
                                @error('angkatan_mahasiswa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        <div class="card-footer text-right">
                            <a class="btn btn-danger" href="{{ route('student.index') }}">Batal</a>
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
