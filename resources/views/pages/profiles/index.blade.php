@extends('layouts.app')

@section('title', 'Profil')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profil</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        @if($student)
                            <div class="row">
                                <div class="col-md-9">
                                    <img src="{{ $student->foto_profil ? URL::asset('storage/'.$student->foto_profil) : asset('img/avatar/avatar-5.png') }}" alt="{{ $student->nama_lengkap }}" class="rounded-circle" style="max-width: 100px; height: auto; margin-bottom: 10px;">
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>Nama Lengkap</th>
                                                    <td>{{ $student->nama_lengkap }}</td>
                                                </tr>
                                                <tr>
                                                    <th>NIM</th>
                                                    <td>{{ $student->nim }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Lahir</th>
                                                    <td>{{ $student->tanggal_lahir }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jenis Kelamin</th>
                                                    <td>{{ $student->jenis_kelamin }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Angkatan</th>
                                                    <td>{{ $student->angkatan_mahasiswa }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Hobi</th>
                                                    <td>{{ $student->hobby }}</td>
                                                </tr>
                                                <!-- Tambahkan baris-baris lain yang diperlukan -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p>Maaf, data mahasiswa tidak ditemukan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
