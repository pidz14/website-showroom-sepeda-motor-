<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ShowroomKu, katalog motor bekas pilihan dengan fitur katalog dan pengajuan test drive.">
    <title>ShowroomKu</title>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="preconnect" href="https://commons.wikimedia.org">
    <link rel="preconnect" href="https://upload.wikimedia.org">
    <link rel="stylesheet" href="/assets/css/showroom.css?v=20260528">
</head>
<body>
    <header class="site-header">
        <a class="brand" href="#landing" data-page-link="landing" aria-label="ShowroomKu beranda">ShowroomKu</a>
        <nav class="main-nav" aria-label="Navigasi utama">
            <a href="#landing" data-page-link="landing">Home</a>
            <a href="#katalog" data-page-link="katalog">Katalog</a>
            <a href="#detail" data-page-link="detail">Detail</a>
        </nav>
    </header>

    <main>
        <section class="page-shell page-shell--active" id="landing" data-page="landing" aria-labelledby="landing-title">
            <div class="hero-panel">
                <div class="hero-copy">
                    <p class="eyebrow">Showroom motor pilihan</p>
                    <h1 id="landing-title">Motor Impian Anda Ada di Sini</h1>
                    <p class="hero-text">Temukan motor bekas berkualitas dengan informasi stok, harga, dan detail yang jelas.</p>
                    <a class="primary-button" href="#katalog" data-page-link="katalog">Lihat Katalog</a>
                </div>
                <div class="hero-media" aria-label="Foto motor Honda PCX 160">
                    <img src="https://commons.wikimedia.org/wiki/Special:Redirect/file/2022%20Honda%20PCX%20160%20Gray%20Black.jpg" alt="Honda PCX 160 warna abu-abu hitam">
                </div>
            </div>

            <section class="section-block" aria-labelledby="featured-title">
                <div class="section-heading">
                    <p class="section-kicker">Motor Unggulan</p>
                    <h2 id="featured-title">Pilihan siap dilihat hari ini</h2>
                </div>
                <div class="motor-grid motor-grid--featured" data-featured-grid>
                    <div class="state-message">Memuat motor unggulan...</div>
                </div>
            </section>
        </section>

        <section class="page-shell" id="katalog" data-page="katalog" aria-labelledby="catalog-title">
            <div class="catalog-layout">
                <aside class="filter-panel" aria-label="Filter katalog">
                    <h2>Filter</h2>
                    <label>
                        Merek
                        <select data-filter-brand>
                            <option value="">Semua Merek</option>
                        </select>
                    </label>
                    <label>
                        Harga
                        <select data-filter-price>
                            <option value="">Semua Harga</option>
                            <option value="under-30000000">Di bawah Rp 30 juta</option>
                            <option value="over-30000000">Rp 30 juta ke atas</option>
                        </select>
                    </label>
                    <label class="checkbox-row">
                        <input type="checkbox" data-filter-available checked>
                        Stok tersedia
                    </label>
                </aside>

                <div class="catalog-content">
                    <div class="catalog-toolbar">
                        <div>
                            <p class="section-kicker">Katalog Motor</p>
                            <h1 id="catalog-title">Cari motor yang cocok</h1>
                        </div>
                        <label class="search-box">
                            <span>Cari</span>
                            <input type="search" placeholder="Cari motor..." aria-label="Cari motor" data-search-input>
                        </label>
                    </div>

                    <div class="catalog-status" data-catalog-status role="status" aria-live="polite">Memuat katalog motor...</div>

                    <div class="motor-grid motor-grid--catalog" data-catalog-grid>
                        <div class="state-message">Mengambil data dari API...</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="page-shell" id="detail" data-page="detail" aria-labelledby="detail-title">
            <div class="detail-top">
                <figure class="detail-photo">
                    <img src="https://commons.wikimedia.org/wiki/Special:Redirect/file/2022%20Honda%20PCX%20160%20Gray%20Black.jpg" alt="Foto motor" data-detail-image>
                </figure>

                <div class="detail-summary">
                    <p class="section-kicker">Detail Motor</p>
                    <h1 id="detail-title" data-detail-title>Pilih motor dari katalog</h1>
                    <p class="detail-price" data-detail-price>-</p>
                    <p class="detail-state" data-detail-state role="status" aria-live="polite">Detail akan tampil setelah tombol Lihat Detail dipilih.</p>
                    <dl class="spec-list">
                        <div>
                            <dt>Tahun</dt>
                            <dd data-detail-year>-</dd>
                        </div>
                        <div>
                            <dt>Tipe</dt>
                            <dd data-detail-type>-</dd>
                        </div>
                        <div>
                            <dt>Status</dt>
                            <dd data-detail-status>-</dd>
                        </div>
                    </dl>
                    <a class="primary-button" href="#test-drive">Ajukan Test Drive</a>
                </div>
            </div>

            <section class="description-box" aria-labelledby="desc-title">
                <h2 id="desc-title">Deskripsi &amp; Spesifikasi</h2>
                <p data-detail-description>Data detail motor akan dimuat dari endpoint backend.</p>
                <div class="spec-table" role="table" aria-label="Spesifikasi Honda PCX 160">
                    <div role="row">
                        <span role="cell">Merek</span>
                        <strong role="cell" data-detail-brand>-</strong>
                    </div>
                    <div role="row">
                        <span role="cell">Stok</span>
                        <strong role="cell" data-detail-stock>-</strong>
                    </div>
                    <div role="row">
                        <span role="cell">Harga</span>
                        <strong role="cell" data-detail-price-table>-</strong>
                    </div>
                </div>
            </section>
        </section>
    </main>

    <footer class="site-footer">
        <span>ShowroomKu</span>
        <span>Foto motor: Wikimedia Commons</span>
    </footer>
    <script>
        window.SHOWROOM_API_BASE_URL = "<?= getenv('API_URL') ?: 'http://localhost:8000' ?>";
    </script>
    <script src="/assets/js/showroom.js?v=20260528"></script>
</body>
</html>
