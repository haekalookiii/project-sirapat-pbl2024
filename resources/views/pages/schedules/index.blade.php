@extends('layouts.app')

@section('title', 'Schedules')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Schedules</h1>

                <!-- <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Schedules</a></div>
                    <div class="breadcrumb-item">Schedules</div>
                </div> -->
            </div>
            <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
            <div class="section-body">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Schedules</h4>
                                <!-- @can('admin')
                                <div class="section-header-button">
                                    <a href="{{ route('presence.index') }}" class="btn btn-primary">Detail</a>
                                </div>
                                @endcan -->
                            </div>
                            <div class="card-body">
                                <div id='calendar'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal" id="modal-action" tabindex="-1">
            
        </div>
    </div>
@endsection

@push('scripts')
    

@endpush
