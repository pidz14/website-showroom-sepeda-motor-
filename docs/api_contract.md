# 📄 API Contract — Website Showroom Sepeda Motor

> Kesepakatan resmi antara Backend dan Frontend Developer mengenai
> format data yang dikirim dan diterima.
>
> **Framework:** CodeIgniter 4  
> **Base URL:** `http://localhost:8080` (development) / `https://domain-showroom.com` (production)  
> **Format Data:** JSON  
> **Autentikasi:** Session CI4 (untuk web) + Bearer Token JWT (untuk API)

---

## 📋 Daftar Endpoint

| # | Method | Endpoint | Deskripsi | Auth |
|---|---|---|---|---|
| 1 | POST | `/auth/login` | Login pengguna/admin | ❌ |
| 2 | POST | `/auth/register` | Daftar akun baru | ❌ |
| 3 | GET | `/motors` | Ambil semua daftar motor (dengan filter) | ❌ |
| 4 | GET | `/motors/{id}` | Ambil detail satu motor | ❌ |
| 5 | POST | `/test-drive` | Ajukan permohonan test drive | ✅ |
| 6 | GET | `/admin/motors` | Ambil semua motor (panel admin) | ✅ Admin |
| 7 | POST | `/admin/motors` | Tambah data motor baru | ✅ Admin |

---

## 1. Login

**Endpoint:** `POST /auth/login`  
**Auth:** Tidak diperlukan

**Request Body:**
```json
{
  "email": "pembeli@gmail.com",
  "password": "password123"
}
```

**Response — 200 OK (Berhasil):**
```json
{
  "status": "success",
  "message": "Login berhasil",
  "data": {
    "id": 1,
    "nama_lengkap": "Budi Santoso",
    "email": "pembeli@gmail.com",
    "role": "user"
  }
}
```

**Response — 401 Unauthorized (Gagal):**
```json
{
  "status": "error",
  "message": "Email atau password salah"
}
```

---

## 2. Register

**Endpoint:** `POST /auth/register`  
**Auth:** Tidak diperlukan

**Request Body:**
```json
{
  "nama_lengkap": "Budi Santoso",
  "email": "pembeli@gmail.com",
  "no_telepon": "081234567890",
  "password": "password123",
  "password_confirmation": "password123"
}
```

**Response — 201 Created (Berhasil):**
```json
{
  "status": "success",
  "message": "Akun berhasil dibuat, silakan login",
  "data": {
    "id": 5,
    "nama_lengkap": "Budi Santoso",
    "email": "pembeli@gmail.com"
  }
}
```

**Response — 422 Unprocessable Entity (Validasi Gagal):**
```json
{
  "status": "error",
  "message": "Validasi gagal",
  "errors": {
    "email": ["Email sudah terdaftar"],
    "password": ["Password minimal 8 karakter"],
    "password_confirmation": ["Konfirmasi password tidak cocok"]
  }
}
```

---

## 3. Get Semua Motor (Katalog)

**Endpoint:** `GET /motors`  
**Auth:** Tidak diperlukan (halaman publik)

**Query Parameters (Opsional):**

| Parameter | Tipe | Contoh | Keterangan |
|---|---|---|---|
| `merek` | string | `?merek=Honda` | Filter berdasarkan nama merek |
| `tipe` | string | `?tipe=matic` | Filter: `matic`, `sport`, `bebek` |
| `harga_min` | integer | `?harga_min=15000000` | Harga minimum (Rupiah) |
| `harga_max` | integer | `?harga_max=30000000` | Harga maksimum (Rupiah) |
| `status` | string | `?status=tersedia` | Filter: `tersedia`, `habis`, `indent` |
| `page` | integer | `?page=1` | Halaman (default: 1) |
| `limit` | integer | `?limit=9` | Jumlah data per halaman (default: 9) |

**Contoh Request:**
```
GET /motors?merek=Honda&tipe=matic&harga_max=25000000&page=1
```

**Response — 200 OK:**
```json
{
  "status": "success",
  "data": {
    "motors": [
      {
        "id": 1,
        "nama_motor": "Honda Vario 160",
        "merek": {
          "id": 1,
          "nama_merek": "Honda"
        },
        "tipe": "matic",
        "tahun": 2024,
        "harga": 24500000,
        "harga_format": "Rp 24.500.000",
        "stok": 5,
        "status": "tersedia",
        "gambar": "/assets/img/motors/vario160.jpg"
      },
      {
        "id": 2,
        "nama_motor": "Honda Beat Deluxe",
        "merek": {
          "id": 1,
          "nama_merek": "Honda"
        },
        "tipe": "matic",
        "tahun": 2024,
        "harga": 18750000,
        "harga_format": "Rp 18.750.000",
        "stok": 8,
        "status": "tersedia",
        "gambar": "/assets/img/motors/beat_deluxe.jpg"
      }
    ],
    "pagination": {
      "current_page": 1,
      "total_pages": 4,
      "total_items": 32,
      "limit": 9
    }
  }
}
```

---

## 4. Get Detail Motor

**Endpoint:** `GET /motors/{id}`  
**Auth:** Tidak diperlukan (halaman publik)

**Contoh Request:**
```
GET /motors/1
```

**Response — 200 OK:**
```json
{
  "status": "success",
  "data": {
    "id": 1,
    "nama_motor": "Honda Vario 160",
    "merek": {
      "id": 1,
      "nama_merek": "Honda",
      "logo": "/assets/img/merek/honda.png"
    },
    "tipe": "matic",
    "tahun": 2024,
    "harga": 24500000,
    "harga_format": "Rp 24.500.000",
    "stok": 5,
    "status": "tersedia",
    "deskripsi": "Honda Vario 160 hadir dengan mesin 160cc SOHC 4 katup berpendingin cairan. Tampil modern dengan fitur keyless dan USB charger.",
    "gambar": "/assets/img/motors/vario160.jpg",
    "created_at": "2025-05-01T10:00:00Z"
  }
}
```

**Response — 404 Not Found:**
```json
{
  "status": "error",
  "message": "Data motor tidak ditemukan"
}
```

---

## 5. Ajukan Test Drive

**Endpoint:** `POST /test-drive`  
**Auth:** ✅ Wajib login sebagai `user`

**Request Body:**
```json
{
  "motor_id": 1,
  "tanggal_test": "2025-06-20",
  "waktu": "pagi",
  "catatan": "Saya ingin mencoba warna merah jika tersedia"
}
```

**Validasi Field:**

| Field | Wajib | Aturan |
|---|---|---|
| `motor_id` | ✅ Ya | ID motor yang valid dan statusnya `tersedia` |
| `tanggal_test` | ✅ Ya | Format `YYYY-MM-DD`, minimal H+1 dari hari ini |
| `waktu` | ✅ Ya | Nilai: `pagi` (08-11), `siang` (11-14), `sore` (14-17) |
| `catatan` | ❌ Opsional | Maksimal 500 karakter |

**Response — 201 Created (Berhasil):**
```json
{
  "status": "success",
  "message": "Permohonan test drive berhasil dikirim. Kami akan menghubungi Anda segera.",
  "data": {
    "id": 12,
    "motor": "Honda Vario 160",
    "tanggal_test": "2025-06-20",
    "waktu": "pagi",
    "status": "menunggu"
  }
}
```

**Response — 401 Unauthorized (Belum login):**
```json
{
  "status": "error",
  "message": "Silakan login terlebih dahulu"
}
```

**Response — 400 Bad Request (Motor tidak tersedia):**
```json
{
  "status": "error",
  "message": "Motor yang dipilih sedang tidak tersedia untuk test drive"
}
```

---

## 6. Admin — Get Semua Motor

**Endpoint:** `GET /admin/motors`  
**Auth:** ✅ Wajib login sebagai `admin`

**Response — 200 OK:**
```json
{
  "status": "success",
  "data": {
    "motors": [
      {
        "id": 1,
        "nama_motor": "Honda Vario 160",
        "merek": "Honda",
        "tipe": "matic",
        "tahun": 2024,
        "harga_format": "Rp 24.500.000",
        "stok": 5,
        "status": "tersedia",
        "total_test_drive": 3
      }
    ],
    "total": 32
  }
}
```

---

## 7. Admin — Tambah Motor Baru

**Endpoint:** `POST /admin/motors`  
**Auth:** ✅ Wajib login sebagai `admin`  
**Content-Type:** `multipart/form-data` (karena ada upload gambar)

**Request Body (form-data):**
```
merek_id      : 1
nama_motor    : Honda Vario 160 CBS ISS
tipe          : matic
tahun         : 2024
harga         : 25500000
stok          : 10
deskripsi     : Deskripsi lengkap motor...
gambar        : [file upload .jpg/.png, maks 2MB]
status        : tersedia
```

**Response — 201 Created (Berhasil):**
```json
{
  "status": "success",
  "message": "Data motor berhasil ditambahkan",
  "data": {
    "id": 33,
    "nama_motor": "Honda Vario 160 CBS ISS"
  }
}
```

**Response — 422 Unprocessable Entity:**
```json
{
  "status": "error",
  "message": "Validasi gagal",
  "errors": {
    "nama_motor": ["Nama motor wajib diisi"],
    "harga": ["Harga harus berupa angka positif"],
    "gambar": ["Format file harus JPG atau PNG, maksimal 2MB"]
  }
}
```

---

## 🤝 Catatan Kesepakatan Tim

- Semua response menggunakan struktur konsisten: `{ status, message, data }`
- Gunakan HTTP status code yang tepat: `200`, `201`, `400`, `401`, `403`, `404`, `422`, `500`
- Format harga: Backend mengirim angka (`24500000`), Frontend format sendiri ke "Rp 24.500.000"
- Endpoint `/admin/*` hanya bisa diakses oleh user dengan `role = admin`
- Perubahan API Contract **wajib didiskusikan bersama** sebelum diimplementasi

---

*Versi: 1.0 | Terakhir diperbarui oleh: Seluruh Tim*
