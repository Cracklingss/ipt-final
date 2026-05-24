@extends('layouts.app')

@section('content')
<h1>Notification</h1>
<div class="content-list">
    <li><strong>Event</strong> {{ $notification->event->title ?? 'Unknown' }}</li>
    <li><strong>Message</strong> {{ $notification->message }}</li>
    <li><strong>Sent</strong> {{ $notification->date_sent ?? 'Pending' }}</li>
</div>
<div class="actions">
    <a class="button secondary" href="{{ route('notifications.index') }}">Back to notifications</a>
    <a class="button" href="{{ route('notifications.edit', $notification) }}">Edit</a>
</div>
@endsection