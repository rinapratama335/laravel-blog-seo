@extends('template_backend.home')

@section('subjudul', 'Edit Tag')

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

    <form method="post" action="{{ route('tag.update', $tag->id) }}">
        @csrf {{-- Ini wajib ada di form laravel, karena untuk keamanan --}}
        @method('patch')
        <div class="form-group">
            <label>Nama Tag</label>
            <input type="text" class="form-control" name="name" value={{ $tag->name }}>
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-sm btn-block">Simpan</button>
        </div>
    </form>
@endsection
