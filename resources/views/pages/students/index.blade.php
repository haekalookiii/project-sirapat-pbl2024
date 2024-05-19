@extends('layouts.app')

@section('title', 'students')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>All Students</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Students</a></div>
                    <div class="breadcrumb-item">All Students</div>
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
                            <div class="card-header">
                                <h4>All Students</h4>
                                <div class="section-header-button">
                                    <a href="{{ route('student.create') }}" class="btn btn-primary">New Student</a>
                                </div>
                            </div>
                            <div class="card-body">

                            <div class="float-right">
                                    <form method="GET", action="{{ route('student.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="nama_lengkap">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>


                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>Foto Profil</th>
                                            <th>Nama Lengkap</th>
                                            <th>Nomor Induk Mahasiswa</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Angkatan Mahasiswa</th>
                                            <th>Hobby</th>
                                            <th>Action</th>
                                        </tr>
                                        
                                        @foreach ($students as $student)
                                        
                                            <tr>
                                                <td>
                                                    @if ($student->foto_profil)
                                                            <img src="{{ URL::asset('storage/'.$student->foto_profil) }}" alt="{{ $student->nama_lengkap }}" class="rounded-circle" style="max-width: 45px; height: auto;">
                                                        @else
                                                            <img src="{{ asset('img/avatar/avatar-5.png') }}" alt="{{ $student->nama_lengkap }}" class="rounded-circle" style="max-width: 45px; height: auto;">
                                                        @endif
                                                </td>
                                                <td>
                                                    {{ $student->nama_lengkap }}
                                                </td>
                                                <td>
                                                    {{ $student->nim }}
                                                </td>
                                                <td>
                                                    {{ $student->tanggal_lahir }}
                                                </td>
                                                <td>
                                                    {{ $student->jenis_kelamin }}
                                                </td>
                                                <td>
                                                    {{ $student->angkatan_mahasiswa }}
                                                </td>
                                                <td>
                                                    {{ $student->hobby }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('student.edit', $student->id) }}'
                                                            class="btn btn-sm btn-warning btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>

                                                        <form action="{{ route('student.destroy', $student->id) }}" method="POST"
                                                            class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}" />
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                
                                    {{ $students->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
