<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="col-12">
    <div class="card mb-3">
        <div class="card-header py-2">
            <div class="row justify-content-between">
                <div class="col-md-6 d-flex align-items-center">
                    <h2 class="my-0">Transaction Page</h2>
                </div>
                <div class="col-md-6 text-end">
                    <div class="row ">
                        <div class="col-auto"><a href="<?= base_url('transaksi/create') ?>" class="btn btn-primary">Create
                                Transaction</a></div>
                        <div class="col-auto">
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Export
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
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
                        <th>Date Time Survey</th>
                        <th>Commodity Name</th>
                        <th>Location Name</th>
                        <th>Repeat Orders</th>
                        <th>Survey Results</th>
                        <th class="col-2">Action</th>
                    </tr>

                    <tbody>
                        <?php

                        foreach ($surveyor as $key => $value) :
                        ?>
                            <tr>
                                <td class="text-center"><?= $key + 1 ?></td>
                                <td><?= $value['marketing_nama'] ?></td>
                                <td><?= $value['waktu'] ?></td>
                                <td><?= $value['nama_komoditas'] ?></td>
                                <td><?= $value['nama_lokasi'] ?></td>
                                <td class="text-center"><?= $value['repeat_order'] == 0 ? 'Tidak' : 'Iya' ?></td>
                                <td><?= $value['hasil_survey'] ?></td>
                                <td>
                                    <div class="row g-1 justify-content-center">
                                        <div class="col-auto">
                                            <a href="<?= base_url('transaksi/update/' . $value['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                        </div>
                                        <div class="col-auto">
                                            <button class="btn btn-sm btn-danger btn-delete" type="button" data-url="<?= base_url('transaksi/delete/' . $value['id']) ?>">
                                                Delete</button>
                                        </div>
                                    </div>
                                </td>
                            <?php $key++;
                        endforeach ?>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(function() {
        $('.btn-delete').on('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).text('On Progress...');
                    $(this).prop('disabled', true);

                    $.ajax({
                        method: 'POST',
                        url: $(this).data('url'),
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            $(this).text('Delete');
                            $(this).prop('disabled', false);

                            if (response.error) {

                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: response.message,
                                });
                            } else {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: response.message,
                                }).then(function() {
                                    window.location.href = response.redirect;
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>