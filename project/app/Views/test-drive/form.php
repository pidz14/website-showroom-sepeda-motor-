<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    .testdrive-wrapper {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        min-height: calc(100vh - 152px);
        padding: 48px 24px;
        gap: 40px;
    }
    .testdrive-card {
        width: 100%;
        max-width: 500px;
        background: #fff;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        box-shadow: 0 18px 45px rgba(17, 24, 39, 0.1);
        padding: 42px 40px;
    }
    .testdrive-card h1 { margin: 0 0 6px; font-size: 26px; color: #111827; }
    .testdrive-subtitle { margin: 0 0 28px; color: #64748b; font-size: 15px; }
    .form-group { display: grid; gap: 6px; margin-bottom: 18px; }
    .form-group label { font-size: 14px; font-weight: 600; color: #374151; }
    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%; min-height: 48px; padding: 12px 14px;
        border: 1px solid #d1d5db; border-radius: 4px; font-size: 15px;
        color: #111827; background: #f9fafb; box-sizing: border-box;
        transition: border-color 0.2s; font-family: inherit;
    }
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus { outline: none; border-color: #dc2626; background: #fff; }
    .form-group textarea { min-height: 100px; resize: vertical; }
    .form-submit {
        width: 100%; min-height: 50px; margin-top: 8px;
        background: #dc2626; color: #fff; border: 0; border-radius: 4px;
        font-size: 16px; font-weight: 700; cursor: pointer; transition: background 0.2s;
    }
    .form-submit:hover { background: #b91c1c; }
    .info-box {
        background: #f0fdf4; border: 1px solid #bbf7d0;
        border-radius: 8px; padding: 20px 24px; max-width: 340px;
        align-self: flex-start; margin-top: 8px;
    }
    .info-box h2 { margin: 0 0 12px; font-size: 16px; color: #15803d; }
    .info-box ul { margin: 0; padding-left: 18px; color: #374151; font-size: 14px; line-height: 2; }
    .info-box p { margin: 16px 0 0; font-size: 13px; color: #64748b; }
    .td-alert { padding: 12px 16px; border-radius: 4px; font-size: 14px; margin-bottom: 18px; }
    .td-alert--success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; }
    .td-alert--error { background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; }
    @media (max-width: 768px) {
        .testdrive-wrapper { flex-direction: column; align-items: center; }
        .info-box { max-width: 100%; }
    }
</style>

<div class="testdrive-wrapper">
    <div class="testdrive-card">
        <h1>Daftar Test Drive</h1>
        <p class="testdrive-subtitle">Isi formulir di bawah untuk menjadwalkan sesi test drive gratis Anda</p>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="td-alert td-alert--success" id="alert-td-success">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="td-alert td-alert--error" id="alert-td-error">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('test-drive') ?>" method="post" id="form-test-drive" novalidate>
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="td-nama">Nama Lengkap</label>
                <input
                    type="text"
                    id="td-nama"
                    name="nama"
                    placeholder="Nama sesuai KTP"
                    value="<?= esc(old('nama')) ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label for="td-telepon">Nomor Telepon / WhatsApp</label>
                <input
                    type="tel"
                    id="td-telepon"
                    name="telepon"
                    placeholder="08xxxxxxxxxx"
                    value="<?= esc(old('telepon')) ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label for="td-motor-id">Pilih Motor</label>
                <select id="td-motor-id" name="motor_id" required>
                    <option value="">-- Pilih Motor --</option>
                    <?php if (!empty($motors)): ?>
                        <?php foreach ($motors as $motor): ?>
                            <option
                                value="<?= esc($motor['id']) ?>"
                                <?= old('motor_id') == $motor['id'] ? 'selected' : '' ?>
                            >
                                <?= esc($motor['nama'] ?? $motor['nama_motor'] ?? 'Motor #' . $motor['id']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="1">Vario 160 (Honda)</option>
                        <option value="2">NMAX 155 (Yamaha)</option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="td-tanggal">Tanggal Test Drive</label>
                <input
                    type="date"
                    id="td-tanggal"
                    name="tanggal"
                    min="<?= date('Y-m-d', strtotime('+1 day')) ?>"
                    value="<?= esc(old('tanggal')) ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label for="td-catatan">Catatan (opsional)</label>
                <textarea
                    id="td-catatan"
                    name="catatan"
                    placeholder="Informasi tambahan yang ingin Anda sampaikan..."
                ><?= esc(old('catatan')) ?></textarea>
            </div>

            <button type="submit" class="form-submit" id="btn-td-submit">
                Kirim Permohonan Test Drive
            </button>
        </form>

        <p style="margin: 20px 0 0; text-align: center; font-size: 14px; color: #64748b;">
            <a href="<?= base_url('/') ?>" id="link-back-home-td" style="color: #dc2626; font-weight: 600; text-decoration: none;">
                ← Kembali ke Beranda
            </a>
        </p>
    </div>

    <div class="info-box">
        <h2>✅ Keuntungan Test Drive</h2>
        <ul>
            <li>Gratis, tanpa biaya apapun</li>
            <li>Langsung di showroom kami</li>
            <li>Didampingi mekanik berpengalaman</li>
            <li>Durasi 15–30 menit per sesi</li>
            <li>Tidak ada kewajiban membeli</li>
        </ul>
        <p>
            <strong>Jam Operasional:</strong><br>
            Senin – Sabtu: 08.00 – 17.00 WIB<br>
            Minggu: 09.00 – 14.00 WIB
        </p>
    </div>
</div>

<?= $this->endSection() ?>
