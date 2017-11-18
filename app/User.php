<?php

namespace App;

use App;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'strava_id', 'firstname', 'lastname', 'sex', 'profile', 'token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token'
        // 'password', 'remember_token',
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class)->orderBy('start_date', 'asc');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function createDetails($start_date, $km_per_week, $i)
    {
        $userScheduleDetail = new UserScheduleDetail();
        $userScheduleDetail->user_id = Auth::id();
        $userScheduleDetail->week_count = $i;
        $userScheduleDetail->week = Carbon::parse($start_date)->addweeks($i-1);
        $userScheduleDetail->km_this_week = $km_per_week * $i;
        $userScheduleDetail->km_this_week_modified = $km_per_week * $i;
        $userScheduleDetail->modified_marker = false;

        $userScheduleDetail->save();
    }

    public function userScheduleDetail()
    {
        return $this->hasMany(UserScheduleDetail::class);
    }

    public function updateScheduleDetails()
    {
        $details = App\UserScheduleDetail::all()->where('user_id', Auth::id())->count();
        if($details != 0) {

            // $detail_this_week_modified = App\UserScheduleDetail::all()->where('user_id', Auth::id());

            dd("you should change man");
        }
    }

}
