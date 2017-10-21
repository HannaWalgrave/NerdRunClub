<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App;
use App\NerdRunClub\Strava;

class UserController extends Controller
{

    public function login()
    {
       return view('welcome');
    }

    public function token_exchange(Strava $strava)
    {
        // get token from url
        $token = request()->code;

        //Retrieve the current user's STRAVA ID
        $data = $strava->post('/oauth/token', ['code' => $token]);
        //Retrieve the current user's STRAVA ID
        $stravaUser = $data->athlete;

        // Look for user in database and either update user or make new user
        $user = App\User::firstOrNew(['strava_id' => $stravaUser->id]);

            $user->strava_id = $stravaUser->id;
            $user->firstname = $stravaUser->firstname;
            $user->lastname = $stravaUser->lastname;
            $user->sex = $stravaUser->sex;
            $user->profile = $data->athlete->profile;
            $user->token = $data->access_token;
            $user->save();
            auth()->login($user);

        return view('home', ['firstname' => $user->firstname, 'profile' => $user->profile]);

       
    }
}
