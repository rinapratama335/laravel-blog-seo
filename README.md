## Menambahkan Creator Post

Kali ini kita akan menambahakan creator pada saat membuat post. Jadi post yang muncul akan diketahui dibuat oleh siapa.
Pertama kita tambahkan field `users_id` di tabel `posts` :
```
php artisan make:migration tambah_field_user_post
```
```
public function up()
{
    Schema::table('posts', function(Blueprint $table) {
        $table->integer('user_id');
    });
}
```

Kemudian di controller post pada function store kita tambahkan `users_id` dengan mengambil users_id dari user yang sedang login :
```
$post = Posts::create([
    'judul' => $request->judul,
    'category_id' => $request->category_id,
    'content' => $request->content,
    'gambar' => 'public/upload/posts/'.$new_gambar,
    'slug' => Str::slug($request->judul),
    'users_id' => Auth::id() //mengambil user_id dari user yang sudah login
]);
```
Jangan lupa kita import `Auth` :
```
use Auth
```

Di model Posts kita tambahkan fillablenya dengan menambahkan field user_id :
```
protected $fillable = ['judul','category_id','content','gambar', 'slug', 'users_id'];
```

Kemudian untuk menampilkan creator (user yang membuat post) kita bisa lakukan hal ini :
Pertama kita buat sebuah function di model post yang mana function ini untuk merelasikan tabel posts dengan tabel users (melalui users_id)
```
public function users() {
    return $this->belongsTo('App\User');
}
```

Kemudian di view index post tinggal kita panggil :
```
<td>{{ $data->users->name }}</td>
```
`users` diambil dari function users yang sudah kita buat di model Posts tadi.

Selain itu kita juga akan mengubah tampilan `Hi, Admin` di header menjadi nama user yang login. Caranya adalah kita panggil aja auth name usernya :
```
Hi, {{ Auth::user()->name }}
```
