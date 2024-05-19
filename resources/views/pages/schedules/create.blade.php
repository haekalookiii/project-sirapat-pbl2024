@extends('layouts.app')

@section('title', 'New Schedule')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>New Schedule</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Schedules</a></div>
                    <div class="breadcrumb-item">New Schedule</div>
                </div>
            </div>

            <div class="section-body">

                <div class="card">
                    <form action="{{ route('schedule.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>New Schedule</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text"
                                    class="form-control @error('subject_id')
                                    is-invalid
                                @enderror"
                                    name="subject_id">
                                @error('subject_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Day</label>
                                <input type="text"
                                    class="form-control @error('hari')
                                    is-invalid
                                @enderror"
                                    name="hari">
                                @error('hari')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Start Time</label>
                                <input type="time"
                                    class="form-control @error('jam_mulai')
                                    is-invalid
                                @enderror"
                                    name="jam_mulai">
                                @error('jam_mulai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>End Time</label>
                                <input type="time"
                                    class="form-control @error('jam_selesai')
                                    is-invalid
                                @enderror"
                                    name="jam_selesai">
                                @error('jam_selesai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror 
                            </div>
                            <div class="form-group">
                                <label>Room</label>
                                <input type="text"
                                    class="form-control @error('ruangan')
                                    is-invalid
                                @enderror"
                                    name="ruangan">
                                @error('ruangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Atendence Code</label>
                                <input type="text"
                                    class="form-control @error('kode_absensi')
                                    is-invalid
                                @enderror"
                                    name="kode_absensi">
                                @error('kode_absensi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Academic Year</label>
                                <input type="text"
                                    class="form-control @error('tahun_akademik')
                                    is-invalid
                                @enderror"
                                    name="tahun_akademik">
                                @error('tahun_akademik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Semester</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="semester" value="Ganjil" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button">Ganjil</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="semester" value="Genap" class="selectgroup-input">
                                        <span class="selectgroup-button">Genap</span>
                                    </label>
                                </div>
                        <div class="card-footer text-right">
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
