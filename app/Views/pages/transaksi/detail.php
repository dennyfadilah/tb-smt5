<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="col-12">
    <div class="card dashnum-card dashnum-card-small overflow-hidden">
        <span class="round bg-warning small"></span>
        <span class="round bg-warning big"></span>

        <div class="card-header py-3">
            <div class="d-flex align-items-center">
                <h2 class="mb-0">Detail Transaction Page</h2>
            </div>
        </div>

        <div class="card-body p-3">
            <div class="ms-2">
                <form>
                    <div class="form-group mb-3">
                        <label for="marketing_nama" class="form-label">Name</label>
                        <input type="text" class="form-control" id="marketing_nama" name="marketing_nama"
                            value="<?= $surveyor['marketing_nama'] ?>" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="waktu" class="form-label">Date Time Survey</label>
                        <input type="date" class="form-control" id="waktu" name="waktu"
                            value="<?= $surveyor['waktu'] ?>" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="komoditas_id" class="form-label">Commodity Name</label>
                        <input type="text" class="form-control" id="komoditas_id" name="komoditas_id"
                            value="<?= $komoditas['nama'] ?>" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="lokasi_id" class="form-label">Location Name</label>
                        <input type="text" class="form-control" id="lokasi_id" name="lokasi_id"
                            value="<?= $lokasi['nama'] ?>" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="repeat_order" class="form-label">Repeat Orders</label>
                        <input type="text" name="repeat_order" id="repear_order" class="form-control"
                            value="<?= $surveyor['repeat_order'] == 1 ? 'Iya' : 'Tidak' ?>" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="hasil_survey" class="form-label">Survey Results</label>
                        <textarea class="form-control" name="hasil_survey" id="hasil_survey" rows="3"
                            readonly><?= $surveyor['hasil_survey'] ?></textarea>
                    </div>

                    <div class="text-center">
                        <a type="button" href="<?= base_url('export/pdf/' . $surveyor['id']) ?>"
                            class="btn btn-success col-md-3 col-12" id="btnSubmit">Download</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>