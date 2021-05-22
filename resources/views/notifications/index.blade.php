@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="list-group">
            @foreach ($notifications as $notification)
                <li class="list-group-item @if($notification->read_at == null) bg-warning @endif">
                    <div class="d-flex justify-content-between">
                        <span>{{ $notification['data']['message'] }} </span>
                        <a href="{{ route('notifications.show', $notification) }}">View</a>
                    </div>
                    <small>{{ $notification->created_at->diffForHumans() }}</small>
                </li>
            @endforeach
        </ul>
    </div>
@endsection