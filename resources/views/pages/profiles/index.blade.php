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
                <div class="card">
                    <div class="card-body">
                        @if($student->nim)
                            <div class="row">
                                <div class="col-md-9">
                                    <img src="{{ $student->foto_profil ? URL::asset('storage/'.$student->foto_profil) : asset('img/avatar/avatar-5.png') }}" alt="{{ $student->nama_lengkap }}" class="rounded-circle" style="max-width: 100px; height: auto; margin-bottom: 10px;">
                                </div>
                                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text"
                                    class="form-control @error('nama_lengkap')
                                    is-invalid
                                @enderror"
                                    name="nama_lengkap" value="{{ $student->nama_lengkap }}">
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
                                    name="nim" value="{{ $student->nim }}">
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
                                    name="tanggal_lahir" value="{{ $student->tanggal_lahir }}">
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <input type="text"
                                    class="form-control @error('nama_lengkap')
                                    is-invalid
                                @enderror"
                                    name="nama_lengkap" value="{{ $student->jenis_kelamin }}">
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                            <label>Angkatan Mahasiswa</label>
                            <select class="form-control @error('angkatan_mahasiswa') is-invalid @enderror" name="angkatan_mahasiswa">
                                <option value="" selected disabled>Pilih Tahun Angkatan</option>
                                <option value="2021" {{ old('angkatan_mahasiswa', $student->angkatan_mahasiswa) == '2021' ? 'selected' : '' }}>2021</option>
                                <option value="2022" {{ old('angkatan_mahasiswa', $student->angkatan_mahasiswa) == '2022' ? 'selected' : '' }}>2022</option>
                                <option value="2023" {{ old('angkatan_mahasiswa', $student->angkatan_mahasiswa) == '2023' ? 'selected' : '' }}>2023</option>
                                <!-- Add other options as needed -->
                            </select>
                            @error('angkatan_mahasiswa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        @else

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                    <form action="{{ route('profile.update', $student) }}" method="POST"enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Profil</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Foto Profil</label>
                                <input type="file"
                                    class="form-control @error('foto_profil') is-invalid @enderror"
                                    name="foto_profil">

                                @if($student->foto_profil)
                                    <div class="current-profile-picture">
                                        <p><span>{{ basename($student->foto_profil) }}</span></p>
                                    </div>
                                @endif

                                @error('foto_profil')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text"
                                    class="form-control @error('nama_lengkap')
                                    is-invalid
                                @enderror"
                                    name="nama_lengkap" value="{{ $student->nama_lengkap }}">
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
                                    name="nim" value="{{ $student->nim }}">
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
                                    name="tanggal_lahir" value="{{ $student->tanggal_lahir }}">
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <div class="form-check">
                                    <input type="radio"
                                        class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                        name="jenis_kelamin"
                                        value="L" {{ old('jenis_kelamin', $student->jenis_kelamin) == 'L' ? 'checked' : '' }}>
                                    <label class="form-check-label">Laki-laki</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio"
                                        class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                        name="jenis_kelamin"
                                        value="P" {{ old('jenis_kelamin', $student->jenis_kelamin) == 'P' ? 'checked' : '' }}>
                                    <label class="form-check-label">Perempuan</label>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>    
                        <div class="form-group">
                            <label>Program Studi</label>
                            <select class="form-control @error('program_studi') is-invalid @enderror" name="program_studi">
                                <option value="" selected disabled>Pilih Program Studi</option>
                                <option value="Listrik" {{ old('program_studi', $student->program_studi) == 'Listrik' ? 'selected' : '' }}>Listrik</option>
                                <option value="TI" {{ old('program_studi', $student->program_studi) == 'TI' ? 'selected' : '' }}>TI</option>
                                <option value="SIKC" {{ old('program_studi', $student->program_studi) == 'SIKC' ? 'selected' : '' }}>SIKC</option>
                                <!-- Add other options as needed -->
                            </select>
                            @error('angkatan_mahasiswa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        </div>
                            <div class="form-group">
                            <label>Angkatan Mahasiswa</label>
                            <select class="form-control @error('angkatan_mahasiswa') is-invalid @enderror" name="angkatan_mahasiswa">
                                <option value="" selected disabled>Pilih Tahun Angkatan</option>
                                <option value="2021" {{ old('angkatan_mahasiswa', $student->angkatan_mahasiswa) == '2021' ? 'selected' : '' }}>2021</option>
                                <option value="2022" {{ old('angkatan_mahasiswa', $student->angkatan_mahasiswa) == '2022' ? 'selected' : '' }}>2022</option>
                                <option value="2023" {{ old('angkatan_mahasiswa', $student->angkatan_mahasiswa) == '2023' ? 'selected' : '' }}>2023</option>
                                <!-- Add other options as needed -->
                            </select>
                            @error('angkatan_mahasiswa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        <div class="card-footer text-right">
                            <a class="btn btn-danger" href="{{ route('student.index') }}">Batal</a>
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
