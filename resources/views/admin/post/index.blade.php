@extends('template_backend.home')

@section('subjudul', 'Posts')

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session('success') }}
        </div>
    @endif

    <a href="{{ route('post.create') }}" class="btn btn-primary btn-sm">Tambah Post</a><br /><br />

    <table class="table table-striped table-hover table-bordered table-sm">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Tags</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $hasil => $data)
                <tr>
                    <td>{{ $hasil + $posts->firstitem() }}</td>
                    <td>{{ $data->judul }}</td>
                    <td>{{ $data->category->name }}</td>
                    <td>
                        @foreach($data->tags as $tag)
                        <ul>
                            <li>{{ $tag->name }}</li>
                        </ul>
                        @endforeach
                    </td>
                    <td><img src="{{ asset($data->gambar) }}" alt="Gambar error" class="img-fluid" style="width: 100px"></td>
                    <td>
                        <form action="{{ route('post.destroy', $data->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('post.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->links() }}
@endsection
