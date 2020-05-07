## Membuat Migartion Category dan Menampilkan Data Category

- `php artisan make:migration create_category_table`
- `php artisan make:model Category`
- `php artisan make:controller CategoryController --resource`
- `php artisan route:list` untuk mengecek list route yang ada di aplikasi kita

`protected $table = "category"` adalah kode yang kita buat karena model `Category` ini akan mengakses tabel `category`. <b>Sebenarnya</b> di Laravel jika ada model maka tabel yang diakses harus bertipe jamak, jadi kalau model Category maka tabelnya adalah categories. Namun karena penamaan tabelnya tidak umum (menyalahi aturan Laravel) maka kita buat `protected`.
