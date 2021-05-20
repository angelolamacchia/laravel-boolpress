@extends('layouts.app')

@section('content')
    <ul>
        @foreach ($posts as $post)
            <li>
                <a href="{{route('posts.show', ['slug'=>$post->slug])}}">
                    {{$post->title}}
                </a>
            </li>
        @endforeach
    </ul>
@endsection