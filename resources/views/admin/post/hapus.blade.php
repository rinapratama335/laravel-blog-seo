@extends('template_backend.home')

@section('subjudul', 'Trushed Posts')

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session('success') }}
        </div>
    @endif

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
            @foreach($post as $hasil => $data)
                <tr>
                    <td>{{ $hasil + $post->firstitem() }}</td>
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
                        <form action="{{ route('post.permanent_delete', $data->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('post.restore', $data->id) }}" class="btn btn-primary btn-sm">Restore</a>
                            <button type="submit" class="btn btn-danger btn-sm">Permanant Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $post->links() }}
@endsection
