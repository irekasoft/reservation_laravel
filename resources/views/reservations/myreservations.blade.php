@extends('layouts.master')

@section('content')

<h1>My Reservations</h1>

@foreach($reservations as $reservation)

    <p><strong>{{ $reservation->reservation_no}}</strong></p>
    <p>{{ $reservation->is_paid}}</p>
    <p><strong>{{ $reservation->facility_id}}</strong></p>

    <p>{{ $reservation->is_approved}}</p>
    <p>{{ $reservation->start_date}}</p>
    <p>{{ $reservation->end_date}}</p>

@endforeach

@stop
