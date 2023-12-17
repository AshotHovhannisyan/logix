@extends('layouts.app')

@section('content')
@if(session('error'))
    <div class="alert-danger">
        {{ session('error') }}
    </div>
@endif
@endsection
