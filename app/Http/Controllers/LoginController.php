<?php

namespace App\Http\Controllers;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request) {

        // Launch Firebase Auth
        $auth = app('firebase.auth');
        // Retrieve the Firebase credential's token
        $idTokenString = $request->input('Firebasetoken');
        try { // Try to verify the Firebase credential token with Google

          $verifiedIdToken = $auth->verifyIdToken($idTokenString);

        } catch (\InvalidArgumentException $e) { // If the token has the wrong format

          return response()->json([
              'message' => 'Unauthorized - Can\'t parse the token: ' . $e->getMessage()
          ], 401);

        } catch (InvalidToken $e) { // If the token is invalid (expired ...)

          return response()->json([
              'message' => 'Unauthorized - Token is invalide: ' . $e->getMessage()
          ], 401);

        }

        // Retrieve the UID (User ID) from the verified Firebase credential's token
        $firebaseUID = $verifiedIdToken->claims()->get('sub');
        $email = $verifiedIdToken->claims()->get('email');



        // Retrieve the user model linked with the Firebase UID
        $user = User::where('firebaseUID',$firebaseUID)->first();
        // echo '<pre>';
        //     var_dump($user);
        // echo '</pre>';
        // die;
        if($user === NULL){
          $u = User::create([
            'email' => $email,
            'firebaseUID' => $firebaseUID,

          ]);
          $token = $u->createToken("API TOKEN")->plainTextToken;
          return response()->json([
            'status' => true,
            'message' => 'User Created Successfully',
            'token' => $token,
          ], 200);
        }else{
          $token = $user->createToken("API TOKEN")->plainTextToken;
          return response()->json([
            'uuid_firebase' => $user->firebaseUID,
            'access_token' => $token,
            'token_type' => 'Bearer',
          ]);
        }

      }
}
