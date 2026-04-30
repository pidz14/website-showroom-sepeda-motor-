# ARCHITECTURE.md — Pola Arsitektur Proyek Tim

## Pola yang Digunakan
Proyek ini menggunakan pola arsitektur **MVC (Model-View-Controller)**.

## Struktur Folder
project/
├── models/          # Logika bisnis & koneksi database (Backend)
├── views/           # Tampilan antarmuka pengguna (Frontend)
├── controllers/     # Penghubung Model dan View
├── public/          # Asset statis (CSS, JS, gambar)
├── app.py           # Entry point aplikasi
├── .gitignore       # File yang dikecualikan dari Git
└── ARCHITECTURE.md  # Dokumen ini
## Aturan Tim
1. Backend Developer HANYA mengubah folder `models/` dan `controllers/`
2. Frontend Developer HANYA mengubah folder `views/` dan `public/`
3. Perintah SQL/query database HANYA boleh ada di folder `models/`
4. Setiap perubahan wajib melalui Pull Request sebelum di-merge ke `development`
5. File kompilasi (`__pycache__`, `.exe`) wajib ada di `.gitignore`

## Branch Strategy
| Branch | Fungsi |
|--------|--------|
| `main` | Kode produksi yang stabil |
| `development` | Integrasi fitur dari semua developer |
| `feat-be-*` | Branch khusus Backend Developer |
| `feat-fe-*` | Branch khusus Frontend Developer |
