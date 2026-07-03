<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bagong Jaya Motor — Showroom sepeda motor terpercaya. Temukan motor impian Anda dengan harga terbaik dan layanan test drive gratis.">
    <title><?= $title ?? 'Bagong Jaya Motor' ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/showroom.css') ?>">
</head>
<body>

    <header class="site-header">
        <a href="<?= base_url('/') ?>" class="brand">Bagong Jaya Motor</a>
        <nav class="main-nav" aria-label="Navigasi utama">
            <a href="#landing" data-page-link="landing" id="nav-landing">Beranda</a>
            <a href="#catalog" data-page-link="catalog" id="nav-catalog">Katalog Motor</a>
            <a href="<?= base_url('auth/login') ?>" id="nav-login">Masuk</a>
            <a href="<?= base_url('auth/register') ?>" id="nav-register">Daftar</a>
        </nav>
    </header>

    <main id="main-content">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="site-footer">
        <span>© <?= date('Y') ?> Bagong Jaya Motor. Hak cipta dilindungi.</span>
        <span>Jl. Raya Showroom No. 1, Kota Motor, Indonesia</span>
    </footer>

    <!-- Inject API Base URL dari .env ke JavaScript -->
    <script>
        // API_URL_BROWSER = URL yang bisa diakses browser dari luar Docker (localhost:8000)
        // API_URL (internal) = untuk PHP server-side saja (backend-api:8000)
        window.SHOWROOM_API_BASE_URL = "<?= rtrim(getenv('API_URL_BROWSER') ?: 'http://localhost:8000', '/') ?>";
    </script>
    <script src="<?= base_url('assets/js/showroom.js') ?>"></script>
</body>
</html>
