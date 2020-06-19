## Requirements

1. Ketika category dipilih maka akan keluar subcategory dengan menyesuaikan primary key category yang di pilih [done]
2. Buat proses penyimpanan yang berisi; title product, brands, gender, category, sub category, dan deskripsi
3. Ketika menyimpan, page tidak reload atau refresh [done]
4. List product menggunakan datatable, dengan menggunakan server side [done]
5. Icon delete berfungsi menghapus cell atau satu item yang di klik (Nilai plus apabila tidak ada reload ketika di klik) [done]
6. Buat satu lagi tombol action jika di klik akan keluar alert dengan text title product yang di colom tersebut
7. Hilangkan lambang short di table untuk menghapus [done]
8. Buat data untuk mengisi tabel list product lebih dari 20 (menggunakan library faker menjadi nilai plus) [done]


## Technology

- [Laravel 7](https://laravel.com/)
- [NPM 6.14.5](https://www.npmjs.com/)
- [Admin LTE 3](https://adminlte.io/)
- [Bootstrap 4](https://getbootstrap.com/)
- [DataTable](https://datatables.net/)
- [Laravel DataTables](https://github.com/yajra/laravel-datatables)


# Implements
- Seeder and Factory

## Getting Started
- Download / Clone from github

- Set up your database in .env file

- Install composer
  ```
  composer install
  ```

- Generate Key
  ```
  php artisan key:generate
  ```
  
- run migration and seeding
  ```
  php artisan migrate:fresh --seed
  ```

