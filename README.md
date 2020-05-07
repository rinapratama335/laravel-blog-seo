## Delete Data Kategori

Di views/admin/category/index.blade.php ubah button hapus seperti ini
```
<form action="{{ route('category.destroy', $data->id) }}" method="post">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
</form>
```
Kenapa harus form? karena kita akan mengakses database secara langsung. Sedangkan untuk kasus edit ini kita juga akses ke database tetapi hanya menampilkan data saja
Tambahkan `@csrf` dan `@method('delete')` supaya button berfungsi

Di function destroy pada controller category
```
public function destroy($id)
{
    $category = Category::findorfail($id);
    $category->delete();

    return redirect()->back()->with('success', 'Data berhasil dihapus');
}
```
