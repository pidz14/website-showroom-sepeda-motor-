# 📋 DESIGN.md — Blueprint Proyek Website Showroom Sepeda Motor

> Dokumen ini merangkum visi, arsitektur, dan tautan desain proyek kelompok.

---

## 🎯 Nama Aplikasi

**MotoShow** — Website Showroom Sepeda Motor

---

## 📌 Deskripsi Ide Besar

MotoShow adalah website showroom sepeda motor berbasis web yang memungkinkan calon pembeli untuk:

- **Melihat katalog** motor yang tersedia lengkap dengan spesifikasi dan harga
- **Mencari & memfilter** motor berdasarkan merek, tipe, harga, dan tahun
- **Mengajukan test drive** secara online
- **Menghubungi admin/sales** melalui form kontak
- **Admin** dapat mengelola data motor, pesanan, dan pengguna melalui panel admin

Target pengguna:
- **Pengunjung/Calon Pembeli** — mencari dan melihat informasi motor
- **Admin/Sales** — mengelola katalog dan melayani permintaan pelanggan

---

## 🛠️ Tech Stack

| Layer | Teknologi |
|---|---|
| **Backend Framework** | CodeIgniter 4 (PHP 8.x) |
| **Frontend** | HTML5, CSS3, Bootstrap 5, JavaScript |
| **Database** | MySQL |
| **Template Engine** | CI4 View + komponen HTML native |
| **Version Control** | Git & GitHub |
| **Branch Strategy** | `main` → `development` → `feature/*` |

---

## 👥 Struktur Tim & Tanggung Jawab

| Role | Nama | Tanggung Jawab Utama |
|---|---|---|
| Product Lead | [Nama PL] | Koordinasi tim, mockup UI, buat DESIGN.md, moderasi API Contract |
| Backend Developer | [Nama BE] | ERD, database schema, controller CI4, REST API endpoint |
| Frontend Developer | [Nama FE] | Halaman HTML/CSS, integrasi ke CI4 Views, komponen UI |

---

## 🏗️ Arsitektur Sistem (MVC — CodeIgniter 4)

```
┌─────────────────────────────────────────────────────────────┐
│                        BROWSER (Client)                     │
│              HTML + CSS (Bootstrap) + JavaScript            │
└──────────────────────────┬──────────────────────────────────┘
                           │  HTTP Request
                           ▼
┌─────────────────────────────────────────────────────────────┐
│                    CODEIGNITER 4 (Server)                   │
│                                                             │
│  Routes (app/Config/Routes.php)                             │
│       ↓                                                     │
│  Controller (app/Controllers/)                              │
│       ↓              ↑                                      │
│  Model (app/Models/) ←→ Database (MySQL)                    │
│       ↓                                                     │
│  View (app/Views/)                                          │
└─────────────────────────────────────────────────────────────┘
```

---

## 📁 Struktur Folder Proyek (CI4)

```
website-showroom-sepeda-motor-/
├── app/
│   ├── Controllers/
│   │   ├── Home.php          ← Landing page
│   │   ├── Motor.php         ← Katalog & detail motor
│   │   ├── Auth.php          ← Login & Register
│   │   ├── TestDrive.php     ← Form test drive
│   │   └── Admin/
│   │       ├── Dashboard.php
│   │       └── MotorAdmin.php
│   ├── Models/
│   │   ├── MotorModel.php
│   │   ├── UserModel.php
│   │   └── TestDriveModel.php
│   └── Views/
│       ├── layouts/
│       │   └── main.php      ← Layout utama (navbar + footer)
│       ├── home/
│       ├── motor/
│       ├── auth/
│       └── admin/
├── public/assets/
│   ├── css/
│   ├── js/
│   └── img/
├── project/                  ← Folder dokumentasi tambahan
├── docs/                     ← Dokumentasi teknis (folder ini)
│   ├── DESIGN.md
│   ├── api_contract.md
│   ├── database_schema.md
│   └── ui_components.md
├── ARSITECHTURE.md
├── README.md
└── api_plan.md
```

---

## 🎨 Mockup UI (Figma/Canva)

> Link Mockup UI: **[Klik di sini untuk membuka desain →](https://www.figma.com/file/LINK-FIGMA-KELOMPOK)**

Halaman yang sudah didesain:
- [x] Landing Page
- [x] Halaman Katalog Motor
- [x] Halaman Login & Register
- [ ] Halaman Detail Motor *(in progress)*
- [ ] Dashboard Admin *(in progress)*

---

## 📋 GitHub Issues & Project Board

> 🔗 **[Buka GitHub Project Board →](https://github.com/pidz14/website-showroom-sepeda-motor-/projects)**

| Issue # | Judul | Assignee | Status |
|---|---|---|---|
| #1 | Setup struktur CI4 & branch strategy | Backend | ✅ Done |
| #2 | Buat ERD & database schema | Backend | ✅ Done |
| #3 | Mockup UI Landing Page | Frontend | ✅ Done |
| #4 | Mockup UI Katalog Motor | Frontend | ✅ Done |
| #5 | Finalisasi API Contract (5 endpoint) | Semua Tim | 🔄 In Progress |
| #6 | Implementasi Controller Motor | Backend | 🔄 In Progress |
| #7 | Implementasi View Katalog | Frontend | 🔄 In Progress |

---

## 📅 Timeline Proyek

| Minggu | Target |
|---|---|
| Minggu 7 | Finalisasi dokumen desain (DESIGN.md, ERD, Mockup, API Contract) |
| Minggu 8 | Setup CI4, migrasi database, CRUD motor (backend) |
| Minggu 9 | Implementasi Views & integrasi frontend |
| Minggu 10 | Fitur test drive, panel admin, testing |
| Minggu 11 | Deployment & presentasi |

---

## ✅ Checklist Deliverable Desain

- [x] `docs/DESIGN.md` — Dokumen ini
- [x] `docs/api_contract.md` — Kontrak API (5+ endpoint)
- [x] `docs/database_schema.md` — Skema database MySQL
- [x] `docs/ui_components.md` — Daftar komponen UI
- [x] ERD sudah dibuat (lihat `docs/database_schema.md`)
- [x] Mockup UI sudah dibuat (link Figma di atas)
