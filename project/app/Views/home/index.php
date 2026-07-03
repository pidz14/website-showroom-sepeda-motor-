<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- ===================== PAGE: LANDING ===================== -->
<section class="page-shell page-shell--active" data-page="landing" aria-label="Halaman Beranda">

    <!-- Hero Banner -->
    <div class="hero-panel">
        <div class="hero-copy">
            <p class="eyebrow">Showroom Terpercaya Sejak 2005</p>
            <h1>Motor Impian Ada di Sini</h1>
            <p class="hero-text">
                Temukan ratusan pilihan motor terbaik — dari motor matic, sport, hingga bebek —
                dengan harga transparan dan layanan test drive gratis.
            </p>
            <a href="#catalog" class="primary-button" data-page-link="catalog" id="hero-cta-catalog">
                Lihat Katalog Motor
            </a>
        </div>
        <div class="hero-media">
            <img
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6d/2022_Honda_ADV160_Silver_Black.jpg/640px-2022_Honda_ADV160_Silver_Black.jpg"
                alt="Motor unggulan Bagong Jaya Motor"
                loading="eager"
            >
        </div>
    </div>

    <!-- Motor Unggulan -->
    <div class="section-block">
        <div class="section-heading">
            <div>
                <p class="section-kicker">Dari API Backend</p>
                <h2>Motor Unggulan</h2>
            </div>
            <a href="#catalog" class="ghost-button" data-page-link="catalog" id="landing-see-all">Lihat Semua →</a>
        </div>
        <div class="motor-grid motor-grid--featured" data-featured-grid id="featured-grid">
            <!-- Motor cards dimuat otomatis oleh showroom.js dari API -->
            <div class="catalog-status">Memuat motor unggulan dari API...</div>
        </div>
    </div>

    <!-- Call to Action Test Drive -->
    <div class="section-block">
        <div class="hero-panel" style="grid-template-columns: 1fr; text-align: center; padding: 40px 60px;">
            <div class="hero-copy" style="align-items: center; min-height: auto;">
                <p class="eyebrow">Gratis, Tanpa Biaya Apapun</p>
                <h2 style="font-size: 36px; color: #fff;">Ingin Coba Dulu Sebelum Beli?</h2>
                <p class="hero-text" style="margin-bottom: 0;">
                    Daftarkan diri Anda untuk sesi test drive langsung di showroom kami.
                    Tidak ada komitmen apapun.
                </p>
                <a href="<?= base_url('test-drive') ?>" class="primary-button" id="cta-test-drive" style="margin-top: 20px;">
                    Daftar Test Drive Sekarang
                </a>
            </div>
        </div>
    </div>

</section>

<!-- ===================== PAGE: KATALOG ===================== -->
<section class="page-shell" data-page="catalog" aria-label="Katalog Motor">

    <div class="catalog-toolbar">
        <div>
            <h1>Katalog Motor</h1>
            <p style="margin: 6px 0 0; color: #64748b;">Temukan motor yang sesuai kebutuhan dan anggaran Anda.</p>
        </div>
        <div class="search-box">
            <label for="search-motor">Cari Motor</label>
            <input
                type="search"
                id="search-motor"
                placeholder="Nama motor, merek, tipe..."
                data-search-input
                autocomplete="off"
            >
        </div>
    </div>

    <div class="catalog-layout">
        <!-- Panel Filter -->
        <aside class="filter-panel" aria-label="Panel filter motor">
            <h2>Filter Motor</h2>

            <label for="filter-brand">
                Merek
                <select id="filter-brand" data-filter-brand>
                    <option value="">Semua Merek</option>
                </select>
            </label>

            <label for="filter-price">
                Rentang Harga
                <select id="filter-price" data-filter-price>
                    <option value="">Semua Harga</option>
                    <option value="under-30000000">Di bawah Rp 30 juta</option>
                    <option value="over-30000000">Rp 30 juta ke atas</option>
                </select>
            </label>

            <label class="checkbox-row" for="filter-available">
                <input type="checkbox" id="filter-available" data-filter-available>
                Hanya yang tersedia
            </label>
        </aside>

        <!-- Konten Katalog -->
        <div class="catalog-content">
            <div class="catalog-status" data-catalog-status id="catalog-status">
                Memuat katalog motor dari API...
            </div>
            <div class="motor-grid motor-grid--catalog" data-catalog-grid id="catalog-grid">
                <!-- Motor cards dimuat otomatis oleh showroom.js -->
            </div>
        </div>
    </div>

</section>

<!-- ===================== PAGE: DETAIL MOTOR ===================== -->
<section class="page-shell" data-page="detail" aria-label="Detail Motor">

    <div style="margin-bottom: 20px;">
        <button
            type="button"
            class="ghost-button"
            id="btn-back-to-catalog"
            data-page-link="catalog"
            style="font-size: 14px; min-height: 38px; padding: 0 18px;"
        >
            ← Kembali ke Katalog
        </button>
    </div>

    <div class="detail-state" data-detail-state id="detail-state">
        Memuat detail motor dari API...
    </div>

    <div class="detail-top" style="margin-top: 20px;">
        <figure class="detail-photo" style="margin: 0;">
            <img
                data-detail-image
                id="detail-image"
                src=""
                alt="Foto motor"
                loading="lazy"
            >
        </figure>

        <div class="detail-summary">
            <h1 data-detail-title id="detail-title">Nama Motor</h1>
            <p class="detail-price" data-detail-price id="detail-price">Rp —</p>
            <div data-detail-status id="detail-status"></div>

            <dl class="spec-list">
                <div>
                    <dt>Merek</dt>
                    <dd data-detail-brand id="detail-brand">—</dd>
                </div>
                <div>
                    <dt>Tahun</dt>
                    <dd data-detail-year id="detail-year">—</dd>
                </div>
                <div>
                    <dt>Tipe</dt>
                    <dd data-detail-type id="detail-type">—</dd>
                </div>
            </dl>

            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="<?= base_url('test-drive') ?>" class="primary-button" id="detail-cta-testdrive">
                    Daftar Test Drive
                </a>
                <button type="button" class="ghost-button" data-page-link="catalog" id="detail-back-btn">
                    Lihat Motor Lain
                </button>
            </div>
        </div>
    </div>

    <div class="description-box">
        <h2>Deskripsi Motor</h2>
        <p data-detail-description id="detail-description">Deskripsi motor belum tersedia dari API.</p>

        <h2 style="margin-top: 28px;">Informasi Harga &amp; Stok</h2>
        <div class="spec-table">
            <div>
                <span>Stok Tersedia</span>
                <strong data-detail-stock id="detail-stock">—</strong>
            </div>
            <div>
                <span>Harga OTR</span>
                <strong data-detail-price-table id="detail-price-table">—</strong>
            </div>
        </div>
    </div>

</section>

<?= $this->endSection() ?>
