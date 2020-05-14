## Membuat Login

Pertama kita install `laravel ui` (di larvel versi 6 laravel ui tidak diincludkan). Versi yang kita install adalah versi 1 karena varsi 2 tidak kompatibel dengan laravel 6.
```
composer require laravel/ui="1.*" --dev
```

Kemudian kita buat `auth` dengan menjalankan perintah berikut :
```
php artisan ui vue --auth
```
Pada saat ini dijalankan maka akan terdapat konfirmasi kalau `home.blade.php` sudah ada (karena kita sudah membuat file home.blade.php di folder views). Kita `yes` saja karena kita akan sesuaikan file home.blade.php kita nanti.

Sebenarnya jika kita akses halaman login ini (/login) maka fungsinya akan berjalan. Namun untuk tampilan css dan js belum dicompile oleh Laravel. Maka kita perlu ketikkan perintah berukut :
```
npm install && npm run dev
```

Kemudian tinggal kita sesuaikan saja dengan aplikasi kita, misal :
kita ubah di file home.blade.php bagian extends menjadi seperti ini :
```
@extends('template_backend.home')
```

Lalu di header.blade.php kita aktifkan fungsi tombol logout dengan mengubahnya menjadi seperti ini :
```
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<a class="dropdown-item" href="{{ route('logout') }}"
onclick="event.preventDefault();
document.getElementById('logout-form').submit();">
{{ __('Logout') }}
</a>
```

Fungsi login dan logout sudah jalan, namun ada satu hal yang masih perlu kita lakukan. Hal itu adalah melindugni route kita agar tidak bisa diakses sebelum kita login.
Kita akan bungkus route kita dengan membuat group route middleware auth, seperti ini:
```
Route::group(['middleware' => 'auth'], function() {
    .
    .
    route yang dibungkus
    .
    .
});
```
