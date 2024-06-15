@extends('layouts.app')

@section('title', 'New User')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>New User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Users</a></div>
                    <div class="breadcrumb-item">New User</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <div class="card">
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4>New User</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Upload CSV</label>
                                <input type="file" name="csv_file" class="form-control @error('csv_file') is-invalid @enderror" id="csv_file">
                                @error('csv_file')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>NIM</label>
                                <input type="text"
                                    class="form-control @error('nim') is-invalid @enderror"
                                    name="nim" id="nim" value="{{ old('nim') }}">
                                @error('nim')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email" id="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Roles</label>
                                <select class="form-control @error('roles') is-invalid @enderror" name="roles" id="roles">
                                    <option value="">Select Role</option>
                                    <option value="admin" {{ old('roles') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ old('roles') == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                                @error('roles')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.getElementById('csv_file').addEventListener('change', function() {
            let isCsvSelected = this.files.length > 0;

            document.getElementById('name').required = !isCsvSelected;
            document.getElementById('nim').required = !isCsvSelected;
            document.getElementById('email').required = !isCsvSelected;
            document.getElementById('password').required = !isCsvSelected;
            document.getElementById('roles').required = !isCsvSelected;
        });
    </script>
@endsection
