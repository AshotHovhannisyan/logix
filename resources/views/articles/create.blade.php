@extends('layouts.app')

@section('content')
    <div class="container article">
        <div class="form-container">
            <h1>Create article</h1>
            <form action="{{ route('store.post')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" required name="name" placeholder="Name">
                @error('name')
                <div class="alert-danger">{{ $message }}</div>
                @enderror
                <textarea name="description" id="" rows="10" placeholder="Description"></textarea>
                @error('description')
                <div class="alert-danger">{{ $message }}</div>
                @enderror
                <input type="file" name="image" accept=".jpg, .png, .svg">
                @error('image')
                <div class="alert-danger">{{ $message }}</div>
                @enderror

                <button type="submit">Create article</button>
            </form>
        </div>
    </div>
@endsection
