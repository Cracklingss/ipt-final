@extends('layouts.app')
@section('content')
<h1>Notifications</h1>
<div class="page-actions">
    <a class="button" href="{{ route('notifications.create') }}">Create</a>
</div>
<ul class="content-list">
@forelse($notifications as $n)
    <li><a href="{{ route('notifications.show', $n) }}">{{ $n->message }} — {{ $n->event->title ?? 'No event' }} — {{ $n->date_sent ?? 'Pending' }}</a></li>
@empty
    <li>No notifications available.</li>
@endforelse
</ul>
@endsection