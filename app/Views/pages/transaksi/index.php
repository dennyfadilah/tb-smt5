<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="col-sm-12">
    <div class="card">
        <div class="card-header py-2">
            <div class="row justify-content-between">
                <div class="col-sm-6 d-flex align-items-center">
                    <h2 class="my-0">Content Page</h2>
                </div>

                <div class="col-md-6 text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addContent">
                        Add Content
                    </button>
                    <?= $this->include('pages/content/add') ?>
                </div>
            </div>
        </div>

        <!-- table menampilkan data -->
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Title</th>
                        <th>Submitted Date</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th class="col-2">Action</th>
                    </tr>

                    <tbody>
                        <tr>
                            <td colspan="7" class="text-center">No Data</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>