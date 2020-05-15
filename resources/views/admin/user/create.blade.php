@extends('template_backend.home')

@section('subjudul', 'Tambah User')

@section('content')
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endforeach
    @endif

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session('success') }}
        </div>
    @endif

    <form method="post" action="{{ route('user.store') }}">
        @csrf {{-- Ini wajib ada di form laravel, karena untuk keamanan --}}
        <div class="form-group">
            <label>Nama User</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <label>Role</label>
            <select name="tipe" class="form-control">
                <option value="" holder>Pilih Role User</option>
                <option value="1">Administrator</option>
                <option value="0">Author</option>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-sm btn-block">Simpan</button>
        </div>
    </form>
@endsection
