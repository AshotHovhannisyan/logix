@extends('layouts.app')

@section('content')
    @if(session('error'))
        <div class="alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="form-container">
        <h1>Register</h1>
        <form action="{{ route('register.post')}}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="First Name">
            @error('name')
                <div class="alert-danger">{{ $message }}</div>
            @enderror

            <input type="text" name="last_name" placeholder="Last Name">
            @error('last_name')
                <div class="alert-danger">{{ $message }}</div>
            @enderror

            <input type="email" name="email" placeholder="Email">
            @error('email')
                <div class="alert-danger">{{ $message }}</div>
            @enderror

            <input type="password" name="password" placeholder="Password">
            @error('password')
                <div class="alert-danger">{{ $message }}</div>
            @enderror

            <input type="password" name="password_confirmation" placeholder="Repeat Password">
            @error('password_confirmation')
                <div class="alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit">Register</button>
        </form>
    </div>
    <!-- For
@endsection
