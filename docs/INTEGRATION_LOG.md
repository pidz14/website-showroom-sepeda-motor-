# Integration Log & Security Evaluation - ShowroomKu

**Tanggal Evaluasi:** 5 Juni 2026
**Tim Pengembang:** 
* **Product Lead:** Ahmad Hafidz Muhaimin (Pengujian E2E & Manajemen Proyek)
* **Backend Developer:** Wilda Putra Cahya Ramadhan (Konfigurasi CORS & Endpoint)
* **Frontend Developer:** Jonatan Arya Santosa (Integrasi Fetch API & UI)

---

## 1. Ringkasan Implementasi
Integrasi antara Frontend dan Backend telah berhasil dilakukan pada repositori tim dengan detail teknis sebagai berikut:
* **Sisi Backend (CodeIgniter 4):** Mengaktifkan fitur bawaan CORS melalui modifikasi konfigurasi pada `app/Config/Cors.php` dan mendaftarkannya sebagai global filter di `app/Config/Filters.php`.
* **Sisi Frontend:** Menggunakan API bawaan browser yaitu fungsi `fetch` (asynchronous) untuk melakukan request ke endpoint backend (`/motors` dan `/motors/{id}`).

---

## 2. Hasil Diskusi Evaluasi Keamanan CORS

Tim telah melakukan analisis dan diskusi mengenai potensi kendala serta risiko keamanan saat membuka akses CORS pada aplikasi ini. Berikut adalah poin-poin hasil evaluasi:

### A. Analisis Konfigurasi Saat Ini (Tahap Development)
* **Allowed Origins:** Saat ini, `allowedOrigins` diatur secara spesifik ke `['http://localhost:8080']`. Konfigurasi ini **aman** untuk tahap pengembangan karena membatasi akses API backend hanya dari server lokal frontend tim sendiri.
* **Allowed Methods & Headers:** Metode HTTP yang diizinkan meliputi `GET`, `POST`, `PUT`, `DELETE`, dan `OPTIONS`. Sedangkan header diatur menggunakan wildcard `['*']`. Hal ini diperlukan agar frontend dapat mengirimkan data payload (seperti JSON) dan header kustom di kemudian hari.

### B. Potensi Risiko Keamanan di Masa Mendatang (Tahap Production)
1. **Bahaya Penggunaan Wildcard (`*`) pada Origins:**
   Jika saat rilis ke publik (*production*) `allowedOrigins` diubah menjadi `*` demi kemudahan, hal ini akan menimbulkan celah keamanan yang fatal. Situs web berbahaya dari luar akan dapat menembus proteksi browser dan melakukan request langsung ke backend ShowroomKu atas nama pengguna.
2. **Kerapuhan pada Endpoint Sensitif (Admin & Auth):**
   Backend memiliki beberapa grup rute sensitif seperti `/auth` (Login/Register) dan `/admin` (Manajemen data motor). Jika CORS dibuka terlalu luas atau mekanisme autentikasi (seperti token/session) tidak dienkripsi dan divalidasi dengan ketat, penyerang bisa memanfaatkan akses cross-origin untuk memanipulasi data admin.

### C. Solusi dan Langkah Mitigasi Tim
Untuk menjaga keamanan sistem, tim menyepakati langkah-langkah mitigasi berikut:
1. **Spesifikkan Domain Production:** Begitu aplikasi di-deploy ke internet, `allowedOrigins` di `app/Config/Cors.php` **wajib** diubah dari `http://localhost:8080` menjadi URL domain resmi frontend tim (misal: `https://showroomku.vercel.app`), dan dilarang keras menggunakan tanda bintang (`*`).
2. **Pengetatan Headers:** Mengubah `allowedHeaders` dari wildcard `['*']` menjadi daftar header yang benar-benar digunakan saja (contoh: `['Content-Type', 'Authorization', 'X-Requested-With']`).
3. **Proteksi Autentikasi:** Memastikan token JWT atau session yang digunakan untuk rute `/admin` dan `/test-drive` dikirimkan secara aman dan diverifikasi di sisi backend sebelum CORS memproses response lebih lanjut.

---

## 3. Lampiran Bukti Komitmen (Laporan URL Commit)

Berikut adalah URL commit sebagai bukti implementasi fitur integrasi ini:
* **Commit CORS & Endpoint Backend:** `https://github.com/pidz14/website-showroom-sepeda-motor-/commit/033d9ac4282a51b0bb35ea29100f4863d81b5f59`
* **Commit Fetch API Frontend:** `https://github.com/pidz14/website-showroom-sepeda-motor-/commit/17b73552d3060ac51963d0e957b439c57c61ca0f`