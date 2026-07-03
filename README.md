# Website Showroom Motor — Bagong Jaya Motor

## Anggota Tim
- Ahmad Muhaimin — Product Lead
- Wilda Putra Cahya Ramadan — Backend Developer
- Jonatan Arya Santosa — Frontend Developer

## Deskripsi Aplikasi
Bagong Jaya Motor merupakan website showroom sepeda motor yang dirancang untuk membantu proses promosi dan pengelolaan penjualan motor secara digital. Website ini memungkinkan pelanggan melihat daftar motor yang tersedia, informasi spesifikasi kendaraan, harga, serta foto motor secara online tanpa harus datang langsung ke showroom.

Selain itu, website ini juga menyediakan sistem manajemen data kendaraan bagi admin untuk mempermudah pengelolaan stok motor, update informasi kendaraan, dan monitoring data penjualan secara lebih terstruktur dan efisien.

## Tujuan Project
- Mempermudah promosi showroom secara online.
- Membantu pelanggan melihat stok motor dengan mudah.
- Meningkatkan efektivitas pengelolaan data kendaraan.
- Mendukung digitalisasi bisnis showroom sepeda motor bekas.

## Fitur Utama
- Landing page dengan motor unggulan dari API
- Katalog motor dengan filter merek, harga, dan ketersediaan
- Detail informasi motor
- Form Test Drive
- Login dan Registrasi pengguna
- Panel Admin manajemen motor
- Responsive Design

## Teknologi yang Digunakan
- **Frontend:** PHP CodeIgniter 4, HTML, CSS, JavaScript
- **Backend:** Python FastAPI + Uvicorn
- **Database:** MySQL 8
- **Infrastructure:** Docker, Docker Compose
- **Version Control:** Git & GitHub

## Cara Menjalankan (Development)
```bash
docker-compose up --build -d
```
Akses di: `http://localhost:8080`

## Cara Menjalankan (Production)
```bash
docker-compose -f docker.compose.prod.yml up --build -d
```
Akses di: `http://localhost`

## Struktur Project
```
project/
├── app/
│   ├── Controllers/   # Logic controller CI4
│   ├── Views/         # Tampilan halaman (layout, home, auth, admin)
│   └── Config/        # Routing dan konfigurasi CI4
├── public/
│   └── assets/        # CSS dan JS statis
api/
└── app/
    └── main.py        # FastAPI endpoints
docker-compose.yml
docker.compose.prod.yml
```
