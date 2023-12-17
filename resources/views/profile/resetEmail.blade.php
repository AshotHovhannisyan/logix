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
        <h1>Reset email</h1>
        <form action="{{ route('email.reset.email.post')}}" method="POST">
            @csrf
            <p>Please enter the code you received via email</p>
            <input type="text" required name="code" maxlength="4" placeholder="Code">
            @error('code')
            <div class="alert-danger">{{ $message }}</div>
            @enderror
            <input type="email" required name="email" placeholder="New email">
            @error('email')
            <div class="alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit">Change email</button>
        </form>
    </div>
@endsection
