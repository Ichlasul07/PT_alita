# Aplikasi Manajemen Lokasi dan Karyawan

## Struktur Proyek

### Model
- **Location.php:** Mengelola data lokasi.
- **Employee.php:** (Jika relevan) Mengelola data karyawan yang terkait dengan lokasi.

### Controller
- **LocationController.php:** Mengelola operasi CRUD untuk lokasi.
- **EmployeeController.php:** (Jika relevan) Mengelola operasi CRUD untuk karyawan.

### View
- **locations/index.blade.php:** Tampilan utama untuk mengelola lokasi, dengan formulir modal untuk menambah/mengedit data.

### Routes
- **web.php:** Mendefinisikan rute untuk manajemen lokasi dan karyawan.

### Migrasi
- **create_locations_table.php:** Mendefinisikan skema untuk tabel lokasi.
- **create_employees_table.php:** (Jika relevan) Mendefinisikan skema untuk tabel karyawan.

## Menjalankan Aplikasi

### Prasyarat
- PHP 8.x
- Composer
- Laravel 9.x
- MySQL

### Langkah Instalasi
1. Clone repository:
   ```bash
   git clone https://github.com/username_anda/nama-repo-anda.git
   cd nama-repo-anda
