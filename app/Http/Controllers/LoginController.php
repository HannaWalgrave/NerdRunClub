<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\NerdRunClub\Strava;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        $redirect_uri = env('REDIRECT_URI');
        $client_id = env('STRAVA_ID');
        $client_secret = env('STRAVA_SECRET');
        return view('login', compact('redirect_uri','client_id','client_secret'));
    }

    public function token_exchange(Strava $strava)
    {
        // get token from url
        $token = request()->code;

        // Send post request and retrieve the current user's Strava id
        $data = $strava->post('/oauth/token', ['code' => $token]);
        $stravaUser = $data->athlete;

        // Look for user in database and either update user or make new user
        $user = App\User::firstOrNew(['strava_id' => $stravaUser->id]);

        $user->strava_id = $stravaUser->id;
        $user->firstname = $stravaUser->firstname;
        $user->lastname = $stravaUser->lastname;
        $user->sex = $stravaUser->sex;
        $user->profile = $data->athlete->profile;
        $user->token = $data->access_token;
        //$user->schedule_id = 0;
        $user->save();
        auth()->login($user);

        Artisan::call('db:update');

        $user->updateScheduleDetails();

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return view('login');
    }
}
