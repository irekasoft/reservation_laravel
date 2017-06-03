<?php

use Illuminate\Http\Request;

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
