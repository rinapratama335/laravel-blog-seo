@extends('template_backend.home')

@section('subjudul', 'Tambah Post')

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

    <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
        @csrf {{-- Ini wajib ada di form laravel, karena untuk keamanan --}}
        <div class="form-group">
            <label>Judul</label>
            <input type="text" class="form-control" name="judul">
        </div>
        <div class="form-group">
            <label>Kategori</label>
            <select name="category_id" id="" class="form-control">
                <option value="" holder>Pilih kategori</option>
                @foreach($category as $data)
                    <option value="{{ $data->id }}">
                        {{ $data->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Konten</label>
            <textarea class="form-control" name="content"></textarea>
        </div>
        <div class="form-group">
            <label>Gambar</label>
            <input type="file" class="form-control" name="gambar">
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-sm btn-block">Simpan</button>
        </div>
    </form>
@endsection
