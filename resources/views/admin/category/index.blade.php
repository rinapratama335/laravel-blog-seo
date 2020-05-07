@extends('template_backend.home')

@section('content')
<h2>Ini adalah Category</h2>
@foreach($category as $hasil)
    <table class="table table-striped table-hover table-bordered table-sm">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $hasil->id }}</td>
                <td>{{ $hasil->name }}</td>
                <td>
                    <a href="" class="btn btn-warning btn-sm">Edit</a>
                    <a href="" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        </tbody>
    </table>
@endforeach
@endsection
