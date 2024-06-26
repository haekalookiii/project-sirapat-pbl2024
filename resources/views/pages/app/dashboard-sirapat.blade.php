@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <style>

    </style>
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        
        <section class="section">
            <div class="section-header">
                <h1>Selamat Datang, {{ auth()->user()->name }}</h1>
            </div>
            @can('admin')
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4 id="day"></h4> <!-- Tampilkan hari disini -->
                            </div>
                            <div class="card-body">
                                <span id="date"></span> <!-- Tampilkan tanggal disini -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Tidak Hadir</h4>
                            </div>
                            <div class="card-body">
                                3
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Hadir</h4>
                            </div>
                            <div class="card-body">
                                47
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
            @can('user')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4 id="day"></h4> <!-- Tampilkan hari disini -->
                            </div>
                            <div class="card-body">
                                <span id="date"></span> <!-- Tampilkan tanggal disini -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        </section>
@can('user')
        <section class="section">
        <div class="section-body"></div>
            <div class="row mt-4" id="tabelPresensi">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tabel Presensi</h4>
                            <!-- <div class="section-header-button">
                                <a href="{{ route('student.create') }}" class="btn btn-primary">Tambah</a>
                            </div> -->
                        </div>
                        <div class="card-body">
                            <!-- <div class="float-right">
                                <form method="GET" action="{{ route('student.index') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" name="nama_lengkap">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div> -->
                            <div class="clearfix mb-3"></div>
                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Lengkap</th>
                                            <th>NIM</th>
                                            <th>Prodi</th>
                                            <th>Status Kehadiran</th>
                                            <th>Catatan Kehadiran</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table data goes here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endcan
@can('admin')
            <div class="row mt-4" id="tabelKehadiran">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tabel Kehadiran</h4>
                            <div class="section-header-button">
                                <a href="{{ route('student.create') }}" class="btn btn-primary">Tambah</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="float-right">
                                <form method="GET" action="{{ route('student.index') }}">
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
                                              
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcan
            </section>
        </div>
    </div> 
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script>
    // Mendapatkan elemen untuk menampilkan hari dan tanggal
    var dayElement = document.getElementById('day');
    var dateElement = document.getElementById('date');

    // Mendapatkan tanggal dan waktu saat ini
    var currentDate = new Date();

    // Mendapatkan nama hari dari tanggal saat ini
    var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    var dayName = days[currentDate.getDay()];

    // Format tanggal
    var dateFormatOptions = { month: '2-digit', day: '2-digit' };
    var formattedDate = currentDate.toLocaleDateString(undefined, dateFormatOptions);

    // Menampilkan hari dan tanggal real-time
    dayElement.textContent = dayName;
    dateElement.textContent = formattedDate;
</script>
<script>
document.getElementById('presensi').addEventListener('click', function() {
    var tablePresensi = document.getElementById('tabelPresensi');
    var tableKehadiran = document.getElementById('tabelKehadiran');
    
    // Tampilkan tabel presensi dan sembunyikan tabel kehadiran
    tablePresensi.style.display = 'block';
    tableKehadiran.style.display = 'none';
});

document.getElementById('rekapKehadiran').addEventListener('click', function() {
    var tablePresensi = document.getElementById('tabelPresensi');
    var tableKehadiran = document.getElementById('tabelKehadiran');
    
    // Tampilkan tabel kehadiran dan sembunyikan tabel presensi
    tablePresensi.style.display = 'none';
    tableKehadiran.style.display = 'block';
});

</script>


    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
