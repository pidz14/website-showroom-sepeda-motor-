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
                <div class="motor-grid motor-grid--featured">
                    <article class="motor-card">
                        <img src="https://commons.wikimedia.org/wiki/Special:Redirect/file/2022%20Honda%20PCX%20160%20Gray%20Black.jpg" alt="Honda PCX 160">
                        <div class="motor-card__body">
                            <span class="status status--ready">Tersedia</span>
                            <h3>Honda PCX 160</h3>
                            <p>Rp 35.000.000</p>
                        </div>
                    </article>
                    <article class="motor-card">
                        <img src="https://commons.wikimedia.org/wiki/Special:Redirect/file/2020%20Yamaha%20NMAX%20155%20ABS%20(20200810)%2001.jpg" alt="Yamaha NMAX 155 ABS">
                        <div class="motor-card__body">
                            <span class="status status--ready">Tersedia</span>
                            <h3>Yamaha NMAX</h3>
                            <p>Rp 31.500.000</p>
                        </div>
                    </article>
                    <article class="motor-card">
                        <img src="https://commons.wikimedia.org/wiki/Special:Redirect/file/2022%20Honda%20Vario%20160%20ABS%20(20221105).jpg" alt="Honda Vario 160 ABS">
                        <div class="motor-card__body">
                            <span class="status status--limited">Unit Terbatas</span>
                            <h3>Honda Vario</h3>
                            <p>Rp 26.000.000</p>
                        </div>
                    </article>
                </div>
            </section>
        </section>

        <section class="page-shell" id="katalog" data-page="katalog" aria-labelledby="catalog-title">
            <div class="catalog-layout">
                <aside class="filter-panel" aria-label="Filter katalog">
                    <h2>Filter</h2>
                    <label>
                        Merek
                        <select>
                            <option>Semua Merek</option>
                            <option>Honda</option>
                            <option>Yamaha</option>
                        </select>
                    </label>
                    <label>
                        Harga
                        <select>
                            <option>Semua Harga</option>
                            <option>Di bawah Rp 30 juta</option>
                            <option>Rp 30 juta ke atas</option>
                        </select>
                    </label>
                    <label class="checkbox-row">
                        <input type="checkbox" checked>
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
                            <input type="search" placeholder="Cari motor..." aria-label="Cari motor">
                        </label>
                    </div>

                    <div class="motor-grid motor-grid--catalog">
                        <article class="motor-card motor-card--catalog">
                            <img src="https://commons.wikimedia.org/wiki/Special:Redirect/file/2022%20Honda%20PCX%20160%20Gray%20Black.jpg" alt="Honda PCX 160">
                            <div class="motor-card__body">
                                <span class="status status--ready">Tersedia</span>
                                <h2>Honda PCX</h2>
                                <p>Rp 35.000.000</p>
                                <a class="ghost-button" href="#detail" data-page-link="detail">Lihat Detail</a>
                            </div>
                        </article>
                        <article class="motor-card motor-card--catalog">
                            <img src="https://commons.wikimedia.org/wiki/Special:Redirect/file/2020%20Yamaha%20NMAX%20155%20ABS%20(20200810)%2001.jpg" alt="Yamaha NMAX 155 ABS">
                            <div class="motor-card__body">
                                <span class="status status--ready">Tersedia</span>
                                <h2>NMAX</h2>
                                <p>Rp 31.500.000</p>
                                <a class="ghost-button" href="#detail" data-page-link="detail">Lihat Detail</a>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section class="page-shell" id="detail" data-page="detail" aria-labelledby="detail-title">
            <div class="detail-top">
                <figure class="detail-photo">
                    <img src="https://commons.wikimedia.org/wiki/Special:Redirect/file/2022%20Honda%20PCX%20160%20Gray%20Black.jpg" alt="Foto Honda PCX 160">
                </figure>

                <div class="detail-summary">
                    <p class="section-kicker">Detail Motor</p>
                    <h1 id="detail-title">Honda PCX 160</h1>
                    <p class="detail-price">Rp 35.000.000</p>
                    <dl class="spec-list">
                        <div>
                            <dt>Tahun</dt>
                            <dd>2022</dd>
                        </div>
                        <div>
                            <dt>Transmisi</dt>
                            <dd>Matic</dd>
                        </div>
                        <div>
                            <dt>Status</dt>
                            <dd><span class="status status--ready">Tersedia</span></dd>
                        </div>
                    </dl>
                    <a class="primary-button" href="#test-drive">Ajukan Test Drive</a>
                </div>
            </div>

            <section class="description-box" aria-labelledby="desc-title">
                <h2 id="desc-title">Deskripsi &amp; Spesifikasi</h2>
                <p>Honda PCX 160 cocok untuk penggunaan harian dan perjalanan jarak menengah. Unit tampil bersih, mesin responsif, serta siap dijadwalkan untuk pengecekan langsung di showroom.</p>
                <div class="spec-table" role="table" aria-label="Spesifikasi Honda PCX 160">
                    <div role="row">
                        <span role="cell">Kapasitas Mesin</span>
                        <strong role="cell">160 cc</strong>
                    </div>
                    <div role="row">
                        <span role="cell">Bahan Bakar</span>
                        <strong role="cell">Bensin</strong>
                    </div>
                    <div role="row">
                        <span role="cell">Warna</span>
                        <strong role="cell">Gray Black</strong>
                    </div>
                </div>
            </section>
        </section>
    </main>

    <footer class="site-footer">
        <span>ShowroomKu</span>
        <span>Foto motor: Wikimedia Commons</span>
    </footer>

    <script src="/assets/js/showroom.js?v=20260528"></script>
</body>
</html>
