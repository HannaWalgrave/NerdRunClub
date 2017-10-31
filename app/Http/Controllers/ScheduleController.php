<?php

namespace App\Http\Controllers;

use App;
use App\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $user = auth()->user();
        $user = User::find($user->id);
        $schedule = $user['schedule_id'];

        // pass user and schedule data over to schedule view
        return view('schedule', compact('user', 'schedule'));
    }
}
