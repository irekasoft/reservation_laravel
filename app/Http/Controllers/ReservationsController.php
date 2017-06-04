<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\Facility;
use App\Reservation;
use Session;
use Auth;


class ReservationsController extends Controller
{
    //
    function search(Request $request){

      $places = Place::all();

      $from_date = $request->input('from_date');
      $to_date = $request->input('to_date');

      $from = min($from_date, $to_date);
      $till = max($from_date, $to_date);

      $reservations = Reservation::where('start_date', '<=', $from)
                                     ->where('end_date', '>=', $till)
                                     ->get();

      print($reservations);

      return view('reservations.search-result',['places'=>$places,'from_date'=>$from_date, 'to_date'=>$to_date, 'reservations'=>$reservations]);

    }

    function reservationDetail($facility_id){

      $facility = Facility::find($facility_id);

      $from_date = \Request::get('from_date');
      $to_date =  \Request::get('to_date');

      return view('reservations.reservation-detail', ['facility'=>$facility,'from_date'=>$from_date,'to_date'=>$to_date]);

    }

    function confirmReservation(Request $request){

      $from_date = $request->input('from_date');
      $to_date = $request->input('to_date');
      $facility_id = $request->input('facility_id');

      $user_id = Auth::user()->id;

      $reservation = new Reservation;

      $reservation->user_id = $user_id;
      $reservation->facility_id = $facility_id;
      $reservation->start_date = $from_date;
      $reservation->end_date = $to_date;

      $reservation->save();

      return redirect(url('/'));

    }

}
