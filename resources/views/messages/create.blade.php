@extends('layouts.app')


@section('content')
    
    <div class="container">
        <h2>Write Message</h2>
        <div class="alert alert-warning">
            You're allowed to send a message to admin. But If you want to view the responses, Please login.
        </div>
        <form action="{{ route('messages.store') }}" method="POST" id="mform">
            @csrf
            @auth
                <div class="form-group">
                    <input type="hidden" name="username" value="{{ auth()->user()->username }}">
                </div>
            @else
                <div class="form-group">
                    <label for="">Enter your username</label>
                    <input type="text" name="username"  class="form-control">
                </div>
            @endauth
                <div class="form-group">
                    <label for="">Your Message here (max : 150 character)</label>
                    <textarea name="message" id="message" cols="30" rows="10" maxlength="150" required class="form-control" x-on:input=""></textarea>
                </div>
                <div class="form-group d-flex justify-content-between">
                    <button class="btn btn-primary">Send now</button>
                    <button type="button" class="btn btn-danger" onClick="document.getElementById('mform').reset()">Reset form</button>
                </div>
        </form>
    </div>

@endsection 