<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    .auth-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: calc(100vh - 152px);
        padding: 40px 24px;
    }
    .auth-card {
        width: 100%;
        max-width: 440px;
        background: #fff;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        box-shadow: 0 18px 45px rgba(17, 24, 39, 0.1);
        padding: 42px 40px;
    }
    .auth-card h1 {
        margin: 0 0 6px;
        font-size: 26px;
        color: #111827;
    }
    .auth-card .auth-subtitle {
        margin: 0 0 28px;
        color: #64748b;
        font-size: 15px;
    }
    .form-group {
        display: grid;
        gap: 6px;
        margin-bottom: 18px;
    }
    .form-group label {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
    }
    .form-group input {
        width: 100%;
        min-height: 48px;
        padding: 0 14px;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        font-size: 15px;
        color: #111827;
        background: #f9fafb;
        box-sizing: border-box;
        transition: border-color 0.2s;
    }
    .form-group input:focus {
        outline: none;
        border-color: #dc2626;
        background: #fff;
    }
    .auth-submit {
        width: 100%;
        min-height: 50px;
        margin-top: 8px;
        background: #dc2626;
        color: #fff;
        border: 0;
        border-radius: 4px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s;
    }
    .auth-submit:hover { background: #b91c1c; }
    .auth-divider {
        margin: 24px 0 0;
        text-align: center;
        font-size: 14px;
        color: #64748b;
    }
    .auth-divider a {
        color: #dc2626;
        font-weight: 600;
        text-decoration: none;
    }
    .auth-alert {
        padding: 12px 16px;
        border-radius: 4px;
        font-size: 14px;
        margin-bottom: 18px;
    }
    .auth-alert--error { background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; }
    .auth-alert--success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; }
</style>

<div class="auth-wrapper">
    <div class="auth-card">
        <h1>Masuk ke Akun</h1>
        <p class="auth-subtitle">Selamat datang kembali di Bagong Jaya Motor</p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="auth-alert auth-alert--error" id="alert-login-error">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="auth-alert auth-alert--success" id="alert-login-success">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/login') ?>" method="post" id="form-login" novalidate>
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="login-username">Username</label>
                <input
                    type="text"
                    id="login-username"
                    name="username"
                    placeholder="Masukkan username Anda"
                    value="<?= esc(old('username')) ?>"
                    required
                    autocomplete="username"
                >
            </div>

            <div class="form-group">
                <label for="login-password">Password</label>
                <input
                    type="password"
                    id="login-password"
                    name="password"
                    placeholder="Masukkan password Anda"
                    required
                    autocomplete="current-password"
                >
            </div>

            <button type="submit" class="auth-submit" id="btn-login-submit">
                Masuk
            </button>
        </form>

        <p class="auth-divider">
            Belum punya akun?
            <a href="<?= base_url('auth/register') ?>" id="link-to-register">Daftar sekarang</a>
        </p>
        <p class="auth-divider">
            <a href="<?= base_url('/') ?>" id="link-back-home">← Kembali ke Beranda</a>
        </p>
    </div>
</div>

<?= $this->endSection() ?>
