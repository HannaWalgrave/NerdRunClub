<?php

namespace App\Http\Controllers;

use App;
use App\User;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $schedules = Schedule::all();
        return view('schedule', compact('user', 'schedules'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $schedule_id = $request->input('schedule');
        $init_date = Carbon::now();

        if ($init_date->dayOfWeek == Carbon::MONDAY) {
            $start_date = Carbon::now();
        } elseif ($init_date->dayOfWeek == Carbon::TUESDAY) {
            $start_date = Carbon::now()->subDay();
        } elseif ($init_date->dayOfWeek == Carbon::WEDNESDAY) {
            $start_date = Carbon::now()->subDays(2);
        } elseif ($init_date->dayOfWeek == Carbon::THURSDAY) {
            $start_date = Carbon::now()->subDays(3);
        } elseif ($init_date->dayOfWeek == Carbon::FRIDAY) {
            $start_date = Carbon::now()->addDays(3);
        } elseif ($init_date->dayOfWeek == Carbon::SATURDAY) {
            $start_date = Carbon::now()->addDays(2);
        } elseif ($init_date->dayOfWeek == Carbon::SUNDAY) {
            $start_date = Carbon::now()->addDay();
        } else {
            $start_date = "ERROR";
        }

        $schedule_end_date_1 = Schedule::find($schedule_id)->end_date;
        $schedule_end_date = \DateTime::createFromFormat('Y-m-d', $schedule_end_date_1);

        $number_weeks = floor(($schedule_end_date->diff($start_date)->days) / 7);

        $km_per_week = Schedule::find($schedule_id)->distance_goal / $number_weeks;

        $user->schedule_id = $schedule_id;
        $user->init_date = $init_date;
        $user->start_date = $start_date;
        $user->number_weeks = $number_weeks;
        $user->km_per_week = $km_per_week;
        $user->save();

        for($i = 1; $i <= $number_weeks; $i++) {
            $user->createDetails($start_date, $km_per_week, $i);
        }

        return redirect()->route('home');
    }
}
