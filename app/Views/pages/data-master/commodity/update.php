<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="col-sm-12">
    <div class="card">
        <div class="card-header py-2">
            <div class="row justify-content-between">
                <div class="col-sm-6 d-flex align-items-center">
                    <h2 class="my-0">Update Commodity</h2>
                </div>

            </div>
        </div>

        <!-- table input data -->
        <div class="card-body">
            <form action="<?= base_url('data-master/commodity/update/' . $comodity['id']) ?>" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="nama">Name</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $comodity['nama'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="harga">Price</label>
                            <input type="number" name="harga" id="harga" class="form-control" value="<?= $comodity['harga'] ?>" required>
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