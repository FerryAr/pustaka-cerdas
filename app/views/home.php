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
            text-align: center;
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

        .card-img-top {
            max-height: 250px;
            min-height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">PustakaCerdas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#katalog">Katalog Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#petugas">Petugas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>auth/login">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="header" style="position: relative;">
        <img src="<?= $baseUrl ?>/assets/img/header-bg.jpg" alt="Header Background" style="width: 100%; height: 350px; object-fit: cover;">
        <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);"></div>
        <div class="container" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1; color: #fff; text-align: center;">
            <h1 style="font-size: 4rem; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Selamat datang di PustakaCerdas</h1>
            <p style="font-size: 1.5rem; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">Jelajahi koleksi buku terbaru kami dan temukan pengetahuan baru.</p>
        </div>
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

    <section class="katalog" id="katalog">
        <div class="container">
            <h2>Katalog Buku</h2>
            <p>Temukan buku-buku terbaru dan terbaik di perpustakaan kami.</p>
            <div class="row">
                <?php
                foreach ($buku as $b) {
                ?>
                    <div class="col-md-3">
                        <div class="card mb-4">
                            <img src="<?= $baseUrl ?>/assets/img/buku/<?= $b['foto_sampul'] ?>" class="card-img-top h-75" alt="Book 1">
                            <div class="card-body">
                                <h5 class="card-title"><?= $b['judul'] ?></h5>
                                <p class="card-text"><?= wordLimiter($b['deskripsi']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="d-grid gap-2">
                <a href="<?= $baseUrl ?>home/katalog" class="btn btn-primary btn-lg">Lihat Semua</a>
            </div>
        </div>
    </section>

    <section class="petugas" id="petugas">
        <div class="container">
            <h2>Petugas Perpustakaan</h2>
            <p>Tim profesional kami siap membantu Anda dalam menemukan apa yang Anda cari.</p>
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <img src="<?= $baseUrl ?>/assets/img/petugas/petugas1.png" class="card-img" alt="Petugas 1">
                        <div class="card-body">
                            <h5 class="card-title">Yunus Dwi Wibisono</h5>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <img src="<?= $baseUrl ?>/assets/img/petugas/petugas2.png" class="card-img" alt="Petugas 2">
                        <div class="card-body">
                            <h5 class="card-title">Azriel Akbar Ferry A</h5>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <img src="<?= $baseUrl ?>/assets/img/petugas/petugas3.png" class="card-img" alt="Petugas 3">
                        <div class="card-body">
                            <h5 class="card-title">Nurul Akbar Ismail</h5>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <img src="<?= $baseUrl ?>/assets/img/petugas/petugas4.jpeg" class="card-img" alt="Petugas 4">
                        <div class="card-body">
                            <h5 class="card-title">Pandu Satrio Witjaksono</h5>
                        </div>
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
            Swal.fire({
                title: 'Selamat datang di PustakaCerdas',
                html: `Aplikasi ini dibuat untuk memenuhi UAS mata kuliah Pemrograman Lanjut.<br>
                Aplikasi ini dibuat oleh:<br><br>
                Kelompok 9<br>
                <ol>
                    <li>Yunus Dwi Wibisono (202351094)</li>
                    <li>Azriel Akbar Ferry A (202351099)</li>
                    <li>Nurul Akbar Ismail (202351103)</li>
                    <li>Pandu Satrio Witjaksono (202351083)</li>
                </ol>
                `,
                icon: 'info',
                confirmButtonText: 'OK'
            });
        });
    </script>
</body>

</html>