<?php

namespace App\Http\Controllers;

use App\User;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FameController extends Controller
{
    public function index($filter = 'IMD-10-miles-of-wow!')
    {
        $user = Auth::user();
        $schedules = Schedule::all();
        $start_week = Carbon::now()->startOfWeek();
        $end_week = Carbon::now()->startOfWeek()->addDays(6);
        $users = User::join('activities', 'users.id', '=', 'activities.user_id')->where('users.schedule_id', $schedules->where('name', str_replace('-', ' ', $filter))->first()->id)->where('activities.start_date', '>=', $start_week)->where('activities.start_date', '<=', $end_week)->groupBy('users.id')->orderByRaw('SUM(activities.distance) DESC')->take('5')->get();
        return view("hall-of-fame", compact('schedules', 'users', 'user'));
    }
}
