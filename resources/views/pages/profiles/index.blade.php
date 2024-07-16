@extends('layouts.app')

@section('title', 'Profil')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
            </div>
            
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                @if($student->tanggal_lahir)
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img src="{{ $student->foto_profil ? Storage::url($student->foto_profil) : asset('img/avatar/avatar-5.png') }}" alt="{{ $student->nama_lengkap }}" class="rounded-circle profile-picture mb-3" style="max-width: 150px; max-height: 150px;">
                                <h5>{{ $student->nama_lengkap }}</h5>
                                <a>{{ $student->nim }}</a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <!-- Form for changing profile picture -->
                                <form action="{{ route('update.profile.picture', $student->nim) }}" method="post" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="form-group">
                                        <label>Ubah Foto Profil</label>
                                        <input type="hidden" name="oldImage" value="{{ $student->foto_profil }}">
                                        <input type="file" class="form-control" name="foto_profil">
                                    </div>
                                    <button type="button" class="btn btn-primary btn-sm btn-update-profile">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Informasi Profil</h5>
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input type="text" class="form-control" name="tanggal_lahir" value="{{ date('d-m-Y', strtotime($student->tanggal_lahir )) }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <input type="text" class="form-control" name="jenis_kelamin" value="{{ $student->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Program Studi</label>
                                        <input type="text" class="form-control" name="program_studi" value="{{ $student->program_studi == 'TI' ? 'Teknik Informatika' : ($student->program_studi == 'Listrik' ? 'Teknik Listrik' : ($student->program_studi == 'SIKC' ? 'Sistem Informasi Kota Cerdas' : '')) }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Angkatan Mahasiswa</label>
                                        <input type="text" class="form-control" name="angkatan_mahasiswa" value="{{ $student->angkatan_mahasiswa }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @else
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="card">
                                        <form action="{{ route('profile.update', $student) }}" method="POST" enctype="multipart/form-data" id="updateProfileForm">
                                            @csrf
                                            @method('PUT')
                                            <div class="card-header">
                                                <h4>Edit Profile</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Foto Profil</label>
                                                    <input type="file" class="form-control @error('foto_profil') is-invalid @enderror" name="foto_profil" accept=".png, .jpg">
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
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Lengkap</label>
                                                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" value="{{ $student->nama_lengkap }}" readonly>
                                                    @error('nama_lengkap')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Nomor Induk Mahasiswa</label>
                                                    <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ $student->nim }}" readonly>
                                                    @error('nim')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Lahir</label>
                                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ $student->tanggal_lahir }}">
                                                    @error('tanggal_lahir')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" value="L" {{ old('jenis_kelamin', $student->jenis_kelamin) == 'L' ? 'checked' : '' }}>
                                                        <label class="form-check-label">Laki-laki</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" value="P" {{ old('jenis_kelamin', $student->jenis_kelamin) == 'P' ? 'checked' : '' }}>
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
                                                    @error('program_studi')
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
                                                        <option value="2024" {{ old('angkatan_mahasiswa', $student->angkatan_mahasiswa) == '2024' ? 'selected' : '' }}>2024</option>
                                                        <option value="2025" {{ old('angkatan_mahasiswa', $student->angkatan_mahasiswa) == '2025' ? 'selected' : '' }}>2025</option>
                                                        <!-- Add other options as needed -->
                                                    </select>
                                                    @error('angkatan_mahasiswa')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="card-footer text-right">
                                                    <button type="button" class="btn btn-primary btn-sm btn-update-profile">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
