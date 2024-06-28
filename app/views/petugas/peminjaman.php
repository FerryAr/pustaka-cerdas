<div class="page-header">
    <h3>Peminjaman Buku</h3>

    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-end">
                            <button data-bs-toggle="modal" data-bs-target="#tambahModal" class="btn btn-sm btn-primary">Tambah Peminjam</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($peminjam as $p) :
                                    $status = $p['status_kembali'];
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $p['nim'] ?></td>
                                        <td><?= $p['tanggal_pinjam'] ?></td>
                                        <td><?= $p['tanggal_kembali'] ?></td>
                                        <td>
                                            <?php
                                            if ($status == '1') {
                                                echo '<span class="badge bg-success">Dikembalikan</span>';
                                            } else {
                                                echo '<span class="badge bg-warning">Dipinjam</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <button data-bs-toggle="modal" data-bs-target="#detailModal" data-id="<?= $p['id'] ?>" class="btn btn-sm btn-primary">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <?php if ($status == '0') : ?>
                                                <button data-id="<?= $p['id'] ?>" class="kembali btn btn-sm btn-success">
                                                    <i class="bi bi-check"></i>
                                                </button>
                                            <?php endif; ?>
                                            <button data-id="<?= $p['id'] ?>" class="delPinjam btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Peminjam</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nama" class="form-label">Peminjam</label>
                    <select name="nama" id="peminjam" class="form-select">
                        <option selected disabled>Pilih Peminjam</option>
                        <?php
                        foreach ($mhs as $m) :
                        ?>
                            <option value="<?= $m['nim'] ?>"><?= $m['nama'] ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="buku" class="form-label">Buku 1</label>
                    <select name="buku[]" id="buku[]" class="form-select">
                        <option selected disabled>Pilih Buku</option>
                        <?php
                        foreach ($buku as $b) :
                        ?>
                            <option value="<?= $b['id'] ?>"><?= $b['judul'] ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="buku" class="form-label">Buku 2</label>
                    <select name="buku[]" id="buku[]" class="form-select">
                        <option selected disabled>Pilih Buku</option>
                        <?php
                        foreach ($buku as $b) :
                        ?>
                            <option value="<?= $b['id'] ?>"><?= $b['judul'] ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="buku" class="form-label">Buku 3</label>
                    <select name="buku[]" id="buku[]" class="form-select">
                        <option selected disabled>Pilih Buku</option>
                        <?php
                        foreach ($buku as $b) :
                        ?>
                            <option value="<?= $b['id'] ?>"><?= $b['judul'] ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="savePinjam" type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Peminjam</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td id="nama-detail"></td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td>:</td>
                        <td id="nim-detail"></td>
                    </tr>
                    <tr>
                        <td>Tanggal Pinjam</td>
                        <td>:</td>
                        <td id="tanggal_pinjam-detail"></td>
                    </tr>
                    <tr>
                        <td>Tanggal Kembali</td>
                        <td>:</td>
                        <td id="tanggal_kembali-detail"></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td id="status-detail"></td>
                    </tr>
                </table>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                        </tr>
                    </thead>
                    <tbody id="buku">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#savePinjam').on('click', function() {
            let nim = $('#peminjam').val();
            let bukus = $('select[name="buku[]"]').map(function() {
                return $(this).val();
            }).get();
            let tanggal_kembali = $('#tanggal_kembali').val();

            const formData = new FormData();
            formData.append('nim', nim);
            formData.append('bukus', JSON.stringify(bukus));
            formData.append('tanggal_kembali', tanggal_kembali);

            $.ajax({
                url: '<?= $baseUrl ?>petugas/peminjaman/add',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil disimpan'
                    }).then(() => {
                        location.reload();
                    });
                },error: function(err) {
                   const responseCode = err.status;
                     if(responseCode === 400) {
                          Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Buku sudah habis'
                          });
                     } else if(responseCode === 418) {
                          Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Mahasiswa sudah meminjam 3 buku'
                          });
                     } else {
                          Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Data gagal disimpan'
                          });
                     }
                }
            });
        });

        $('#detailModal').on('show.bs.modal', function(e) {
            let id = $(e.relatedTarget).data('id');
            $.ajax({
                url: '<?= $baseUrl ?>petugas/peminjaman/getById?id=' + id,
                type: 'GET',
                success: function(res) {
                    let re = JSON.parse(res);
                    let data = re.data.peminjam;
                    let buku = re.data.buku;
                    $('#nama-detail').text(data.nama);
                    $('#nim-detail').text(data.nim);
                    $('#tanggal_pinjam-detail').text(data.tanggal_pinjam);
                    $('#tanggal_kembali-detail').text(data.tanggal_kembali);
                    $('#status-detail').text(data.status == 1 ? 'Dikembalikan' : 'Dipinjam');

                    let html = '';
                    buku.forEach((b, i) => {
                        html += `<tr>
                            <td>${i + 1}</td>
                            <td>${b.judul}</td>
                        </tr>`;
                    });

                    $('#buku').html(html);
                }
            });
        });

        $('.kembali').on('click', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Buku akan dikembalikan',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, kembalikan'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= $baseUrl ?>petugas/peminjaman/changeStatus',
                        type: 'POST',
                        data: {
                            id: id,
                            status: 1
                        },
                        success: function(res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Buku berhasil dikembalikan'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    });
                }
            });
        });

        $('.delPinjam').on('click', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Data akan dihapus',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= $baseUrl ?>petugas/peminjaman/delete',
                        type: 'POST',
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data berhasil dihapus'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    });
                }
            });
        });
    });
</script>