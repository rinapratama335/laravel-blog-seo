@extends('template_backend.home')

@section('subjudul', 'Tambah Kategori')

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

    <form method="post" action="{{ route('category.store') }}">
        @csrf {{-- Ini wajib ada di form laravel, karena untuk keamanan --}}
        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-sm btn-block">Simpan</button>
        </div>
    </form>
@endsection
