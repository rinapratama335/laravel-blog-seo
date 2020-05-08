## Membuat Fitur Tampil Data, Tambah Data dan Upload Gambar di Tabel Post

Yang perlu diperhatikan, di controller post kita include model `Posts` dan model `Category`. Kenapa harus memakai model `Categori`??
Karena di dalam post terdapa fild pilihan kategori yang akan dipilih. Jadi bisa dipilh post ini termasuk di kategori apa.

Selain meng-include model `Category` di controller `Post` kita juga modifikasi model `Post` dengan menambahkan `belongsTo` (relasi), karena kita akan menampilkan kategori di form post dengan mengambil dari tabel `category`.

Unutk mengambil data kategori kita akses di function index pada controller post
```
public function create()
{
    $category = Category::all();
    return view('admin.post.create', compact('category'));
}
```
jadi kita akses data kategori kemudia kita bawa datanya ke view create.

Untuk form create kita harus menambahkan attribut `enctype="multipart/form-data"` karena kita akan mengupload file.

Dan untuk menampilkan data kategorinya kita bisa gunakan kode berikut :
```
@foreach($category as $data)
    <option value="{{ $data->id }}">
        {{ $data->name }}
    </option>
@endforeach
```
`$category` diambil dari compact('category') di function index controller post


Kemudian di function store :
```
$gambar = $request->gambar;
$new_gambar = time().$gambar->getClientoriginalName();
```
Kode tersebut untu membuat nama file yang unik. Jadi tidak akan ada file dengan nama yang sama.

```
$post = Posts::create([
    'judul' => $request->judul,
    'category_id' => $request->category_id,
    'content' => $request->content,
    'gambar' => 'public/upload/posts/'.$new_gambar
]);
```
Kode tersebut unutk menyimpan data ke dalam tabel post

```
$gambar->move('public/upload/posts/', $new_gambar);
```
Kode tersebut untuk memindahkan file ke dalam folder yang ditentukan
