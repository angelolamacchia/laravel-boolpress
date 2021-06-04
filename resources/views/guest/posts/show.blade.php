@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Messaggio di {{$post->user->name}}</h1>
                <h3>Titolo: {{$post->title}}</h3>
                <p><span style="font-weight: bold">Contenuto del messaggio: </span>{{$post->content}}</p>

                @if ($post->image)
                    <p>Immagine caricata</p>
                    <img style='width:500px' src="{{asset('storage/'. $post->image)}}">
                @else 
                    <p>Immagine non caricata</p>
                @endif
            </div>
        </div>
    </div>
    
@endsection