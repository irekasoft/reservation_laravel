@extends('layouts.master')

@section('content')

<p>
Search for {{$from_date}} to {{ $to_date}}
</p>

@foreach($places as $place)
    <h3><a href="{{ route('places.show', $place->id) }}">{{ $place->name }}</a></h3>
    <p>{{ $place->address}}</p>
    <p>
    </p>
    <ul>

    @foreach($place->facilities as $facility)

      <?php

        if ($reservations->count() > 0){

          $has_matched = false;

          foreach($reservations as $reservation){

            if($reservation->facility_id == $facility->id){
              $has_matched = true;
            }

          }

          if ($has_matched== false){

            ?>

            <li>{{ $facility->id }}. {{ $facility->name }}
            <p>Capacity: {{ $facility->capacity}}, Rate: RM{{ $facility->rate}} <a class="btn btn-primary" href="{{ url('reservation/') }}/{{$facility->id}}?from_date={{$from_date}}&to_date={{$to_date}}">Book</a></p>
            </li>
            <?php

          }

        }else{

          ?>
          <li>{{ $facility->id }}. {{ $facility->name }}
          <p>Capacity: {{ $facility->capacity}}, Rate: RM{{ $facility->rate}} <a class="btn btn-primary" href="{{ url('reservation/') }}/{{$facility->id}}?from_date={{$from_date}}&to_date={{$to_date}}">Book</a></p>
          </li>
          <?php

        }


      ?>

    @endforeach
    </ul>
    <hr>
@endforeach

@stop
