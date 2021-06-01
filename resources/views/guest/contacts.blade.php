@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Sezione contatti</h1>
                <form action="{{route('contacts.sent')}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name='name' class="form-control" id="name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="mail">Email</label>
                        <input type="text" name='mail' class="form-control" id="mail" placeholder="Email" required>
                    </div>
                    <div class="form-check">
                        <label for="message">Messaggio</label><br>
                        <textarea name="message" id="message" cols="80" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Invia dati</button>

                </form>
            </div>
        </div>
    </div>
@endsection