@extends('layouts.dashboard')

@section('content')
    <h1>Dati utente</h1>
    <div class="card">
        <ul>
            <li>{{ Auth::user()->name }}</li>
            <li>{{ Auth::user()->email }}</li>
            
            @if (Auth::user()->api_token)
                <li>{{ Auth::user()->api_token }}</li>
            @else
                <form action="{{ route('admin.generate_token')}}" method="post">
                    @csrf
                    <button type="submit">GENERA API TOKEN</button>
                </form>
                
            @endif
        </ul>
    </div>
@endsection