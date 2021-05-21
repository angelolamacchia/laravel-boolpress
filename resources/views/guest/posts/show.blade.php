@extends('layouts.app')

@section('content')
    <h1>Messaggio di {{$post->user->name}}</h1>
    <h3>Titolo: {{$post->title}}</h3>
    <p>{{$post->content}}</p>
@endsection