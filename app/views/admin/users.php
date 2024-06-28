<div class="page-header">
    <h3>Data Users</h3>
</div>

<div class="page-content">
    <div class="card">
        <div class="card-header">
            <div class="float-end">
                <button data-bs-toggle="modal" data-bs-target="#tambahModal" class="btn btn-primary">Tambah User</button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($users as $user) :
                        if ($user['username'] == 'admin') continue;
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $user['username'] ?></td>
                            <td>
                                <?php
                                switch ($user['role']) {
                                    case '1':
                                        echo 'Admin';
                                        break;
                                    case '2':
                                        echo 'Petugas';
                                        break;
                                    case '3':
                                        echo 'Mahasiswa';
                                        break;
                                    default:
                                        echo 'Unknown';
                                        break;
                                }
                                ?>
                            </td>
                            <td>
                                <button id="editUser" data-bs-toggle="modal" data-bs-target="#updateModal" class="btn btn-sm btn-primary" data-username="<?= $user['username'] ?>" data-id="<?= $user['id'] ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="delUser btn btn-sm btn-danger" data-username="<?= $user['username'] ?>">
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
                <h5 class="modal-title">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role">
                        <option selected disabled>Pilih Role</option>
                        <option value="1">Admin</option>
                        <option value="2">Petugas</option>
                        <option value="3">Mahasiswa</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="addUser" type="button" class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id-update" name="username">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username-update" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password-update" name="password">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role-update" name="role">
                        <option selected disabled>Pilih Role</option>
                        <option value="1">Admin</option>
                        <option value="2">Petugas</option>
                        <option value="3">Mahasiswa</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="updateUser" type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#addUser').click(function() {
            let username = $('#username').val();
            let password = $('#password').val();
            let role = $('#role').val();

            if (username == '' || password == '' || role == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Username dan password harus diisi'
                });
                return;
            }

            $.ajax({
                url: '<?= $baseUrl . 'admin/users/add' ?>',
                type: 'POST',
                data: {
                    username: username,
                    password: password,
                    role: role
                },
                success: function(res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'User berhasil ditambahkan'
                    }).then(() => {
                        location.reload();
                    });
                }
            });
        });

        $('#updateModal').on('show.bs.modal', function(e) {
            let username = $(e.relatedTarget).data('username');

            $.ajax({
                url: '<?= $baseUrl . 'admin/users/getByUsername' ?>',
                type: 'GET',
                data: {
                    username: username
                },
                success: function(res) {
                    let re = JSON.parse(res);
                    let data = re.data;

                    $('#id-update').val(data.id);
                    $('#username-update').val(data.username);
                    $('#role-update').val(data.role);
                }
            });
        });

        $('#updateUser').click(function() {
            let id = $('#id-update').val();
            let username = $('#username-update').val();
            let password = $('#password-update').val();
            let role = $('#role-update').val();

            if (username == '' || password == '' || role == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Username dan password harus diisi'
                });
                return;
            }

            $.ajax({
                url: '<?= $baseUrl . 'admin/users/update' ?>',
                type: 'POST',
                data: {
                    id: id,
                    username: username,
                    password: password,
                    role: role
                },
                success: function(res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'User berhasil diupdate'
                    }).then(() => {
                        location.reload();
                    });
                }
            });
        });

        $('.delUser').click(function() {
            let username = $(this).data('username');

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "User akan dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= $baseUrl . 'admin/users/delete' ?>',
                        type: 'POST',
                        data: {
                            username: username
                        },
                        success: function(res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: 'User berhasil dihapus'
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