@extends('layouts.app')

@section('title', 'All Presences')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>All Schedules</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Presences</a></div>
                    <div class="breadcrumb-item">All Presences</div>
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
                                            @can('admin')
                                            <th>Action</th>
                                            @endcan
                                        </tr>
                                        @php
                                            $numberOfItems = $schedules->perPage() * ($schedules->currentPage() - 1);
                                        @endphp
                                        @foreach ($schedules as $schedule)
                                            <tr>
                                                <td>{{ $numberOfItems + $loop->iteration }}</td>
                                                <td>{{ $schedule->title }}</td>
                                                <td>{{ $schedule->start_date }}</td>
                                                @can('admin')
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <form action="{{ route('presence.show', $schedule->title) }}" method="GET" class="mr-2">
                                                            <button class="btn btn-sm btn-secondary btn-icon">
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
                                                @endcan
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
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
