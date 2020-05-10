## Edit Post

Edit post di sini mencakup edit gambar, tags, dan lain lainnya.

Di function edit kita isi dengan kode berikut :
```
public function edit($id)
{
    $category = Category::all();
    $tags = Tags::all();
    $post = Posts::findorfail($id);

    return view('admin.post.edit', compact('post', 'category', 'tags'));
}
```

Kemudian di form edit kita berika kode berikut :
```
<form method="post" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="form-group">
        <label>Judul</label>
        <input type="text" class="form-control" name="judul" value="{{ $post->judul }}">
    </div>
    <div class="form-group">
        <label>Kategori</label>
        <select name="category_id" id="" class="form-control">
            <option value="" holder>Pilih kategori</option>
            @foreach($category as $data)
                <option value="{{ $data->id }}"
                    @if($post->category_id == $data->id)
                        selected
                    @endif
                >
                    {{ $data->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Pilih Tags</label>
        <select class="form-control select2" multiple="" name="tags[]">
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}"
                    @foreach($post->tags as $value)
                        @if($tag->id == $value->id)
                            selected
                        @endif
                    @endforeach
                >{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Konten</label>
        <textarea class="form-control" name="content">{{ $post->content }}</textarea>
    </div>
    <div class="form-group">
        <label>Gambar</label>
        <input type="file" class="form-control" name="gambar">
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-sm btn-block">Simpan</button>
    </div>
</form>
```
Jangan lupa kasih `@method('patch')` karena kita akan memlakukan edit.

Kemudian di function update kita isi dengan kode berikut :
```
public function update(Request $request, $id)
{
    $this->validate($request, [
        'judul' => 'required',
        'category_id' => 'required',
        'content' => 'required',
    ]);

    $post = Posts::findorfail($id);

    if($request->has('gambar')) {
        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientoriginalName();
        $gambar->move('public/upload/posts/', $new_gambar);

        $post_data = [
            'judul' => $request->judul,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'gambar' => 'public/upload/posts/'.$new_gambar,
            'slug' => Str::slug($request->judul)
        ];

        $post->tags()->sync($request->tags);
    } else {
        $post_data = [
            'judul' => $request->judul,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'slug' => Str::slug($request->judul)
        ];

        $post->tags()->sync($request->tags);
    }


    $post->update($post_data);

    return redirect()->back()->with('success', 'Berhasil mengupdate post');
}
```
`if else` di atas adalah untuk memeriksa apakah gambar diupdate atau tidak.
Jika di saat menyimpan data kita memasukkan `tags` dengan method `attach` maka saat update data kita memasukkan `tags` dengan method `sync`.
Jangan lupa `tags` di sini berfungsi sebagai pivot tabel.
