@extends('layouts.app')

@section('title', 'Edit Student')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Student</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Students</a></div>
                    <div class="breadcrumb-item">Edit Student</div>
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
                    <form action="{{ route('student.update', $student) }}" method="POST"enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Student</h4>
                        </div>
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
                                <div class="form-check">
                                    <input type="radio"
                                        class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                        name="jenis_kelamin"
                                        value="L" {{ old('jenis_kelamin', $student->jenis_kelamin) == 'L' ? 'checked' : '' }}>
                                    <label class="form-check-label">L</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio"
                                        class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                        name="jenis_kelamin"
                                        value="P" {{ old('jenis_kelamin', $student->jenis_kelamin) == 'P' ? 'checked' : '' }}>
                                    <label class="form-check-label">P</label>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


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
                        </div>
                           <div class="form-group">
                            <label>Hobby</label>
                            <div class="form-check">
                                <input type="checkbox"
                                    class="form-check-input @error('hobby') is-invalid @enderror"
                                    name="hobby[]" value="Bola" {{ in_array('Bola', old('hobby', explode(',', $student->hobby ?? ''))) ? 'checked' : '' }}>
                                <label class="form-check-label">Bola</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox"
                                    class="form-check-input @error('hobby') is-invalid @enderror"
                                    name="hobby[]" value="Baca" {{ in_array('Baca', old('hobby', explode(',', $student->hobby ?? ''))) ? 'checked' : '' }}>
                                <label class="form-check-label">Baca</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox"
                                    class="form-check-input @error('hobby') is-invalid @enderror"
                                    name="hobby[]" value="Menyanyi" {{ in_array('Menyanyi', old('hobby', explode(',', $student->hobby ?? ''))) ? 'checked' : '' }}>
                                <label class="form-check-label">Menyanyi</label>
                            </div>
                            @error('hobby')
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
