## Membuat Frontend Blog

Kita akan membuat tampilan dari blog untuk pengunjung web.

Pertama kita buka routes web.php, kemudian untuk route root ('/') kita arahkan ke view blog.blade.php
```
Route::get('/', function () {
    return view('blog');
})
```
Jangan lupa membuat template `blog.blade.php` di dalam folder `views`.

Untuk tampilan viewnya bisa dilihat di file blog.blade.php ya.

### Menampilkan post terbaru
pertama adalah kita buat controller terlebih dahulu, kita akan buat controller dengan nama BlogController :
```
use App\Posts;
```
```
public function index(Posts $posts) {
    $data = $posts->orderBy('created_at', 'desc')->get();

    return view('blog', compact('data'));
}
```

Di view blog.blade.php pada tampilan recent post kita lakukan perulangan untuk menampilkan data post terbaru.
```
@foreach($data as $hasil)
    <!-- post -->
    <div class="col-md-6">
        <div class="post">
            <a class="post-img" href="#"><img src="{{ $hasil->gambar }}" height="200" alt=""></a>
            <div class="post-body">
                <div class="post-category">
                    <a href="#">{{ $hasil->category->name }}</a>
                </div>
                <h3 class="post-title"><a href="blog-post.html">{{ $hasil->judul }}</a></h3>
                <ul class="post-meta">
                    <li><a href="author.html">{{ $hasil->users->name }}</a></li>
                    <li>{{ $hasil->created_at->diffForHumans() }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /post -->
@endforeach
```
