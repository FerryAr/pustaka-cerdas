<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="#"><span class="align-middle">PustakaCerdas</span></a>
                </div>
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item <?= $active == "dashboard"
                    ? "active"
                    : "" ?>">
                    <a class="sidebar-link" href="<?= $baseUrl . 'admin/dashboard'  ?>">
                        <i class="align-middle" data-feather="sliders"></i>
                        <span class="align-middle">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item <?= $active == "kategori"
                    ? "active"
                    : "" ?>">
                    <a href="<?= $baseUrl . 'admin/kategori'  ?>" class="sidebar-link">
                        <i class="align-middle" data-feather="book"></i>
                        <span class="align-middle">Data Kategori</span>
                    </a>
                </li>
                <li class="sidebar-item <?= $active == "buku"
                    ? "active"
                    : "" ?>">
                    <a href="<?= $baseUrl . 'admin/buku'  ?>" class="sidebar-link">
                        <i class="align-middle" data-feather="book-open"></i>
                        <span class="align-middle">Data Buku</span>
                    </a>
                </li>
                <li class="sidebar-item <?= $active == "mhs"
                    ? "active"
                    : "" ?>">
                    <a href="<?= $baseUrl . 'admin/mahasiswa'  ?>" class="sidebar-link">
                        <i class="align-middle" data-feather="users"></i>
                        <span class="align-middle">Data Mahasiswa</span>
                    </a>
                </li>
                <li class="sidebar-item <?= $active == "users"
                    ? "active"
                    : "" ?>">
                    <a class="sidebar-link" href="<?= $baseUrl . 'admin/users'  ?>">
                        <i class="align-middle" data-feather="users"></i>
                        <span class="align-middle">Data Users</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="position-absolute" style="font-size: larger; bottom:14px; left:30px; margin-top: auto">
            <a href="<?= $baseUrl . 'auth/logout'  ?>">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
        </div>
    </div>
</div>