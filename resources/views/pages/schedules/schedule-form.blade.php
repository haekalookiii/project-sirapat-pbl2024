<x-modal-action action="{{ $action }}">
@if ($data->id)
    @method('put')
@endif
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <input type="text" name="start_date" value="{{ $data->start_date ?? request()->start_date }}" class="form-control @error('start_date') is-invalid @enderror"> 
                @error('start_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <input type="text" name="end_date" value="{{ $data->end_date ?? request()->end_date }}" class="form-control @error('end_date') is-invalid @enderror">
                @error('end_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror 
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <textarea name="title" class="form-control @error('title') is-invalid @enderror">{{ $data->title }}</textarea>
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $data->category == 'success' ? 'checked' : '' }} type="radio" name="category" id="category-success" value="success">
                    <label class="form-check-label" for="category-success">Success</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $data->category == 'danger' ? 'checked' : '' }} type="radio" name="category" id="category-danger" value="danger">
                    <label class="form-check-label" for="category-danger">Danger</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $data->category == 'warning' ? 'checked' : '' }} type="radio" name="category" id="category-warning" value="warning">
                    <label class="form-check-label" for="category-warning">Warning</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $data->category == 'info' ? 'checked' : '' }} type="radio" name="category" id="category-info" value="info">
                    <label class="form-check-label" for="category-info">Info</label>
                </div>
            </div>
        </div>
    </div>  
</x-modal-action>
