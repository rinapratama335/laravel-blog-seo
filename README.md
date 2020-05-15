## Menampilkan Data User
Sebelumnya kita sudah memiliki table users dan model User. Sekarang kita akan menampilkan data user.

Pertama kita buat controller user terlebih dahulu :
```
php artisan make:controller UserController --resource
```

Kemudian di menu sidbar jangan lupa kita buat menu untuk User
```
<li class="dropdown">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i> <span>User</span></a>
    <ul class="dropdown-menu">
        <li>
            <a class="nav-link" href="{{ route('user.index') }}">List User</a>
        </li>
    </ul>
  </li>
```

Kita definisikan di route web nya, kita masukkan di dalam route group middleware
```
Route::resource('/user', 'UserController')
```

### Jika sudah tinggal kita tampilkan data user di index.
Pertama di function index controller user kita tambahkan kode berikut :
```
public function index()
{
    $user = User::paginate(10);
    return view('admin.user.index', compact('user'));
}
```
Jangan lupa kita include model User di controller-nya :
```
use App\User
```

Kemudian kita buat folder user di dalam folder admin, di dalamnya kita buat file index.blade.php (untuk isinya bisa dilihat di file ya).

### Menambahkan Role User
Nah kita akan tambahkan field untuk membedakan role user ini (apakah admin ataukah creator).

Pertama kita buat migration untuk menambahkan tipe usernya :
```
php artisan make:migration add_tipe_user
```
```
public function up()
{
    Schema::table('users', function(Blueprint $table) {
        $table->boolean('tipe')->default(0);
    });
}
```

Jika sudah tinggal kita tampilkan datanya seperti ini :
```
<td>
    @if($data->tipe == 1)
        <span class="badge badge-dark">Administrator</span>
        @else
        <span class="badge badge-primary">Author</span>
    @endif
</td>
```
