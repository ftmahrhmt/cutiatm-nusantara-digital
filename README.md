# SISTEM CUTI KARYAWAN NUSANTARA DIGITAL - SIAP JALAN

## 📌 Cara Menjalankan

1. Extract folder project ke:
   - `htdocs` (XAMPP)
   - `www` (Laragon/WAMP)
   - atau folder server lokal lainnya

2. Buat / Import Database:
   - File: `dbcuti_ready.sql`
   - Nama database: `dbcuti`

3. Setting koneksi database di:
   function/koneksi.php
   - Default:
   - Host : localhost
   - User : root
   - Password : (kosong)
   - Database : dbcuti

4. Jalankan di browser:
   http://localhost/cutiatm_nusantara_digital/cutiatm_final/


---

## 🔑 Akun Testing

### 👨‍💼 Admin
- Username: `admin`
- Password: `admin`

### 👨‍🔧 Karyawan
- Username: `000111`
- Password: `123456`

- Username: `111000`
- Password: `654321`

---

## ✅ Perbaikan yang Sudah Dilakukan

1. Approval cuti hanya bisa dilakukan oleh **Admin**.
2. Halaman **Cek Pengajuan** dibuat **read-only** (tidak ada tombol approve/tolak).
3. Proses cuti hanya mengambil data dengan status:
- `Approve`
- `Success`
4. Pengurangan sisa cuti:
- Otomatis sesuai **lama cuti**
- Bukan lagi dikurangi 1
5. Menu **Jadwal Cuti**:
- Menampilkan karyawan yang cutinya sudah disetujui/diproses
6. Menu **Sisa Cuti**:
- Menampilkan sisa cuti real dari database
7. Penambahan jenis cuti:
- Cuti Tahunan
- Cuti Melahirkan
8. Tampilan UI:
- Lebih lega
- Responsive
- Tabel bisa scroll di layar kecil
9. File print laporan:
- Sudah diperbaiki agar tidak error

---

## 🔄 Flowchart Sistem (Detail)

```mermaid
flowchart TD
    A[Start] --> B[Login]
    B --> C{Validasi Login}
    C -- Gagal --> B
    C -- Berhasil --> D{Cek Role}

    %% ADMIN
    D -- Admin --> E[Dashboard Admin]

    E --> F[Kelola Data Pegawai]
    F --> F1[Tambah Pegawai]
    F --> F2[Edit Pegawai]
    F --> F3[Hapus Pegawai]

    E --> G[Kelola Jenis Cuti]
    G --> G1[Tambah Jenis]
    G --> G2[Edit Jenis]
    G --> G3[Hapus Jenis]

    E --> H[Kelola Pengajuan Cuti]
    H --> H1[Lihat Pengajuan]
    H1 --> I{Setujui Cuti}
    I -- Ya --> J[Approve]
    I -- Tidak --> K[Tolak]

    E --> L[Laporan Cuti]
    L --> L1[Filter Data]
    L --> L2[Export / Cetak]

    %% KARYAWAN
    D -- Karyawan --> M[Dashboard Karyawan]

    M --> N[Ajukan Cuti]
    N --> N1[Isi Form]
    N1 --> N2[Simpan]
    N2 --> N3[Menunggu Approval]

    M --> O[Lihat Status]
    O --> O1[Disetujui / Ditolak]

    M --> P[Riwayat Cuti]
    P --> P1[Lihat Data]

    %% END
    J --> Q[End]
    K --> Q
    N3 --> Q
```

---

## ⚠️ Catatan Penting

- Pengurangan sisa cuti terjadi saat:
  👉 Admin klik tombol **Proses** di menu **Proses Cuti**

---

## 🚀 Status Project

✅ Siap dijalankan  
✅ Sudah diperbaiki bug utama  
✅ Cocok untuk demo / tugas / implementasi awal  

---
