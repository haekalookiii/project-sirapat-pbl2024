<x-modal-action action="{{ $action }}">
    @if ($data->id)
        @method('put')
    @endif

    @can('admin')
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
                <input type="text" name="title" class="form-control" value="{{ $data->title }}">
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="agenda" class="form-label">Agenda:</label>
                    <textarea id="agenda" name="agenda" class="form-control">{{ $data->agenda }}</textarea>
                </div>
            </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="locate" class="form-label">Lokasi:</label>
                <input type="text" name="locate" class="form-control" value="{{ $data->locate }}">
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $data->category == 'success' ? 'checked' : null }} type="radio" name="category" id="category-success" value="success">
                    <label class="form-check-label" for="category-success">Tindak Lanjut</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $data->category == 'danger' ? 'checked' : null }} type="radio" name="category" id="category-danger" value="danger">
                    <label class="form-check-label" for="category-danger">Penting</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $data->category == 'warning' ? 'checked' : null }} type="radio" name="category" id="category-warning" value="warning">
                    <label class="form-check-label" for="category-warning">Perlu Diskusi</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $data->category == 'info' ? 'checked' : null }} type="radio" name="category" id="category-info" value="info">
                    <label class="form-check-label" for="category-info">Informasi</label>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="delete" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Delete</label>
                </div>
            </div>
        </div>
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
                <input type="text" name="locate" disabled class="form-control" value="{{ $data->locate }}">
            </div>
        </div>
    </div>
    @endcan
</x-modal-action>
