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
                <h1>All Presences</h1>
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
                                <h4>All Presences</h4>
                                <div class="section-header-button">
                                    <a href="{{ route('presence.create') }}" class="btn btn-primary">New Presence</a>
                                </div>
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
                                            <th>Schedule</th>
                                            <th>Student</th>
                                            <th>NIM</th>
                                            <th>Nama Lengkap</th>
                                            <th>Status Kehadiran</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($presences as $presence)
                                            <tr>
                                                <td>{{ $presence->schedule->name }}</td>
                                                <td>{{ $presence->student->name }}</td>
                                                <td>{{ $presence->nim }}</td>
                                                <td>{{ $presence->nama_lengkap }}</td>
                                                <td>{{ $presence->status_kehadiran }}</td>
                                                <td>{{ $presence->created_at }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('presence.edit', $presence->id) }}" class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <form action="{{ route('presence.destroy', $presence->id) }}" method="POST" class="ml-2">
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
                                    {{ $presences->withQueryString()->links() }}
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
