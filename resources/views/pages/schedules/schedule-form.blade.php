<x-modal-action action="{{ $action }}">
    @if ($data->id)
        @method('put')
    @endif

    @can('admin')
    @if($data->title)
        <h5 class="modal-title">Update Schedule</h5>
        @else
        <h5 class="modal-title">Create Schedule</h5>
        @endif
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="start_date" class="form-label">Tanggal Mulai:</label>
                <input type="text" name="start_date" readonly value="{{ $data->start_date ?? request()->start_date }}" class="form-control datepicker">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="end_date" class="form-label">Tanggal Selesai:</label>
                <input type="text" name="end_date" readonly value="{{ $data->end_date ?? request()->end_date }}" class="form-control datepicker">
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="title" class="form-label">Judul:</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $data->title }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="agenda" class="form-label">Agenda:</label>
                <textarea id="agenda" name="agenda" class="form-control @error('agenda') is-invalid @enderror">{{ $data->agenda }}</textarea>
                @error('agenda')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="location" class="form-label">Lokasi:</label>
                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ $data->location }}">
                @error('location')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <label class="form-label">Kategori:</label>
            <div class="selectgroup w-100">
                <label class="selectgroup-item">
                    <input {{ $data->category == 'success' ? 'checked' : null }} type="radio" name="category" id="category-success" value="success" class="selectgroup-input"
                    checked="">
                    <span class="selectgroup-button">Hijau</span>
                </label>
                <label class="selectgroup-item">
                    <input {{ $data->category == 'danger' ? 'checked' : null }} type="radio" name="category" id="category-danger" value="danger" class="selectgroup-input">
                    <span class="selectgroup-button">Merah</span>
                </label>
                <label class="selectgroup-item">
                    <input {{ $data->category == 'warning' ? 'checked' : null }} type="radio" name="category" id="category-warning" value="warning" class="selectgroup-input">
                    <span class="selectgroup-button">Orange</span>
                </label>
                <label class="selectgroup-item">
                    <input {{ $data->category == 'info' ? 'checked' : null }} type="radio" name="category" id="category-info" value="info" class="selectgroup-input">
                    <span class="selectgroup-button">Biru</span>
                </label>
            </div>
        </div>
        @if($data->title)
        <div class="col-12">
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="delete" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Delete</label>
                </div>
            </div>
        </div>
        @endif
    </div>
    @endcan

    @can('user')
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="start_date" class="form-label">Tanggal Mulai:</label>
                <input type="text" name="start_date" disabled value="{{ $data->start_date ?? request()->start_date }}" class="form-control">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="end_date" class="form-label">Tanggal Selesai:</label>
                <input type="text" name="end_date" disabled value="{{ $data->end_date ?? request()->end_date }}" class="form-control">
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="title" class="form-label">Judul:</label>
                <input type="text" name="title" disabled class="form-control" value="{{ $data->title }}">
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="agenda" class="form-label">Agenda:</label>
                    <textarea id="agenda" name="agenda" disabled class="form-control">{{ $data->agenda }}</textarea>
                </div>
            </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="locate" class="form-label">Lokasi:</label>
                <input type="text" name="locate" disabled class="form-control" value="{{ $data->location }}">
            </div>
        </div>
    </div>
    @endcan
</x-modal-action>