<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    .admin-wrapper { padding: 36px 0; }
    .admin-header {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 28px;
    }
    .admin-header h1 { margin: 0; font-size: 28px; }
    .admin-badge {
        display: inline-flex; align-items: center;
        padding: 6px 14px; background: #dc2626; color: #fff;
        border-radius: 999px; font-size: 13px; font-weight: 700;
    }
    .admin-table-wrap {
        overflow-x: auto;
        border: 1px solid #d1d5db; border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }
    .admin-table {
        width: 100%; border-collapse: collapse;
        background: #fff; font-size: 15px;
    }
    .admin-table thead { background: #111827; color: #fff; }
    .admin-table th {
        padding: 14px 18px; text-align: left;
        font-size: 13px; font-weight: 600; text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .admin-table td { padding: 14px 18px; border-top: 1px solid #f3f4f6; }
    .admin-table tbody tr:hover { background: #f9fafb; }
    .stock-badge {
        display: inline-block; padding: 3px 10px;
        border-radius: 999px; font-size: 13px; font-weight: 700;
    }
    .stock-ok { background: #f0fdf4; color: #15803d; }
    .stock-low { background: #fffbeb; color: #b45309; }
    .stock-empty { background: #fef2f2; color: #dc2626; }
    .admin-api-status {
        padding: 14px 18px; border-radius: 6px;
        font-size: 14px; margin-bottom: 20px;
        background: #fffbeb; border: 1px solid #fde68a; color: #b45309;
    }
    .admin-api-status.success { background: #f0fdf4; border-color: #bbf7d0; color: #15803d; }
</style>

<div class="admin-wrapper">
    <div class="admin-header">
        <div>
            <span class="admin-badge">Panel Admin</span>
            <h1 style="margin-top: 10px;">Manajemen Data Motor</h1>
        </div>
        <div style="text-align: right; color: #64748b; font-size: 14px;">
            <div>Data diambil langsung dari API Backend</div>
            <div style="margin-top: 4px;">GET <code>/admin/motors</code></div>
        </div>
    </div>

    <div class="admin-api-status" id="admin-api-status">
        ⏳ Menghubungi API backend untuk mengambil data motor...
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table" id="admin-motor-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Motor</th>
                    <th>Merek</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="admin-motor-tbody">
                <tr>
                    <td colspan="6" style="text-align: center; color: #64748b; padding: 28px;">
                        Memuat data dari API...
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <p style="margin-top: 18px; font-size: 13px; color: #64748b;">
        Catatan: Data ditampilkan dari endpoint <code>GET /admin/motors</code> melalui backend FastAPI.
    </p>
</div>

<script>
(function() {
    var apiBase = window.SHOWROOM_API_BASE_URL || '';
    var status  = document.getElementById('admin-api-status');
    var tbody   = document.getElementById('admin-motor-tbody');

    function formatRupiah(v) {
        var n = Number(v);
        if (!Number.isFinite(n)) return '—';
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(n);
    }

    function stockBadge(stok) {
        var s = Number(stok);
        if (isNaN(s) || s === undefined) return '<span class="stock-badge">—</span>';
        if (s > 5)  return '<span class="stock-badge stock-ok">' + s + ' unit</span>';
        if (s > 0)  return '<span class="stock-badge stock-low">' + s + ' unit (terbatas)</span>';
        return '<span class="stock-badge stock-empty">Habis</span>';
    }

    fetch(apiBase + '/admin/motors', { headers: { Accept: 'application/json' } })
        .then(function(res) {
            if (!res.ok) throw new Error('HTTP ' + res.status);
            return res.json();
        })
        .then(function(payload) {
            var motors = Array.isArray(payload) ? payload
                : (payload.data && Array.isArray(payload.data) ? payload.data : []);

            status.className = 'admin-api-status success';
            status.textContent = '✅ Berhasil memuat ' + motors.length + ' data motor dari API.';

            if (!motors.length) {
                tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;color:#64748b;padding:28px;">Belum ada data motor.</td></tr>';
                return;
            }

            tbody.innerHTML = motors.map(function(m) {
                var nama  = m.nama_motor || m.nama || m.name || '—';
                var merek = (m.merek && m.merek.nama_merek) ? m.merek.nama_merek : (m.merek || m.merk || '—');
                var harga = m.harga_format || formatRupiah(m.harga);
                return '<tr>'
                    + '<td><strong>' + (m.id || '—') + '</strong></td>'
                    + '<td>' + nama + '</td>'
                    + '<td>' + merek + '</td>'
                    + '<td>' + harga + '</td>'
                    + '<td>' + stockBadge(m.stok) + '</td>'
                    + '<td><span class="stock-badge ' + (m.status === 'tersedia' ? 'stock-ok' : 'stock-low') + '">'
                    + (m.status || '—') + '</span></td>'
                    + '</tr>';
            }).join('');
        })
        .catch(function(err) {
            status.style.background = '#fef2f2';
            status.style.borderColor = '#fecaca';
            status.style.color = '#b91c1c';
            status.textContent = '❌ Gagal memuat data dari API: ' + err.message;
            tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;color:#b91c1c;padding:28px;">'
                + 'Gagal menghubungi backend. Pastikan container backend berjalan.'
                + '</td></tr>';
        });
})();
</script>

<?= $this->endSection() ?>
