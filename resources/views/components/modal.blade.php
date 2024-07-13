<!-- Modal Template -->
<div class="modal fade" id="presenceModal" tabindex="-1" aria-labelledby="presenceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post" id="presenceForm">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="presenceModalLabel">Edit Presence</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="attendance_id" id="attendance_id_1" value="1">
                                    <label class="form-check-label" for="attendance_id_1">ALPA</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="attendance_id" id="attendance_id_2" value="2">
                                    <label class="form-check-label" for="attendance_id_2">HADIR</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="attendance_id" id="attendance_id_3" value="3">
                                    <label class="form-check-label" for="attendance_id_3">IZIN</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="attendance_id" id="attendance_id_4" value="4">
                                    <label class="form-check-label" for="attendance_id_4">SAKIT</label>
                                </div>
                            </div>
                        </div>
                    </div>
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
</div>


