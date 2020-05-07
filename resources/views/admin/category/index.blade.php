@extends('template_backend.home')

@section('content')
    <h2>Ini adalah Category</h2>

    <table class="table table-striped table-hover table-bordered table-sm">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($category as $hasil => $data)
                <tr>
                    <td>{{ $hasil + $category->firstitem() }}</td>
                    <td>{{ $data->name }}</td>
                    <td>
                        <a href="" class="btn btn-warning btn-sm">Edit</a>
                        <a href="" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $category->links() }}
@endsection
