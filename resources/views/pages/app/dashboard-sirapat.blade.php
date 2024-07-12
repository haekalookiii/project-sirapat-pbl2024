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
                <h1>Dashbord</h1>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-hand-paper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h3>Selamat Datang</h>
                            </div>
                            <div class="card-body">
                                {{ auth()->user()->name }}
                                @can('user')
                                {{ auth()->user()->username }}
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h3>Tanggal Hari Ini</h3> <!-- Tampilkan hari disini -->
                            </div>
                            <div class="card-body">
                                <span id="date"></span> <!-- Tampilkan tanggal disini -->
                            </div>
                        </div>
                    </div>
                </div>

        </section>
@can('user')
        <section class="section">
            <div class="section-body">

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Presences</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET" action="{{ route('presence.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="query">
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
                                            <th>No.</th>
                                            <th>Agenda Rapat</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Status</th>
                                        </tr>
                                        @php
                                            $numberOfItems = $presences->perPage() * ($presences->currentPage() - 1);
                                        @endphp
                                        @foreach ($presences as $presence)
                                            <tr>
                                                <td>{{ $numberOfItems + $loop->iteration }}</td>
                                                <td>{{ $presence->schedule->title }}</td>
                                                <td>{{ $presence->schedule->start_date }} - {{ $presence->schedule->end_date }}</td>
                                                <td>{{ $presence->schedule->start_time }} - {{ $presence->schedule->end_time }}</td>
                                                <td>
                                                    @php
                                                        $now = \Carbon\Carbon::now();
                                                        $openedAt = \Carbon\Carbon::parse($presence->opened_at);
                                                        $closedAt = \Carbon\Carbon::parse($presence->closed_at);
                                                    @endphp

                                                    @if ($presence->attendance->status_kehadiran == 'Hadir')
                                                        <button type="button" class="btn btn-sm btn-success btn-icon" disabled>
                                                            Hadir
                                                        </button>
                                                    @elseif($presence->attendance->status_kehadiran == 'Izin')
                                                        <button type="button" class="btn btn-sm btn-warning btn-icon" disabled>
                                                            Izin
                                                        </button>
                                                    @elseif($presence->attendance->status_kehadiran == 'Sakit')
                                                        <button type="button" class="btn btn-sm btn-warning btn-icon" disabled>
                                                            Sakit
                                                        </button>
                                                    @elseif($now >= $openedAt && $now <= $closedAt)
                                                        <div class="dropdown d-inline">
                                                            <button type="button" class="btn btn-sm btn-info btn-icon update-status-btn" data-status="Hadir" data-url="{{ route('update.presence', $presence->id) }}">
                                                                <i class="fas fa-edit"></i> Hadir
                                                            </button>

                                                            <button type="button" class="btn btn-sm btn-success btn-icon update-status-btn" data-status="Izin" data-url="{{ route('update.presence', $presence->id) }}">
                                                                <i class="fas fa-edit"></i> Izin
                                                            </button>

                                                            <button type="button" class="btn btn-sm btn-danger btn-icon update-status-btn" data-status="Sakit" data-url="{{ route('update.presence', $presence->id) }}">
                                                                <i class="fas fa-edit"></i> Sakit
                                                            </button>
                                                        </div>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-danger btn-icon" disabled>
                                                            Alpa
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $presences->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endcan
@can('admin')
            <section class="section">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Schedules</h4>
                </div>
                <div class="card-body">
                    <div class="float-right mb-3">
                        <form method="GET" action="{{ route('home') }}">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="query">
                                <select name="month" class="form-control ml-2">
                                    <option value="">All Months</option>
                                    @foreach (range(1, 12) as $month)
                                        <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                            {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                        </option>
                                    @endforeach
                                </select>
                                <select name="year" class="form-control ml-2">
                                    <option value="">All Years</option>
                                    @foreach (range(2020, date('Y')) as $year)
                                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Agenda Rapat</th>
                                    <th>Tanggal</th>
                                    <th>Lokasi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $numberOfItems = $schedules->perPage() * ($schedules->currentPage() - 1);
                                @endphp
                                @foreach ($schedules as $schedule)
                                    <tr>
                                        <td>{{ $numberOfItems + $loop->iteration }}</td>
                                        <td>{{ $schedule->title }}</td>
                                        <td>{{ $schedule->start_date }} - {{ $schedule->end_date }}</td>
                                        <td>{{ $schedule->locate }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <form action="{{ route('presence.show', $schedule->title) }}" method="GET" class="mr-2">
                                                    <button type="submit" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </button>
                                                </form>
                                                <form action="{{ route('presence.store') }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                                                    <button type="button" class="btn btn-primary btn-sm btn-create-presensi" data-schedule-title="{{ $schedule->title }}">
                                                        Buat Presensi
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="float-right">
                        {{ $schedules->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endcan
        </div>
    </div> 

@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
