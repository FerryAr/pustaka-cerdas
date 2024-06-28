<?php
include_once dirname(__DIR__, 3) . "/config/config.php";


$config = new Config();

$baseUrl = $config->root;
?>
<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p><?= date("Y") ?> &copy; PustakaCerdas</p>
        </div>
        <div class="float-end">
            <p>
                Crafted with
                <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                by <a href="https://github.com/FerryAr">Azrl | Psyco</a>
            </p>
        </div>
    </div>
</footer>
</div>
</div>

<script src="<?= $baseUrl ?>assets/static/js/components/dark.js"></script>
<script src="<?= $baseUrl ?>assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<script src="<?= $baseUrl ?>assets/compiled/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
</body>

</html>