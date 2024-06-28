<!DOCTYPE html>
<html lang="en">
<?php
include_once dirname(__DIR__, 2) . "/config/config.php";

$config = new Config();

$baseUrl = $config->root;

function wordLimiter($string, $limit = 20)
{
    $words = explode(' ', $string);
    if (count($words) > $limit) {
        return implode(' ', array_slice($words, 0, $limit)) . '...';
    }

    return $string;
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PustakaCerdas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> <!-- Custom styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            /* Warna dasar */
        }

        .navbar {
            background-color: #2d499d;
            /* Warna navbar */
        }

        .navbar-brand {
            color: #fff;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #fff;
        }

        .header {
            position: relative;
        }

        .header img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .header-content {
            position: relative;
            z-index: 1;
            text-align: center;
            color: #fff;
            padding: 100px 0;
        }

        .header-content h1 {
            font-size: 4rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .header-content p {
            font-size: 1.5rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .katalog {
            background-color: #cfd8dc;
            /* Warna katalog */
            padding: 50px 0;
            text-decoration: none;
        }

        .petugas {
            background-color: #2d499d;
            /* Warna petugas */
            color: #fff;
            padding: 50px 0;
            text-align: center;
        }

        .footer {
            background-color: #f0f2f5;
            /* Warna footer */
            padding: 20px 0;
            text-align: center;
        }

        .elevation-1 {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
        }

        .elevation-1:hover {
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        }

        .elevation-2 {
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        }

        .container-img {
            width: 60px;
            position: absolute;
            top: -10px;
            left: 10px;
            overflow: hidden;
            border-radius: 4px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="<?= $baseUrl ?>">PustakaCerdas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>home/katalog">Katalog Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>auth/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="header" style="position: relative;">
        <img src="<?= $baseUrl ?>/assets/img/header-bg.jpg" alt="Header Background" style="width: 100%; height: 150px; object-fit: cover;">
        <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);"></div>
        <!-- Search form -->
        <div class="container" style="position: absolute; top: 95%; left: 50%; transform: translate(-50%, -50%); z-index: 1; color: #fff; text-align: center;">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <form action="#" method="get">
                        <input type="text" class="w-100" style="border:none;outline:none;background:transparent;font-size:16pt" placeholder="Masukkan kata kunci untuk mencari koleksi">
                    </form>
                </div>
            </div>

        </div>
    </header>

    <section class="katalog">
        <div class="container">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title">Perpanjangan Mandiri</h2>
                    <p class="card-text">Perpanjangan Mandiri adalah layanan yang memungkinkan Anda memperpanjang masa pinjam buku secara mandiri tanpa harus ke perpustakaan.</p>

                    <div class="container">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <?php $no = 1; ?>
                            <?php foreach ($listBuku as $row) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['judul'] ?></td>
                                    <td><?= $row['tanggal_pinjam'] ?></td>
                                    <td><?= $row['tanggal_kembali'] ?></td>
                                    <td>
                                        <?php
                                        $tanggalKembali = strtotime($row['tanggal_kembali']);
                                        $sekarang = strtotime(date('Y-m-d'));

                                        $diff = $tanggalKembali - $sekarang;

                                        $hari = floor($diff / (60 * 60 * 24));
                                        if ($sekarang < $tanggalKembali) {
                                            if ($hari < 3) { ?>
                                                <button data-idPeminjam="<?= $row['id_peminjam'] ?>" data-idBuku="<?= $row['id_buku'] ?>" class="perpanjang btn btn-sm btn-primary">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; <?= date('Y') ?> PustakaCerdas</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.perpanjang').on('click', function(e) {
                e.preventDefault();
                const idPeminjam = $(this).data('idpeminjam');
                const idBuku = $(this).data('idbuku');

                Swal.fire({
                    title: 'Perpanjang Buku',
                    text: 'Apakah Anda yakin ingin memperpanjang buku ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const formData = new FormData();
                        formData.append('id_peminjam', idPeminjam);
                        formData.append('id_buku', idBuku);

                        $.ajax({
                            url: '<?= $baseUrl ?>home/perpanjangan',
                            method: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                let data = JSON.parse(response);
                                Swal.fire({
                                    title: 'Perpanjangan Buku',
                                    text: data.message,
                                    icon: 'success'
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(err) {
                                Swal.fire({
                                    title: 'Perpanjangan Buku',
                                    text: 'Terjadi kesalahan',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>