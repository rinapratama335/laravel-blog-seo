@extends('template_backend.home')

@section('subjudul', 'Kategori')

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session('success') }}
        </div>
    @endif

    <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm">Tambah Kategori</a><br /><br />

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
                        <form action="{{ route('category.destroy', $data->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('category.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $category->links() }}
@endsection
