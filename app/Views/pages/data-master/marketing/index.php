<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="col-sm-12">
    <div class="card">
        <div class="card-header py-2">
            <div class="row justify-content-between">
                <div class="col-sm-6 d-flex align-items-center">
                    <h2 class="my-0">Marketing Page</h2>
                </div>
                <div class="col-md-6 text-end">
                    <a href="<?= base_url('data-master/marketing/create') ?>" class="btn btn-primary">Create
                        Marketing</a>
                </div>
            </div>
        </div>

        <!-- table menampilkan data -->
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th class="col-2">Action</th>
                    </tr>

                    <tbody>
                        <?php $no = 1;
                        foreach ($user as $key) : ?>
                            <tr class="text-center">
                                <td scope="row"><?= $no ?></td>
                                <td><?= $key['nama'] ?></td>
                                <td><?= $key['email'] ?></td>
                                <td><?= $key['no_telp'] ?></td>
                                <td>
                                    <div class="row g-1 justify-content-center">
                                        <div class="col-auto">
                                            <a href="<?= base_url('data-master/marketing/update/' . $key['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                        </div>
                                        <div class="col-auto">
                                            <form method="post" action="<?= base_url('data-master/marketing/delete/' . $key['id']) ?>" class="d-inline">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php $no++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>