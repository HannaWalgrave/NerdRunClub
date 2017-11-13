<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'strava_id', 'firstname', 'lastname', 'sex', 'profile', 'token', 'schedule_id',
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
        return $this->hasMany(Activity::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function userData()
    {
        return $this->hasMany(UserData::class);
    }

    public function generateUserData()
    {
        $scheduleDatas = ScheduleData::where('schedule_id', $this->schedule->id)->get();
        foreach($scheduleDatas as $scheduleData) {
            $userData = new UserData();
            $userData->user_id = $this->id;
            $userData->scheduleData_id = $scheduleData->id;
            $userData->date = Carbon::parse($this->schedule_start)->addDays(($scheduleData->day -1) + 7*($scheduleData->week -1));
            $userData->save();
        }
    }
}
