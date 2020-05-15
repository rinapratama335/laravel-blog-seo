@extends('template_backend.home')

@section('subjudul', 'User')

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session('success') }}
        </div>
    @endif

    <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">Tambah User</a><br /><br />

    <table class="table table-striped table-hover table-bordered table-sm">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Type</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $hasil => $data)
                <tr>
                    <td>{{ $hasil + $user->firstitem() }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>

                        @if($data->tipe == 1)
                            <span class="badge badge-dark">Administrator</span>
                            @else
                            <span class="badge badge-primary">Author</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('user.destroy', $data->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('user.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $user->links() }}
@endsection
