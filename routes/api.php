<?php

use Illuminate\Http\Request;
use App\Place;
use App\Facility;
use App\Reservation;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {

  $result = ['result' => 'OK',
             'data' => 'No Data Yet'];

  $response = \Response::json($result)->setStatusCode(200, 'Success');

  return $response;

});

Route::post('search', function(Request $request){

  $from_date = $request->input('from_date');
  $to_date = $request->input('to_date');
  $location = $request->input('location');

  $from = min($from_date, $to_date);
  $till = max($from_date, $to_date);

  $reservations = Reservation::where('start_date', '<=', $from)
                                 ->where('end_date', '>=', $till)
                                 ->get();

  $places = Place::where('name','like','%'.$location.'%')->get();

  $my_places = [];
  

  foreach($places as $place){

    $my_place = ["name"=> $place->name,
                   "id"=> $place->id,
                   "address"=>$place->address,
                   "description"=>$place->description];

    $my_facilities = [];

    foreach ($place->facilities as $facility) {

      // if have reservations
      if ($reservations->count() > 0){

        // print "reservation " . $reservations->count();
        $has_matched = false;

        foreach($reservations as $reservation){

          if($reservation->facility_id == $facility->id){

            $has_matched = true;


          }

        }

        if ($has_matched == false){

          array_push($my_facilities, $facility);
        }

      // no reservations found
      }else{

        array_push($my_facilities, $facility);

      }

      // array_push($my_facilities, $facility);

      $my_place['facilities'] = $my_facilities;

    }

    array_push($my_places, $my_place);



  }


  $result = [//'facilities'=>$my_facilities,
             'result' => 'OK',
             'places' => $my_places,
             'from_date' => $from_date,
             'reservations'=>$reservations,
             'to_date' => $to_date,
             ];

  return \Response::json($result);

});

Route::post('signUp', function(Request $request){

  $name = \Request::get('name');
  $email = \Request::get('email');
  $password = \Request::get('password');
  $password_bcrypt = bcrypt($password);

  $validator = Validator::make(
       [
           'name' => $name,
           'email' => $email,
           'password' => $password
       ],
       [
           'name' => 'required',
           'email' => 'required|email|unique:users',
           'password' => 'required|min:6'
       ]
   );

  if ($validator->fails()){

    $result = ['result' => 'OK',
               'message' => 'Some of the requirements are not met'];

     $response = \Response::json($result)->setStatusCode(400, 'Fail');
     return $response;

  } else {

    $user = new \App\User;

    $user->name = $name;
    $user->email = $email;
    $user->password = $password_bcrypt;

    $user->save();

    $result = ['result' => 'Success',
               'message' => 'Account '. $name . ' with email '. $email . ' was created'];

     $response = \Response::json($result)->setStatusCode(200, 'Success');
     return $response;

  }

});


Route::post('login', function(Request $request){

  $email = \Request::get('email');
  $password = \Request::get('password');

  $user = \App\User::where('email','=', $email)->first();


  // IF THE THERE IS EMAIL MATCHED
  if ($user != null){

    if (Hash::check($password, $user->password)){

        $result = ['result' => 'Success',
                   'message' => 'Password correct'];

        $response = \Response::json($result)->setStatusCode(200, 'Success');
        return $response;

    }else{

      $result = ['result' => 'Failed',
                 'message' => 'Password Incorrect'];

      $response = \Response::json($result)->setStatusCode(400, 'Fail');
      return $response;

    }

  // NOT MATCHED
  }else{

    $result = ['result' => 'Failed',
               'message' => 'User with email not found'];

    $response = \Response::json($result)->setStatusCode(400, 'Fail');
    return $response;

  }


});
