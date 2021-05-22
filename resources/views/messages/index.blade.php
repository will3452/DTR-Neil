@extends('layouts.app')


@section('content')
    <style>
        .mymessage{
            border-radius:20px 20px 0px 20px;
            background:#3490DC;
            padding:1em;
            color:white;
        }
        .adminmessage{
            border-radius:50px 50px 50px 0px;
            background:#232629;
            padding:1em;
            color:white;
        }
    </style>
    <div class="container">
        @foreach ($messages->reverse() as $msg)
        <div class="@if($msg->writer == 'user') mymessage @else adminmessage @endif my-2">
            {{ $msg->message }}
        </div>
        <small class="text-secondary">{{ $msg->created_at->diffForHumans() }}</small>
        @endforeach
        <form action="{{ route('messages.store') }}" method="POST" id="mform">
            @csrf
            @auth
                <div class="form-group">
                    <input type="hidden" name="username" value="{{ auth()->user()->username }}">
                </div>
            @else
                <div class="form-group">
                    <label for="">Enter your username</label>
                    <input type="text" class="form-control">
                </div>
            @endauth
                <div class="form-group">
                    <label for="">Your Message here (max : 150 character)</label>
                    <textarea name="message" autofocus id="message" cols="30" rows="10" maxlength="150" required class="form-control" x-on:input=""></textarea>
                </div>
                <div class="form-group d-flex justify-content-between">
                    <button class="btn btn-primary">Send now</button>
                </div>
        </form>
    </div>

@endsection 