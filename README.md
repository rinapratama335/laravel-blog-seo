## Membuat Paginasi dan Penomoran Item Kategori

### Paginasi
Di controller kategori :
```
$category = Category::paginate(10);
```
Kemudian di view tinggal kita tampilkan paginasinya :
```
{{ $category->links() }}
```

### Penomoran kategori
```
@foreach($category as $hasil => $data)
    <tr>
        <td>{{ $hasil + $category->firstitem() }}</td>
        ..
        ..
    </tr>
@endforeach
```
Kode di atas berfungsi untuk membuat nomor berurut secara otomatis dan pada saat menggunakan pagination ketika berpindah ke halaman lain maka nomor halaman akan tetap sesuai urutan (bukan dimulai dari 1 lagi)
