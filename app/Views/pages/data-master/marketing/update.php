<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="col-sm-12">
    <div class="card">
        <div class="card-header py-2">
            <div class="row justify-content-between">
                <div class="col-sm-6 d-flex align-items-center">
                    <h2 class="my-0">Update Marketing</h2>
                </div>

            </div>
        </div>

        <!-- table input data -->
        <div class="card-body">
            <form action="<?= base_url('data-master/marketing/update/' . $user['id']) ?>" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="nama">Name</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $user['nama'] ?>"
                                required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                value="<?= $user['password'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="<?= $user['email'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="no_telp">No. Handphone</label>
                            <input type="text" name="no_telp" id="no_telp" class="form-control"
                                value="<?= $user['no_telp'] ?>" required>
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