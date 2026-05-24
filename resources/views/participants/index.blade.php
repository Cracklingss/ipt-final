@extends('layouts.app')
@section('content')
<h1>Participants</h1>
<div class="page-actions">
    <a class="button" href="{{ route('participants.create') }}">Add participant</a>
</div>
<ul class="content-list">
@foreach($participants as $p)
    <li>{{ $p->name }} — {{ $p->email }} @if($p->event) (<a href="{{ route('events.show',$p->event) }}">{{ $p->event->title }}</a>) @endif</li>
@endforeach
</ul>
@endsection