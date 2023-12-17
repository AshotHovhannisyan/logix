@extends('layouts.app')

@section('content')
    @if(session('error'))
        <div class="alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="container article">
        <p class="create-article"><a href="{{ route('create')}}">Create article</a></p>
        <h1>Blog and News </h1>
        @if($articles->isEmpty())
            <p class="no-article">No articles found.</p>
        @else
            <div class="blog-news">
                @foreach($articles as $article)
                    <div class="each">
                        <div>
                            <img src="{{ asset('storage/images/' . $article->image) }}" alt="{{$article->name}}">
                        </div>
                        <p>{{$article->name}}</p>
                        <p class="desc">{{$article->description}}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
