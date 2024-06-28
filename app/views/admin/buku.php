<div class="page-header">
    <h3>Data Buku</h3>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Buku</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Penerbit</th>
                                <th>Pengarang</th>
                                <th>Judul</th>
                                <th>Aksi</th>
                            </tr>
                            <?php $no = 1; ?>
                            <?php foreach ($buku as $row) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nama_kategori'] ?></td>
                                    <td><?= $row['penerbit'] ?></td>
                                    <td><?= $row['pengarang'] ?></td>
                                    <td><?= $row['judul'] ?></td>
                                    <td>
                                        <button data-id="<?= $row['id'] ?>" data-bs-toggle="modal" data-bs-target="#detailModal" id="detailBuk" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button data-id="<?= $row['id'] ?>" data-bs-toggle="modal" data-bs-target="#updateModal" class="editBuk btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button data-id="<?= $row['id'] ?>" class="delBuk btn btn-sm btn-danger">
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
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori" name="kategori">
                        <option selected disabled>Pilih Kategori</option>
                        <?php foreach ($kategori as $row) : ?>
                            <option value="<?= $row['id'] ?>"><?= $row['nama_kategori'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" id="penerbit" name="penerbit">
                </div>
                <div class="mb-3">
                    <label for="pengarang" class="form-label">Pengarang</label>
                    <input type="text" class="form-control" id="pengarang" name="pengarang">
                </div>
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul">
                </div>
                <div class="mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control" id="isbn" name="isbn">
                </div>
                <div class="mb-3">
                    <label for="edisi" class="form-label">Edisi</label>
                    <input type="text" class="form-control" id="edisi" name="edisi">
                </div>
                <div class="mb-3">
                    <label for="tahun_terbit" class="form-label">
                        Tahun Terbit
                    </label>
                    <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit">
                </div>
                <div class="mb-3">
                    <label for="jumlah_buku" class="form-label">
                        Jumlah Buku
                    </label>
                    <input type="text" class="form-control" id="jumlah_buku" name="jumlah_buku">
                </div>
                <div class="mb-3">
                    <label for="klasifikasi" class="form-label">
                        Klasifikasi
                    </label>
                    <input type="text" class="form-control" id="klasifikasi" name="klasifikasi">
                </div>
                <div class="mb-3">
                    <label for="no_panggil" class="form-label">
                        No Panggil
                    </label>
                    <input type="text" class="form-control" id="no_panggil" name="no_panggil">
                </div>
                <div class="mb-3">
                    <label for="foto_sampul" class="form-label">
                        Foto Sampul
                    </label>
                    <input type="file" class="form-control" id="foto_sampul" name="foto_sampul">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="addBuk" type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td>Judul</td>
                        <td>:</td>
                        <td id="judul-detail"></td>
                    </tr>
                    <tr>
                        <td>Penerbit</td>
                        <td>:</td>
                        <td id="penerbit-detail"></td>
                    </tr>
                    <tr>
                        <td>Pengarang</td>
                        <td>:</td>
                        <td id="pengarang-detail"></td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>:</td>
                        <td id="deskripsi-detail"></td>
                    </tr>
                    <tr>
                        <td>ISBN</td>
                        <td>:</td>
                        <td id="isbn-detail"></td>
                    </tr>
                    <tr>
                        <td>Edisi</td>
                        <td>:</td>
                        <td id="edisi-detail"></td>
                    </tr>
                    <tr>
                        <td>Tahun Terbit</td>
                        <td>:</td>
                        <td id="tahun_terbit-detail"></td>
                    </tr>
                    <tr>
                        <td>Jumlah Buku</td>
                        <td>:</td>
                        <td id="jumlah_buku-detail"></td>
                    </tr>
                    <tr>
                        <td>Klasifikasi</td>
                        <td>:</td>
                        <td id="klasifikasi-detail"></td>
                    </tr>
                    <tr>
                        <td>No Panggil</td>
                        <td>:</td>
                        <td id="no_panggil-detail"></td>
                    </tr>
                    <tr>
                        <td>Foto Sampul</td>
                        <td>:</td>
                        <td id="foto_sampul-detail"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id-update" name="id">
                <div class="mb-3">
                    <label for="kategori-update" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori-update" name="kategori">
                        <option selected disabled>Pilih Kategori</option>
                        <?php foreach ($kategori as $row) : ?>
                            <option value="<?= $row['id'] ?>"><?= $row['nama_kategori'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="penerbit-update" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" id="penerbit-update" name="penerbit">
                </div>
                <div class="mb-3">
                    <label for="pengarang-update" class="form-label">Pengarang</label>
                    <input type="text" class="form-control" id="pengarang-update" name="pengarang">
                </div>
                <div class="mb-3">
                    <label for="judul-update" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul-update" name="judul">
                </div>
                <div class="mb-3">
                    <label for="deskripsi-update">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi-update" name="deskripsi" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="isbn-update" class="form-label">ISBN</label>
                    <input type="text" class="form-control" id="isbn-update" name="isbn">
                </div>
                <div class="mb-3">
                    <label for="edisi-update" class="form-label">Edisi</label>
                    <input type="text" class="form-control" id="edisi-update" name="edisi">
                </div>
                <div class="mb-3">
                    <label for="tahun_terbit-update" class="form-label">
                        Tahun Terbit
                    </label>
                    <input type="text" class="form-control" id="tahun_terbit-update" name="tahun_terbit">
                </div>
                <div class="mb-3">
                    <label for="jumlah_buku-update" class="form-label">
                        Jumlah Buku
                    </label>
                    <input type="text" class="form-control" id="jumlah_buku-update" name="jumlah_buku">
                </div>
                <div class="mb-3">
                    <label for="klasifikasi-update" class="form-label">
                        Klasifikasi
                    </label>
                    <input type="text" class="form-control" id="klasifikasi-update" name="klasifikasi">
                </div>
                <div class="mb-3">
                    <label for="no_panggil-update" class="form-label">
                        No Panggil
                    </label>
                    <input type="text" class="form-control" id="no_panggil-update" name="no_panggil">
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto Sampul saat Ini</label>
                    <div id="foto_sampul-preview">
                </div>
                <div class="mb-3">
                    <label for="foto_sampul-update" class="form-label">
                        Foto Sampul
                    </label>
                    <input type="file" class="form-control" id="foto_sampul-update" name="foto_sampul">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="updateBuk" type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#addBuk').on('click', function() {
            let kategori = $('#kategori').val();
            let penerbit = $('#penerbit').val();
            let pengarang = $('#pengarang').val();
            let judul = $('#judul').val();
            let deskripsi = $('#deskripsi').val();
            let isbn = $('#isbn').val();
            let edisi = $('#edisi').val();
            let tahun_terbit = $('#tahun_terbit').val();
            let jumlah_buku = $('#jumlah_buku').val();
            let klasifikasi = $('#klasifikasi').val();
            let no_panggil = $('#no_panggil').val();

            let foto_sampul = $('#foto_sampul').prop('files')[0];

            if (kategori === '' || penerbit === '' || judul === '' || deskripsi === '' || isbn === '' || edisi === '' || tahun_terbit === '' || jumlah_buku === '' || klasifikasi === '' || no_panggil === '' || foto_sampul === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Semua data harus diisi'
                });
                return;
            }

            let formData = new FormData();
            formData.append('kategori', kategori);
            formData.append('penerbit', penerbit);
            formData.append('pengarang', pengarang);
            formData.append('judul', judul);
            formData.append('deskripsi', deskripsi);
            formData.append('isbn', isbn);
            formData.append('edisi', edisi);
            formData.append('tahun_terbit', tahun_terbit);
            formData.append('jumlah_buku', jumlah_buku);
            formData.append('klasifikasi', klasifikasi);
            formData.append('no_panggil', no_panggil);
            formData.append('foto_sampul', foto_sampul);

            $.ajax({
                url: '<?= $baseUrl . 'admin/buku/add' ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Buku berhasil ditambahkan'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Buku gagal ditambahkan'
                    });
                }
            });


        });

        $('#detailModal').on('show.bs.modal', function(e) {
            let id = $(e.relatedTarget).data('id');

            $.ajax({
                url: '<?= $baseUrl . 'admin/buku/getById' ?>',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(response) {
                    let res = JSON.parse(response);
                    let data = res.data;
                    $('#judul-detail').text(data.judul);
                    $('#penerbit-detail').text(data.penerbit);
                    $('#deskripsi-detail').text(data.deskripsi);
                    $('#isbn-detail').text(data.isbn);
                    $('#edisi-detail').text(data.edisi);
                    $('#tahun_terbit-detail').text(data.tahun_terbit);
                    $('#jumlah_buku-detail').text(data.jumlah_buku);
                    $('#klasifikasi-detail').text(data.klasifikasi);
                    $('#no_panggil-detail').text(data.no_panggil);
                    $('#foto_sampul-detail').html(`<img src="<?= $baseUrl . 'assets/img/buku/' ?>${data.foto_sampul}" alt="Foto Sampul" class="img-fluid" style="width: 100px; height: 100px; object-fit:cover">`);
                },
                error: function(err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Gagal mengambil data buku'
                    });
                }
            });
        });

        $('#updateModal').on('show.bs.modal', function (e) {
            let id = $(e.relatedTarget).data('id');

            $.ajax({
                url: '<?= $baseUrl . 'admin/buku/getById' ?>',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(response) {
                    let res = JSON.parse(response);
                    let data = res.data;
                    $('#id-update').val(data.id);
                    $('#kategori-update').val(data.id_kategori);
                    $('#penerbit-update').val(data.penerbit);
                    $('#pengarang-update').val(data.pengarang);
                    $('#judul-update').val(data.judul);
                    $('#deskripsi-update').val(data.deskripsi);
                    $('#isbn-update').val(data.isbn);
                    $('#edisi-update').val(data.edisi);
                    $('#tahun_terbit-update').val(data.tahun_terbit);
                    $('#jumlah_buku-update').val(data.jumlah_buku);
                    $('#klasifikasi-update').val(data.klasifikasi);
                    $('#no_panggil-update').val(data.no_panggil);
                    $('#foto_sampul-preview').html(`<img src="<?= $baseUrl . 'assets/img/buku/' ?>${data.foto_sampul}" alt="Foto Sampul" class="img-fluid" style="width: 100px; height: 100px; object-fit:cover">`);
                },
                error: function(err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Gagal mengambil data buku'
                    });
                }
            });
        });

        $('#updateBuk').on('click', function () {
            let id = $('#id-update').val();
            let kategori = $('#kategori-update').val();
            let penerbit = $('#penerbit-update').val();
            let pengarang = $('#pengarang-update').val();
            let judul = $('#judul-update').val();
            let deskripsi = $('#deskripsi-update').val();
            let isbn = $('#isbn-update').val();
            let edisi = $('#edisi-update').val();
            let tahun_terbit = $('#tahun_terbit-update').val();
            let jumlah_buku = $('#jumlah_buku-update').val();
            let klasifikasi = $('#klasifikasi-update').val();
            let no_panggil = $('#no_panggil-update').val();

            let foto_sampul = $('#foto_sampul-update').prop('files')[0];

            if (kategori === '' || penerbit === '' || judul === '' || deskripsi === '' || isbn === '' || edisi === '' || tahun_terbit === '' || jumlah_buku === '' || klasifikasi === '' || no_panggil === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Semua data harus diisi'
                });
                return;
            }

            let formData = new FormData();
            formData.append('id', id);
            formData.append('kategori', kategori);
            formData.append('penerbit', penerbit);
            formData.append('pengarang', pengarang);
            formData.append('judul', judul);
            formData.append('deskripsi', deskripsi);
            formData.append('isbn', isbn);
            formData.append('edisi', edisi);
            formData.append('tahun_terbit', tahun_terbit);
            formData.append('jumlah_buku', jumlah_buku);
            formData.append('klasifikasi', klasifikasi);
            formData.append('no_panggil', no_panggil);

            if(foto_sampul !== undefined) {
                formData.append('foto_sampul', foto_sampul);
            }

            $.ajax({
                url: '<?= $baseUrl . 'admin/buku/update' ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Buku berhasil diupdate'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Buku gagal diupdate'
                    });
                }
            });
        });

        $('.delBuk').on('click', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Buku akan dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= $baseUrl . 'admin/buku/delete' ?>',
                        type: 'POST',
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Buku berhasil dihapus'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(err) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Buku gagal dihapus'
                            });
                        }
                    });
                }
            });


        });
    });
</script>