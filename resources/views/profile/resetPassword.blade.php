@extends('layouts.app')

@section('content')

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="form-container profile">
        <h1>Reset password</h1>
        <form action="{{ route('password.reset.email.post')}}" method="POST">
            @csrf

            <input type="password" name="password" placeholder="New Password">
            @error('password')
            <div class="alert-danger">{{ $message }}</div>
            @enderror

            <input type="password" name="password_confirmation" placeholder="Repeat Password">
            @error('password_confirmation')
            <div class="alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit">Change password</button>
        </form>
    </div>
@endsection
