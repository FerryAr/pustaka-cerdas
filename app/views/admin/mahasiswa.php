<div class="page-header">
    <h3>Data Mahasiswa</h3>
</div>

<div class="page-content">
    <div class="card">
        <div class="card-header">
            <div class="float-end">
                <button data-bs-toggle="modal" data-bs-target="#tambahModal" class="btn btn-primary">Tambah Mahasiswa</button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($mahasiswa as $mhs) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $mhs['nim'] ?></td>
                            <td><?= $mhs['nama'] ?></td>
                            <td><?= $mhs['prodi'] ?></td>
                            <td>
                                <button id="editMhs" data-bs-toggle="modal" data-bs-target="#updateModal" class="btn btn-sm btn-primary" data-nim="<?= $mhs['nim'] ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="delMhs btn btn-sm btn-danger" data-nim="<?= $mhs['nim'] ?>">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                </div>
                <div class="mb-3">
                    <label for="prodi" class="form-label">Prodi</label>
                    <input type="text" class="form-control" id="prodi" name="prodi">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="addMhs" type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control" id="nim-update" name="nim">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama-update" name="nama">
                </div>
                <div class="mb-3">
                    <label for="prodi" class="form-label">Prodi</label>
                    <input type="text" class="form-control" id="prodi-update" name="prodi">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="updateMhs" type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#addMhs').click(function() {
            let nim = $('#nim').val();
            let nama = $('#nama').val();
            let prodi = $('#prodi').val();

            if (nim == '' || nama == '' || prodi == '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Data tidak boleh kosong'
                });
                return;
            }

            $.ajax({
                url: '<?= $baseUrl . 'admin/mahasiswa/add' ?>',
                type: 'POST',
                data: {
                    nim: nim,
                    nama: nama,
                    prodi: prodi
                },
                success: function(res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data mahasiswa berhasil ditambahkan'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Data mahasiswa gagal ditambahkan'
                    });
                }
            });
        });

        $('#updateModal').on('show.bs.modal', function (e) {
            let nim = $(e.relatedTarget).data('nim');
            $.ajax({
                url: '<?= $baseUrl . 'admin/mahasiswa/getByNim' ?>',
                type: 'GET',
                data: {
                    nim: nim
                },
                success: function(res) {
                    let data = JSON.parse(res);
                    $('#nim-update').val(data.data.nim);
                    $('#nama-update').val(data.data.nama);
                    $('#prodi-update').val(data.data.prodi);
                },
                error: function(err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Data mahasiswa gagal ditampilkan'
                    });
                }
            });
        });

        $('#updateMhs').click(function() {
            let nim = $('#nim-update').val();
            let nama = $('#nama-update').val();
            let prodi = $('#prodi-update').val();

            if (nim == '' || nama == '' || prodi == '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Data tidak boleh kosong'
                });
                return;
            }

            $.ajax({
                url: '<?= $baseUrl . 'admin/mahasiswa/update' ?>',
                type: 'POST',
                data: {
                    nim: nim,
                    nama: nama,
                    prodi: prodi
                },
                success: function(res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data mahasiswa berhasil diubah'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Data mahasiswa gagal diubah'
                    });
                }
            });
        });

        $('.delMhs').on('click', function (e) {
            let nim = $(this).data('nim');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data mahasiswa dengan NIM " + nim + " akan dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= $baseUrl . 'admin/mahasiswa/delete' ?>',
                        type: 'POST',
                        data: {
                            nim: nim
                        },
                        success: function(res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data mahasiswa berhasil dihapus'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(err) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Data mahasiswa gagal dihapus'
                            });
                        }
                    });
                }
            });
        });
    });
</script>