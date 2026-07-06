SISTEM CUTI KARYAWAN - SIAP JALAN

Cara menjalankan:
1. Extract folder project ke htdocs / www / folder server lokal kamu.
2. Buat/import database dari file: dbcuti_ready.sql
   - Database yang dipakai: dbcuti
   - User database default di function/koneksi.php: root
   - Password default: kosong
3. Jalankan lewat browser, contoh:
   http://localhost/cutiatm_nusantara_digital/cutiatm_final/

Akun testing:
- Admin: username admin, password admin
- Karyawan: username 000111, password 123456
- Karyawan: username 111000, password 654321

Perbaikan yang sudah dilakukan:
1. Approval Cuti hanya bisa dilakukan oleh admin.
2. Halaman Cek Pengajuan dibuat read-only, tidak ada aksi approve/tolak.
3. Proses Cuti sudah memanggil data pengajuan yang statusnya Approve/Success.
4. Saat cuti diproses, sisa cuti karyawan otomatis berkurang sesuai lama cuti, bukan hanya berkurang 1.
5. Jadwal Cuti menampilkan karyawan yang cutinya sudah disetujui/diproses.
6. Sisa Cuti menampilkan sisa cuti real dari tabel karyawan dan riwayat cuti.
7. Jenis cuti ditambah: Cuti Tahunan dan Cuti Melahirkan.
8. Tampilan dirapikan agar lebih lega, tidak sempit, dan tabel bisa scroll di layar kecil.
9. File print laporan utama sudah dirapikan agar tidak error.

Catatan:
- Status alur data: Pending -> Approve/Tolak -> Success.
- Pengurangan sisa cuti terjadi saat admin klik Proses di menu Proses Cuti.
