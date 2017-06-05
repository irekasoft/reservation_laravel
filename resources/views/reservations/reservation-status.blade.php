@extends('layouts.master')

@section('content')

@if ($reservation != null)
<h1>{{ $reservation->reservation_no }}</h1>
<p>{{ $reservation->start_date }} to {{ $reservation->end_date }}</p>
<hr>

@else

<h1>No reservation no found</h1>

@endif


@stop
