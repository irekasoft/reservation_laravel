
@extends('layouts.master')

@section('content')
<p>Today: {{$now}}</p>

{!! $calendar->calendar() !!}

{!! $calendar->script() !!}

@stop
