@extends('layouts.app')

@section('title', 'Create Presence')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Create Presence</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Presence</a></div>
                    <div class="breadcrumb-item">Create Presence</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <div class="card">
                    <form action="{{ route('presence.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Create Presence</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="schedule_id">Select Schedule</label>
                                <select name="schedule_id" id="schedule_id" class="form-control @error('schedule_id') is-invalid @enderror" required>
                                    <option value="" disabled selected>Select a schedule</option>
                                    @foreach($schedules as $schedule)
                                    <option value="{{ $schedule->id }}">{{ $schedule->title }}</option>
                                    @endforeach
                                </select>
                                @error('schedule_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
