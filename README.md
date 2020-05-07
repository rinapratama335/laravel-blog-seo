## Membuat Fitur Tambah Data Kategori Dan Slug Kategori

Di controller category function create
```
public function create()
{
    return view('admin.category.create');
}
```

Di `views/admin/category/create.blade.php`
```
<form method="post" action="{{ route('category.store') }}">
    @csrf
    .
    .
</form>
```
`@csrf` digunakan untuk membuat keamanan pada form. Di Laravel ini wajib digunakan karena jika tidak maka akan mengeluarkan exception.
`@csrf` ini adalah field tersembunyi yang akan meggenerate sebuah token tertentu yang akan digunakan oleh laravel.

Di contrller category function store
```
public function store(Request $request)
{
    $category = Category::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name)
    ]);

    return redirect()->back();
}
```
`'slug' => Str::slug($request->name)` ini adalah fungsi yang disediakan oleh Laravel untuk menggenerate slug. Untuk memakai ini maka kita harus mengincludekan `use Illuminate\Support\Str` di controller category

Di Model Controller
```
protected $fillable = ['name', 'slug'];
```

Kode ini digunakan Laravel untuk mengizinkan field atau data apa saja yang bisa dimasukkan ke database
