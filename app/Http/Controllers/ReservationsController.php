<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\Facility;
use App\Reservation;
use Session;
use Auth;
use Calendar;
use Carbon\Carbon;

class ReservationsController extends Controller
{

  public function index()
  {

    $reservations = Reservation::all();
    return view('reservations.index')->with('reservations',$reservations);

  }

  function checkReservation(Request $request){

    $reservation_no = $request->input('reservation_no');
    $reservation = Reservation::where('reservation_no','=',$reservation_no)->first();

    return view('reservations.reservation-status',['reservation' => $reservation]);

  }

  //
  function search(Request $request){

    $from_date = $request->input('from_date');
    $to_date = $request->input('to_date');
    $location = $request->input('location');


    $from = min($from_date, $to_date);
    $till = max($from_date, $to_date);

    $reservations = Reservation::where('start_date', '>=', $from)
                                 ->where('end_date', '<=', $till)
                                 ->orWhere('end_date', '>=', $from)
                                 ->where('start_date', '<=', $till)
                                 ->get();

    $places = Place::where('name','like','%'.$location.'%')->get();

    //print($reservations);

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

    if (Auth::user() == null){

      return 'Please log in';

    }

    $user_id = Auth::user()->id;


    $reservation = new Reservation;

    $reservation->user_id = $user_id;
    $reservation->facility_id = $facility_id;
    $reservation->start_date = $from_date;
    $reservation->end_date = $to_date;
    $reservation->reservation_no = uniqid();

    $reservation->save();

    return redirect(url('/'));

  }

  function myReservations(Request $request){

    if (Auth::user() == null){

      return 'Please log in';

    }

    $user_id = Auth::user()->id;

    $reservations = Reservation::where('user_id','=',$user_id)->get();

    return view('reservations.myreservations')->with('reservations',$reservations);

  }

  function calendar(Request $request){

    $reservations = Reservation::all();

    foreach ($reservations as $reservation){

      $facility = Facility::find($reservation->facility_id);

      $end_date = new \DateTime($reservation->end_date);

      $events_arr[] = \Calendar::event(
        $facility->id . ". " . $facility->name . " (". $facility->place->name . ")", //event title
        true, //full day event?
        new \DateTime($reservation->start_date),
        $end_date->modify('+1 day'),
        'id'
      );

    }


    $calendar = \Calendar::addEvents($events_arr); //add an array with addEvents

    $data = array(
      'now'=>Carbon::today(),
  		'events'=>$reservations,
  		'calendar'=>$calendar,
  		);


    return view('reservations.calendar', $data);


  }

}
