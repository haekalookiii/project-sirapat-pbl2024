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
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET" action="{{ route('presence.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="name" value="{{ request()->input('name') }}">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>No.</th>
                                            <th>Rapat</th>
                                            <th>NIM</th>
                                            <th>Nama Lengkap</th>
                                            <th>Tanggal</th>
                                            <th>Status Kehadiran</th>
                                            <th>Action</th>
                                        </tr>
                                        @php
                                            $numberOfItems = $presences->perPage() * ($presences->currentPage() - 1);
                                        @endphp
                                        @foreach ($presences as $presence)
                                            <tr>
                                                <td>{{ $numberOfItems + $loop->iteration }}</td>
                                                <td>{{ $presence->schedule->title }}</td>
                                                <td>{{ $presence->student->nim }}</td>
                                                <td>{{ $presence->student->nama_lengkap }}</td>
                                                <td>{{ date('d-m-Y', strtotime($presence->created_at)) }}</td>
                                                <td>{{ $presence->attendance->status_kehadiran }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <button type="button" class="btn btn-sm btn-warning btn-icon edit-button" data-id="{{ $presence->id }}" data-attendance="{{ $presence->attendance_id }}">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </button>
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
