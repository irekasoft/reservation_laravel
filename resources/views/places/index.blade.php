@extends('layouts.master')

@section('content')

<h1>List</h1>
<p class="lead">All your place. <a class="btn btn-primary" href="{{ route('places.create') }}">Add a new one?</a></p>
<hr>

@foreach($places as $place)
    <h3><a href="{{ route('places.show', $place->id) }}">{{ $place->name }}</a></h3>
    <p>{{ $place->address}}</p>
    <p>

    </p>
    <ul>
    @foreach($place->facilities as $facility)
        <li>{{ $facility->id }}. {{ $facility->name }}
        <p>Capacity: {{ $facility->capacity}}, Rate: RM{{ $facility->rate}}   <a class="btn btn-primary" href="{{ url('reservation/') }}/{{$facility->id}}">Reserve</a></p>
        </li>

    @endforeach
    </ul>
    <hr>
@endforeach

@stop
