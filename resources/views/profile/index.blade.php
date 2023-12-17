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
        <h1>Profile Management</h1>
        <h3>Change email</h3>
        <form action="{{ route('change_email.post')}}" method="POST">
            @csrf
            <input type="email" name="change_email" placeholder="Email">
            @error('change_email')
            <div class="alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit">Change email</button>
        </form>
        <hr>
        <h3>Reset password</h3>
        <form action="{{ route('change_password.post')}}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email">
            @error('email')
            <div class="alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit">Change password</button>
        </form>
    </div>
@endsection
