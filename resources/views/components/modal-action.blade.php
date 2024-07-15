@props(['action','data'])

<div class="modal-dialog">
    <form id="form-action" action="{{ $action }}" method="post">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Schedule</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                @can('admin')
                <button type="submit" class="btn btn-primary">Simpan</button>
                @endcan
            </div>
        </div>
    </form>
</div>
