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
                        <a class="nav-link" href="<?= $baseUrl ?>auth/login">Login</a>
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
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8">
                    <!-- Horizontal card -->
                    <?php
                    foreach ($buku as $b) :
                    ?>
                        <div class="card border-0 elevation-1" style="margin-bottom: 1.5rem;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <img src="<?= $baseUrl ?>assets/img/buku/<?= $b['foto_sampul'] ?>" alt="<?= $b['judul'] ?>" class="img-fluid rounded">
                                    </div>
                                    <div class="col-8">
                                        <h5>
                                            <a class="card-link text-dark" style="text-decoration: none;">
                                                <?= $b['judul'] ?>
                                            </a>
                                        </h5>
                                        <div class="d-flex flex-wrap py-2">
                                            <button class="btn btn-outline-secondary btn-rounded"><?= $b['pengarang'] ?></button>
                                        </div>
                                        <p></p>
                                        <dl class="row small">
                                            <dt class="col-sm-3">Edisi</dt>
                                            <dd class="col-sm-9"><?= $b['edisi'] ?></dd>
                                            <dt class="col-sm-3">Tahun Terbit</dt>
                                            <dd class="col-sm-9"><?= $b['tahun_terbit'] ?></dd>
                                            <dt class="col-sm-3">ISBN</dt>
                                            <dd class="col-sm-9"><?= $b['isbn'] ?></dd>
                                            <dt class="col-sm-3">No. Panggil</dt>
                                            <dd class="col-sm-9"><?= $b['no_panggil'] ?></dd>
                                        </dl>
                                    </div>
                                    <div class="col-2">
                                        <div class="card text-center overflow-hidden cursor-pointer">
                                            <div class="card-body pt-3 pb-2 px-1">
                                                <div class="d-flex flex-column">
                                                    <span style="font-size:7pt;color:#aaa">Ketersediaan</span>
                                                    <span style="font-size:28pt; font-weight:200"><?= $b['ketersediaan'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-4">
                    <h6>Saran</h6>
                    <div class="d-flex flex-column mb-4">
                        <?php
                        foreach ($random as $r) :
                        ?>
                        <div class="card border-0 elevation-1 mb-2" style="min-height:80px; margin-top: 16px; padding-left: 60px">
                            <div class="card-body">
                                <div class="container-img elevation-2">
                                    <img src="<?= $baseUrl . 'assets/img/buku/' . $r['foto_sampul'] ?>" alt="img" class="img-fluid">
                                </div>
                                <div style="font-size: 12px; font-weight:600;margin-bottom:0">
                                    <a href="" class="text-decoration-none" style="color: #606f7b">
                                        <?= $r['judul'] ?>
                                    </a>
                                </div>
                                <div style="font-size: 12px; margin-bottom:0">
                                    <i><?= $r['pengarang'] ?></i>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
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
</body>

</html>