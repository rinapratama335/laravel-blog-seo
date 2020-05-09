## Fitur Many to Many Tabel Tags

Penjabarannya adalah post ini bisa mempunyai banyak tags dan tags sendiri bisa dimiliki oleh banyak post.

Untuk membuat relasi many to many ini maka kita harus memiliki tabel penghubung. Tabel pivo sendiri adalah tabel yang menjadi penghubung beberapa tabel dalam proses many to many. Kasus di sini adalah tabel `posts` dan `tags`.

Buat tabel pivotnya :
```
php artisan make:migration create_posts_tags_table
```
Kemudian isi dengan kode berikut :
```
Schema::create('posts_tags', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->integer('posts_id');
    $table->integer('tags_id');
    $table->timestamps();
});
```

Kemudian kita buat relasinya pada model `Posts` dan model `Tags`
Di model `Posts` :
```
public function tags() {
    return $this->belongsToMany('App\Tags');
}
```
Dan di model `Tags` :
```
public function posts() {
    return $this->belongsToMany('App\Posts');
}
```

Di controller post kitabuat fungsi untuk menampilkan data tags-nya dengan memodifikasi fungsi create menjadi seperti ini :
```
public function create()
{
    $tags = Tags::all();
    $category = Category::all();
    return view('admin.post.create', compact('category', 'tags'));
}
```
Jangan lupa untuk menambahkan model Tags juga :
```
use App\Tags;
```

Lalu kita buat tampilan untuk meload data tags,
```
<div class="form-group">
    <label>Pilih Tags</label>
    <select class="form-control select2" multiple="" name="tags[]">
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
    </select>
</div>
```
Untuk properti `name` kita berikan array, sehingga menjadi seperti ini :
```
name="tags[]"
```
Hal ini dimaksudkan karena kita akan menampung data lebih dari 1 data (meskipun satu datapun bisa).
Untuk tampilan multiple select-nya sendiri kita memakai `<script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>` yang kita pasang di layout footer serta `<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">` yang kita psang di header.

Kemudian di fungsi `store` saat kita menyimpan data post kita juga menambahkan/menyimpan tags ini dengan menggunakan fungsi `attach` :
```
$post->tags()->attach($request->tags);
```
`tags()` di sini kita ambil dar fungsi `tags` yang kita definisikan di model Posts saat kita membuat relasi.

Kemudian untuk menampilkan data `tags` di index kita bisa tambahkan kode berikut :
```
<td>
    @foreach($data->tags as $tag)
    <ul>
        <li>{{ $tag->name }}</li>
    </ul>
    @endforeach
</td>
```
