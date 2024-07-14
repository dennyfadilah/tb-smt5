<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="col-sm-12">
    <div class="card">
        <div class="card-header py-2">
            <div class="row justify-content-between">
                <div class="col-sm-6 d-flex align-items-center">
                    <h2 class="my-0">Update Location</h2>
                </div>

            </div>
        </div>

        <!-- table input data -->
        <div class="card-body">
            <form action="<?= base_url('data-master/location/update/' . $lokasi['id']) ?>" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="nama">Name</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $lokasi['nama'] ?>"
                                required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="kode_zip">ZIP Code</label>
                            <input type="number" name="kode_zip" id="kode_zip" class="form-control"
                                value="<?= $lokasi['kode_zip'] ?>" required>
                        </div>
                    </div>
                </div><br>

                <div class="form-group text-center mb-3">
                    <button type="submit" class="btn btn-primary w-25">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>