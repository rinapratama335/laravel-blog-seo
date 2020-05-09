## Menambahkan Slug di post dan menampilkan gambar di admin

Tambahkan field `slug` di tabel posts dengan menggunakan perintah berikut:
```
php artisan make:migration add_new_slug_posts_table
```
Lalu isi dengan menambahkan field slug :
```
public function up()
{
    Schema::table('posts', function (Blueprint $table) {
        $table->string('slug');
    });
}
```

Tambahkan field `slug` saat menyimpan data :
```
$post = Posts::create([
    'judul' => $request->judul,
    'category_id' => $request->category_id,
    'content' => $request->content,
    'gambar' => 'public/upload/posts/'.$new_gambar,
    'slug' => Str::slug($request->judul)
]);
```
Karena menggunakan fitur laravel slug maka jangan lupa gunakan `Support str` :
```
use Illuminate\Support\Str;
```

Jangan lupa tambahkan `slug` di `$fillable` di model Posts:
```
protected $fillable = ['judul','category_id','content','gambar', 'slug']
```

Kemudian untuk menampilkan gambar di tabel post kita bisa tambahkan kode berikut ini :
```
<td>
    <img src="{{ asset($data->gambar) }}" alt="Gambar error" class="img-fluid" style="width: 100px">
</td>
```
