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
        return $this->hasMany(Activity::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }


    public function user_schedule()
    {
        return $this->belongsTo(UserSchedule::class);
    }

}
