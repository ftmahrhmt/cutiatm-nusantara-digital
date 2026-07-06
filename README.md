# 📌 Sistem Pengajuan Cuti Karyawan Nusantara Digital

Aplikasi berbasis web yang dirancang untuk mempermudah proses pengajuan dan pengelolaan cuti karyawan. Sistem ini mencakup fitur autentikasi pengguna, pengajuan cuti, persetujuan oleh admin, serta pengelolaan data pegawai secara terpusat.

---

## 🚀 Fitur Utama

* Login Admin & Karyawan
* Pengajuan Cuti
* Approval / Penolakan Cuti (Admin)
* Manajemen Data Pegawai
* Laporan Cuti
* Ganti Password (Admin & Karyawan)

---

## 👥 Role Pengguna

### **Admin**

* Mengelola data pegawai
* Mengelola pengajuan cuti
* Menyetujui atau menolak cuti
* Melihat laporan cuti
* Mengganti password

### **Karyawan**

* Mengajukan cuti
* Melihat status pengajuan cuti
* Melihat riwayat cuti
* Mengganti password

---

## 🔄 Flowchart Sistem

```mermaid
flowchart TD
    A[Start] --> B[Login]
    B --> C{Validasi Login}
    C -->|Gagal| B
    C -->|Berhasil| D{Cek Role}

    %% Admin
    D -->|Admin| E[Dashboard Admin]
    E --> F[Kelola Data Pegawai]
    E --> G[Kelola Pengajuan Cuti]
    G --> H{Setujui?}
    H -->|Ya| I[Approve Cuti]
    H -->|Tidak| J[Tolak Cuti]
    E --> R[Ganti Password]
    R --> R1[Input Password Baru]
    R1 --> R2[Simpan]

    %% Karyawan
    D -->|Karyawan| K[Dashboard Karyawan]
    K --> L[Ajukan Cuti]
    L --> M[Input Data]
    M --> N[Simpan]
    N --> O[Menunggu Approval]
    K --> P[Lihat Status Cuti]
    K --> S[Ganti Password]
    S --> S1[Input Password Baru]
    S1 --> S2[Simpan]

    I --> T[End]
    J --> T
    O --> T
    R2 --> T
    S2 --> T
```

---

## 🛠️ Teknologi yang Digunakan

* PHP Native
* MySQL
* HTML, CSS, JavaScript
* Bootstrap (Opsional)

---

## ⚙️ Cara Menjalankan

1. Clone repository ini
2. Import database ke phpMyAdmin
3. Atur koneksi database pada file `koneksi.php`
4. Jalankan aplikasi melalui localhost atau hosting

---

## 🌐 Deployment

Aplikasi dapat dijalankan pada:

* Localhost (XAMPP, Laragon, dll)
* Hosting gratis seperti InfinityFree
* Hosting berbayar / VPS

---

## 🌐 Live Demo

🚀 Aplikasi dapat diakses secara online:

🔗 **http://cutinusantaradigital.infinityfree.me/**

Silakan login menggunakan akun yang tersedia untuk mencoba fitur sistem.

## 🔑 Akun Testing

*Admin
- Username: admin
- Password: admin

*Karyawan
- Username: 12345678
- Password: 123456

---

## ⚠️ Catatan
* Approval hanya bisa dilakukan oleh Admin
* Sisa cuti berkurang otomatis sesuai lama cuti
* Pengurangan cuti saat admin klik Proses Cuti

---

## ✨ Catatan

Pastikan konfigurasi database dan koneksi sudah sesuai agar aplikasi dapat berjalan dengan baik tanpa error.

---

## 👨‍💻 Author

Dibuat oleh: **Fatmah Rohmah Tika**
