@props(['action','data'])

<div class="modal-dialog">
    <form action="{{ $action }}" method="post">
    @csrf
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title"></h5> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @can('admin')
                <button type="submit" class="btn btn-primary">Simpan</button>
                @endcan
            </div>
        </div>
    </form>
</div>