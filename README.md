## Membuat Validasi Form Kategori

Di controller category
```
public function store(Request $request)
{
    $this->validate($request, [
        'name' => 'required|min: 3'
    ]);

    .
    .

    return redirect()->back()->with('success', 'Data berhasil disimpan');
}
```
`with('success', 'Data berhasil disimpan')` artinya kita membuat flash message saat data berhasil disimpan.


Di views/admin/category/create.blade.php
```
@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endforeach
@endif

@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session('success') }}
    </div>
@endif
```
Kode di atas adalah kode untuk menampilkan error apabila terdapat kesalahan / pada saat validasi berjalan. Dan yang kedua adalah kode untuk menampilkan message ketika data berhasil disimpan.
