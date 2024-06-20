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
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
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
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Riwayat Rapat</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalMeetings }}
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
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Status</th>
                                        </tr>
                                        @php
                                            $numberOfItems = $presences->perPage() * ($presences->currentPage() - 1);
                                        @endphp
                                        @foreach ($presences as $presence)
                                            <tr>
                                                <td>{{ $numberOfItems + $loop->iteration }}</td>
                                                <td>{{ $presence->schedule->title }}</td>
                                                <td>{{ $presence->schedule->start_date }}</td>
                                                <td>{{ $presence->schedule->end_date }}</td>
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
                                                            <button type="button" class="btn btn-sm btn-info btn-icon show-confirmation-modal" data-status="Hadir" data-url="{{ route('update.presence', $presence->id) }}" data-attendance-id="2">
                                                                <i class="fas fa-edit"></i> Hadir
                                                            </button>

                                                            <button type="button" class="btn btn-sm btn-success btn-icon show-confirmation-modal" data-status="Izin" data-url="{{ route('update.presence', $presence->id) }}" data-attendance-id="3">
                                                                <i class="fas fa-edit"></i> Izin
                                                            </button>

                                                            <button type="button" class="btn btn-sm btn-danger btn-icon show-confirmation-modal" data-status="Sakit" data-url="{{ route('update.presence', $presence->id) }}" data-attendance-id="4">
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
                                            <th>Action</th>
                                        </tr>
                                        @php
                                            $numberOfItems = $schedules->perPage() * ($schedules->currentPage() - 1);
                                        @endphp
                                        @foreach ($schedules as $schedule)
                                            <tr>
                                                <td>{{ $numberOfItems + $loop->iteration }}</td>
                                                <td>{{ $schedule->title }}</td>
                                                <td>{{ $schedule->start_date }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <form action="{{ route('presence.show', $schedule->title) }}" method="GET" class="mr-2">
                                                            <button class="btn btn-sm btn-warning btn-icon">
                                                                <i class="fas fa-edit"></i> Detail
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('presence.edit', $schedule->id) }}" method="GET" class="mr-2">
                                                            <button class="btn btn-sm btn-info btn-icon">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('presence.destroy', $schedule->id) }}" method="POST" class="mr-2">
                                                            @csrf
                                                            @method('DELETE')
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
