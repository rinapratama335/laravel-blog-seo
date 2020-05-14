## Membuat Soft Delete dan Restore

### Soft Delete
Soft delete adalah fitur yang ada di laravel yang mana ketika kit menghapus data maka data tidak akan terhapus secara langsung di database, yang mana akan ditampung terlebih dahulu ke dalam data delete sementara. Jadi seandainya data tersebut ternyata tidak ingin dihpus maka kita bisa lakukan restore data kembali.

Pertama yang perlu kita lakukan adalah kita include SoftDeletes di model Posts
```
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use SoftDeletes;
    .
    .
    .
}
```

Kita juga akan buat penambahan field baru di tabel posts dagan nama `delete_at`. Field ini akan berisi timestamp yang menunjukkan waktu dari data saat dihapus. Sederhananya ketika kita melakukan delete data maka data sebenarnya belum hilang dari database, tetapi akan dipindahkan ke dalam semacam trashed table yang yang ditandai dengan field delete_as ini akan terisi. Sehingga data yang field delete_at ini ada isinya maka tidak ditampilkan ke list.
```
php artisan make:migration tambah_softdelete_ke_post
```
```
public function up()
{
    Schema::table('posts', function (Blueprint $table) {
        $table->softDeletes();
    });
}
```

Tinggal kita fungsikan tombol `Delete` yang ada di list post :
```
public function destroy($id)
{
    $post = Posts::findorfail($id);
    $post->delete();

    return redirect()->back()->with('success', 'Post berhasil dihapus (silahkan cek trush post)');
}
```

Kemudian kita juga akan membuat list untuk data yang sudah duhapus dengan menggunakna SoftDeletes tadi. Kita juga akan membuat button untuk restore data dan permanent delete di dalam list tersebut.

Buat route terlebih dahulu di routes/web.php :
```
Route::get('/post/tampil_hapus', 'PostController@tampil_hapus')->name('post.tampil_hapus');
```

Kemudian di sidebar.blade.php kita buat link untuk mengarahakn ke trashed post :
```
<li>
    <a class="nav-link" href="{{ route('post.tampil_hapus') }}">Trash Posts</a>
</li>
```
```
public function tampil_hapus() {
    $post = Posts::onlyTrashed()->paginate(10); //ini karena menggunakan pagination, jika tidak maka kita bisa gunakan 'get' saja.
    return view('admin.post.hapus', compact('post'));
}
```
Lalu viewnya di views/admin/post/hapus.blade.php :
```
Untuk kode view-nya bisa dilihat di dalam file ya
```

### Restore Data
jika tadi sudah membuat soft delet maka kita bisa membuat fungsi restore data yaitu mengembalika data yang sebelumnya sudah dihapus.

pertama kita fungsikan tombol restore nya di views/admin/post/hapus.blade.php :
```
<a href="{{ route('post.restore', $data->id) }}" class="btn btn-primary btn-sm">Restore</a>
```
Lalu kita buat routenya :
```
Route::get('/post/restore/{id}', 'PostController@restore')->name('post.restore');
```
Tinggal kita buat function nya :
```
public function restore($id) {
    $post = Posts::withTrashed()->where('id', $id)->first();
    $post->restore();

    return redirect()->back()->with('success', 'Data berhasil direstore, silahkan cek list post');
}
```

### Hapus Permanent
Hapus permanent ini kita pakai untuk menghapus data dari database (hapus secara permanent)

Kita fungsikan tombolnya dengan menambahkan action di form menjadi seperti ini :
```
<form action="{{ route('post.permanent_delete', $data->id) }}" method="post">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger btn-sm">Permanant Delete</button>
</form>
```
Jangan lupa buat routenya :
```
Route::delete('/post/permanent_delete/{id}', 'PostController@permanent_delete')->name('post.permanent_delete');
```
Kemudian buat fungtion nya :
```
public function permanent_delete($id) {
    $post = Posts::withTrashed()->where('id', $id)->first();
    $post->forceDelete();

    return redirect()->back()->with('success', 'Data berhasil dihapus secara permanen');
}
```

