## Membuat Update Data Kategori

Di views/admin/category/index.blade.php ubah linknya menuju edit
```
<a href="{{ route('category.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
```

Di controller category function edit
```
public function edit($id)
{
    $category = Category::findorfail($id);
    return view('admin.category.edit', compact('category'));
}
```

Untuk form pada views/admin/category/edit.blade.php
```
<form method="post" action="{{ route('category.update', $category->id) }}">
    @csrf {{-- Ini wajib ada di form laravel, karena untuk keamanan --}}
    @method('patch')
    <div class="form-group">
        <label>Nama Kategori</label>
        <input type="text" class="form-control" name="name" value={{ $category->name }}>
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-sm btn-block">Simpan</button>
    </div>
</form>
```
`action` kita arahkan ke function update
`@method('patch')` ada dua type method yang bisa kita pakai, patch/put
`value={{ $category->name }}` untuk menampilkan datayang akan diedit.
`$category` didapat dari function edit.

Di function update
```
public function update(Request $request, $id)
{
    $this->validate($request, [
        'name' => 'required'
    ]);

    $category_data = [
        'name' => $request->name,
        'slug' => Str::slug($request->name)
    ];

    Category::whereId($id)->update($category_data);
    return redirect()->route('category.index')->with('success', 'Data berhasil diupdate');
}
```

Kita bisa tampilkan flash message di inde juga, sama halnya seperi kita menambahkan data
