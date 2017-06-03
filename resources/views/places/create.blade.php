@extends('layouts.master')

@section('content')

<h1>Add a New </h1>
<p class="lead">Add to your list below.</p>
<hr>

{!! Form::open([
    'route' => 'places.store'
]) !!}

<div class="form-group">
    {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('address', 'Address:', ['class' => 'control-label']) !!}
    {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit('Create New ', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop
