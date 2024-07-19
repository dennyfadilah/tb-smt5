<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="col-sm-12">
    <div class="card">
        <div class="card-header py-2">
            <div class="row justify-content-between">
                <div class="col-sm-6 d-flex align-items-center">
                    <h2 class="my-0">Location Page</h2>
                </div>

                <div class="col-md-6 text-end">
                    <a href="<?= base_url('data-master/location/create') ?>" class="btn btn-primary">Create Location</a>
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
                        <th>ZIP Code</th>
                        <th class="col-2">Action</th>
                    </tr>

                    <tbody>
                        <?php $no = 1;
                        foreach ($lokasi as $key) : ?>
                            <tr class="text-center">
                                <td scope="row"><?= $no ?></td>
                                <td><?= $key['nama'] ?></td>
                                <td><?= $key['kode_zip'] ?></td>
                                <td>
                                    <div class="row g-1 justify-content-center">
                                        <div class="col-auto">
                                            <a href="<?= base_url('data-master/location/update/' . $key['id']) ?>" class="btn btn-sm btn-warning " data-bs-toggle="tooltip" data-bs-title="update"><i class="ti ti-edit"></i></a>
                                        </div>
                                        <div class="col-auto">
                                            <button class="btn btn-sm btn-danger btn-delete" type="button" data-url="<?= base_url('data-master/location/delete/' . $key['id']) ?>" data-bs-toggle="tooltip" data-bs-title="Delete">
                                                <i class="ti ti-trash"></i></button>
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