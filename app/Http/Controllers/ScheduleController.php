<?php

namespace App\Http\Controllers;

use App;
use App\User;
use App\Schedule;
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
        $allSchedules = Schedule::all();
        $selectedSchedule = $user->schedule_id;

        // pass user and schedule data over to schedule view

        if ($selectedSchedule == 0) {
            return view('schedule', compact('user', 'schedule', 'allSchedules'));
        } else {
            return view('home', compact('user'));
        }

    }

    public function store(Request $request) {
        $schedule_id = $request->schedule;
        $user = auth()->user();
        $user->schedule_id = $schedule_id;
        $user->save();

        return redirect()->route('schedule');
    }
}
