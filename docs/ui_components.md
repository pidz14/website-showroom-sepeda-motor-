# 🎨 UI Components — Website Showroom Sepeda Motor

> Daftar semua komponen UI yang dibutuhkan untuk website showroom.
> Framework: **Bootstrap 5** + CI4 Views
> Dibuat oleh: Frontend Developer

---

## 📱 Daftar Halaman Utama

### 1. Landing Page (`/` atau `/home`)
Halaman pertama yang dilihat pengunjung.

**Mockup:** [Lihat di Figma →](https://www.figma.com/file/LINK-FIGMA-KELOMPOK)

**Komponen yang dibutuhkan:**
- `Navbar` — Logo showroom + menu navigasi (Home, Katalog, Test Drive, Kontak) + tombol Login
- `HeroSection` — Banner besar dengan tagline, gambar motor unggulan, dan tombol "Lihat Katalog"
- `MotorHighlight` — Kartu 3-4 motor unggulan/terbaru
- `MerekSection` — Logo merek yang tersedia (Honda, Yamaha, Suzuki, dll)
- `WhyUsSection` — Keunggulan showroom (Harga Terbaik, Garansi, Test Drive Gratis)
- `CTASection` — Banner ajakan test drive dengan tombol CTA
- `Footer` — Alamat showroom, jam buka, kontak, dan sosial media

---

### 2. Halaman Katalog Motor (`/motors`)
Menampilkan semua motor yang tersedia dengan fitur filter.

**Mockup:** [Lihat di Figma →](https://www.figma.com/file/LINK-FIGMA-KELOMPOK)

**Komponen yang dibutuhkan:**
- `FilterSidebar` — Panel filter (merek, tipe, range harga, status)
- `SearchBar` — Kolom pencarian nama motor
- `SortDropdown` — Urutan tampilan (Terbaru, Harga Termurah, Harga Termahal)
- `MotorCard` — Kartu motor (gambar, nama, harga, badge status, tombol Detail)
- `StatusBadge` — Badge kecil: Tersedia (hijau), Indent (kuning), Habis (merah)
- `Pagination` — Navigasi halaman
- `EmptyState` — Tampilan jika tidak ada motor yang sesuai filter

---

### 3. Halaman Detail Motor (`/motors/{id}`)
Menampilkan informasi lengkap satu motor.

**Komponen yang dibutuhkan:**
- `MotorImageGallery` — Foto motor utama (bisa zoom)
- `MotorInfo` — Nama, merek, tipe, tahun, harga, status stok
- `MotorDescription` — Deskripsi dan spesifikasi motor dalam tabel
- `TestDriveButton` — Tombol "Ajukan Test Drive" (redirect ke form jika belum login)
- `RelatedMotors` — Rekomendasi motor sejenis (merek/tipe sama)

---

### 4. Halaman Login (`/auth/login`)
Autentikasi pengguna.

**Komponen yang dibutuhkan:**
- `AuthCard` — Card wrapper form login (tengah halaman)
- `InputField` — Input email dan password
- `PasswordToggle` — Ikon show/hide password
- `LoginButton` — Tombol submit dengan state loading
- `AlertMessage` — Pesan error dari server
- `RegisterLink` — Link menuju halaman Register

---

### 5. Halaman Register (`/auth/register`)
Pendaftaran akun baru.

**Komponen yang dibutuhkan:**
- `AuthCard` *(reuse dari Login)*
- `RegisterForm` — Input: nama lengkap, email, no. HP, password, konfirmasi password
- `InputField` *(reuse)*
- `AlertMessage` *(reuse)*
- `LoginLink` — Link kembali ke halaman Login

---

### 6. Halaman Form Test Drive (`/test-drive`)
Form pengajuan test drive (hanya bisa diakses setelah login).

**Komponen yang dibutuhkan:**
- `MotorSelector` — Dropdown pilih motor (atau sudah terisi jika dari halaman detail)
- `DatePicker` — Pilih tanggal test drive (disable tanggal lalu dan hari ini)
- `WaktuSelector` — Radio button: Pagi / Siang / Sore
- `CatatanField` — Textarea catatan tambahan (opsional)
- `SubmitButton` — Tombol kirim permohonan
- `SuccessMessage` — Pesan konfirmasi setelah berhasil submit

---

### 7. Halaman Kontak (`/kontak`)
Form kontak / pesan ke showroom.

**Komponen yang dibutuhkan:**
- `ContactForm` — Input: nama, email, no HP, subjek, pesan
- `ContactInfo` — Alamat, telepon, jam operasional showroom
- `MapEmbed` — Embed Google Maps lokasi showroom

---

### 8. Dashboard Admin (`/admin/dashboard`)
Panel pengelolaan data (hanya untuk role admin).

**Komponen yang dibutuhkan:**
- `AdminSidebar` — Navigasi admin (Dashboard, Kelola Motor, Test Drive, Pesan Kontak)
- `AdminTopbar` — Nama admin + tombol logout
- `StatCard` — Kartu ringkasan (Total Motor, Test Drive Menunggu, Pesan Baru)
- `DataTable` — Tabel daftar motor dengan aksi Edit/Hapus
- `MotorFormModal` — Modal form tambah/edit motor
- `ConfirmDeleteModal` — Modal konfirmasi hapus data
- `StatusDropdown` — Dropdown ubah status test drive

---

## 🧩 Komponen Global (Reusable)

| Komponen | Deskripsi | Dipakai di |
|---|---|---|
| `Navbar` | Navigasi utama dengan state login/logout | Semua halaman publik |
| `Footer` | Footer dengan info showroom | Semua halaman publik |
| `InputField` | Input dengan label dan pesan validasi error | Login, Register, Form |
| `AlertMessage` | Pesan notifikasi (success/error/warning) | Login, Register, Test Drive |
| `StatusBadge` | Badge status motor berwarna | Katalog, Detail, Admin |
| `Spinner` | Loading indicator | Semua halaman yang fetch data |
| `EmptyState` | Tampilan data kosong + ilustrasi | Katalog, Admin Table |
| `Pagination` | Navigasi halaman data | Katalog, Admin Table |
| `ConfirmModal` | Dialog konfirmasi aksi penting | Admin |

---

## 📁 Struktur Folder Views (CI4)

```
app/Views/
├── layouts/
│   ├── main.php          ← Layout utama (navbar + footer)
│   └── admin.php         ← Layout admin (sidebar + topbar)
│
├── home/
│   └── index.php         ← Landing Page
│
├── motor/
│   ├── index.php         ← Halaman Katalog
│   └── detail.php        ← Halaman Detail Motor
│
├── auth/
│   ├── login.php         ← Halaman Login
│   └── register.php      ← Halaman Register
│
├── test_drive/
│   └── form.php          ← Form Test Drive
│
├── kontak/
│   └── index.php         ← Halaman Kontak
│
├── admin/
│   ├── dashboard.php     ← Dashboard Admin
│   ├── motors/
│   │   ├── index.php     ← Tabel daftar motor
│   │   ├── create.php    ← Form tambah motor
│   │   └── edit.php      ← Form edit motor
│   └── test_drive/
│       └── index.php     ← Daftar permohonan test drive
│
└── components/           ← Partial/reusable views
    ├── navbar.php
    ├── footer.php
    ├── alert.php
    └── motor_card.php
```

---

## 🎨 Design Tokens (Warna & Tipografi)

```css
/* Warna Utama — Tema Showroom Motor */
--color-primary: #D32F2F;      /* Merah — warna utama showroom */
--color-primary-dark: #B71C1C; /* Merah gelap — hover */
--color-secondary: #212121;    /* Hitam — aksen elegan */
--color-accent: #FFC107;       /* Kuning — highlight harga & CTA */
--color-success: #388E3C;      /* Hijau — status tersedia */
--color-warning: #F57C00;      /* Oranye — status indent */
--color-danger: #C62828;       /* Merah — status habis / error */
--color-bg: #F5F5F5;           /* Background halaman */
--color-surface: #FFFFFF;      /* Background kartu */
--color-text: #212121;         /* Teks utama */
--color-text-muted: #757575;   /* Teks sekunder */

/* Tipografi */
--font-heading: 'Poppins', sans-serif;  /* Judul & heading */
--font-body: 'Nunito', sans-serif;      /* Teks umum */

/* Tambahkan di <head> HTML */
/* <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Nunito:wght@400;600&display=swap" rel="stylesheet"> */
```

---

## ✅ Checklist Progress Mockup UI

- [x] Landing Page — Mockup selesai
- [x] Katalog Motor — Mockup selesai
- [x] Login & Register — Mockup selesai
- [ ] Detail Motor — *In Progress*
- [ ] Form Test Drive — *In Progress*
- [ ] Dashboard Admin — *Belum dimulai*
- [ ] Halaman Kontak — *Belum dimulai*
