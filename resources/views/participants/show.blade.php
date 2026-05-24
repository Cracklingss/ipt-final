@extends('layouts.app')
@section('content')
<h1>{{ $participant->name }}</h1>
<p>{{ $participant->email }}</p>
<p>Event: {{ $participant->event->title ?? '-' }}</p>
@endsection