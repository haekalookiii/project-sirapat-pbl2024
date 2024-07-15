<!-- Modal Template -->
<div class="modal fade" id="presenceModal" tabindex="-1" aria-labelledby="presenceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post" id="presenceForm">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="presenceModalLabel">Edit Presensi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Status Kehadiran:</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="attendance_id" id="attendance_id_1" value="1" class="selectgroup-input"
                                    checked="">
                                    <span class="selectgroup-button">ALPA</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="attendance_id" id="attendance_id_2" value="2" class="selectgroup-input">
                                    <span class="selectgroup-button">HADIR</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="attendance_id" id="attendance_id_3" value="3" class="selectgroup-input">
                                    <span class="selectgroup-button">IZIN</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="attendance_id" id="attendance_id_4" value="4" class="selectgroup-input">
                                    <span class="selectgroup-button">SAKIT</span>
                                </label>
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


