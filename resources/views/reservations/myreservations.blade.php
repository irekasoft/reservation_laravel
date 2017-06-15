@extends('layouts.master')

@section('content')

<h1>My Reservations</h1>

<table class="table">

<thead>
<tr>
<th>reservation_no</th>
<th>is_paid</th>
<th>facility_id</th>
<th>is_approved</th>
<th>start_date</th>
<th>end_date</th>

</tr>
</thead>

<tbody>

@foreach($reservations as $reservation)

<tr>
    <td>{{ $reservation->reservation_no}}</td>
    <td>{{ $reservation->is_paid}}</td>
    <td>{{ $reservation->facility_id}}</td>

    <td>{{ $reservation->is_approved}}</td>
    <td>{{ $reservation->start_date}}</td>
    <td>{{ $reservation->end_date}}</td>
</tr>

@endforeach

</tbody>
</table>

@stop
