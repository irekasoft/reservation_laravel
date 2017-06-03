@extends('layouts.master')

@section('content')

<h1>Add a New </h1>
<p class="lead">Add new Facility</p>
<hr>

{!! Form::open([
    'route' => 'facilities.store'
]) !!}

For Place ID: {!! $place_id !!}

 <input type="hidden" name="place_id" value="{!! $place_id !!}">

<div class="form-group">
  {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
  {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('capacity', 'Capacity:', ['class' => 'control-label']) !!}
  {!! Form::text('capacity', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('rate', 'Rate:', ['class' => 'control-label']) !!}
  {!! Form::text('rate', null, ['class' => 'form-control']) !!}
</div>


{!! Form::submit('Create New', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop
