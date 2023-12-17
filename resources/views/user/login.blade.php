@extends('layouts.app')

@section('content')
    @if(session('error'))
        <div class="alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="form-container">
        <h1>Login</h1>
        <form action="{{ route('login.post')}}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email">
            @error('email')
            <div class="alert-danger">{{ $message }}</div>
            @enderror

            <input type="password" name="password" placeholder="Password">
            @error('password')
            <div class="alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit">Login</button>
        </form>
    </div>
@endsection
