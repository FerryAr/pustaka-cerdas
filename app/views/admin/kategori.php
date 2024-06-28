<div class="page-header">
    <h3>Data Kategori</h3>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Kategori</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Slug</th>
                                <th>Aksi</th>
                            </tr>
                            <?php $no = 1; ?>
                            <?php foreach ($kategori as $row) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nama_kategori'] ?></td>
                                    <td><?= $row['slug'] ?></td>
                                    <td>
                                        <button data-id="<?= $row['id'] ?>" class="delKat btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="addKat" type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tambahModal').on('hidden.bs.modal', function() {
            $('#nama_kategori').val('');
        });

        $('#addKat').on('click', function() {
            let nama_kategori = $('#nama_kategori').val();

            $.ajax({
                url: '<?= $baseUrl . 'admin/kategori/add' ?>',
                type: 'POST',
                data: {
                    nama_kategori: nama_kategori
                },
                success: function(res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Kategori berhasil ditambahkan'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Kategori gagal ditambahkan'
                    });
                }
            });
        });

        $('.delKat').on('click', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Kategori akan dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= $baseUrl . 'admin/kategori/delete' ?>',
                        type: 'POST',
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Kategori berhasil dihapus'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(err) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Kategori gagal dihapus'
                            });
                        }
                    });
                }
            });


        });
    });
</script>