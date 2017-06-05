@extends('layouts.master')

@section('content')

<h1>{{ $place->name }}</h1>
<p class="lead">{{ $place->address }}</p>
<hr>

<a class="btn btn-primary" href="{{ url('facilities/create/') }}/{{$place->id}}">Add a new Facility</a>

<hr />

<a href="{{ route('places.index') }}" class="btn btn-info">Back to all tasks</a>
<a href="{{ route('places.edit', $place->id) }}" class="btn btn-primary">Edit Task</a>

<hr />

@foreach($facilities as $facility)
    <h3>{{ $facility->name }}</h3>
    <p>Capacity: {{ $facility->capacity}}, Rate: RM{{ $facility->rate}}</p>
    </p>
    <hr>
@endforeach

@stop
