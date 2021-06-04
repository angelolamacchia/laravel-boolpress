@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul>
                    @foreach ($posts as $post)
                        <li>
                            <h3>
                                <a href="{{route('posts.show', ['slug'=>$post->slug])}}">
                                    {{$post->title}}
                                </a>
                            </h3>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
        
    
@endsection