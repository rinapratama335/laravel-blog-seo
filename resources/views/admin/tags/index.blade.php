@extends('template_backend.home')

@section('subjudul', 'Tags')

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session('success') }}
        </div>
    @endif

    <a href="{{ route('tag.create') }}" class="btn btn-primary btn-sm">Tambah Tag</a><br /><br />

    <table class="table table-striped table-hover table-bordered table-sm">
        <thead>
            <tr>
                <th>No</th>
                <th>Tag</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tags as $hasil => $data)
                <tr>
                    <td>{{ $hasil + $tags->firstitem() }}</td>
                    <td>{{ $data->name }}</td>
                    <td>
                        <form action="{{ route('tag.destroy', $data->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('tag.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $tags->links() }}
@endsection
