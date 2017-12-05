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

    public function currentActivities()
    {
        $start_week = Carbon::now()->startOfWeek();
        $end_week = Carbon::now()->startOfWeek()->addDays(6);
        return $this->activities->where('start_date', '>=', $start_week)->where('start_date', '<=', $end_week)->get();
    }

    public function runThisWeek()
    {
        $start_week = Carbon::now()->startOfWeek();
        $end_week = Carbon::now()->startOfWeek()->addDays(6);
        return number_format($this->activities->where('start_date', '>=', $start_week)->where('start_date', '<=', $end_week)->sum('distance') / 1000, 1, ",", ".");
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function currentSchedule()
    {
        return $this->userScheduleDetail()->where('week', Carbon::now()->startOfWeek()->format('Y-m-d'))->first();
    }

    public function createDetails($start_date, $km_per_week, $i)
    {
        $userScheduleDetail = new UserScheduleDetail();
        $userScheduleDetail->user_id = Auth::id();
        $userScheduleDetail->week_count = $i;
        $userScheduleDetail->week = Carbon::parse($start_date)->addweeks($i - 1);
        $userScheduleDetail->km_this_week = $km_per_week * $i;
        $userScheduleDetail->km_this_week_modified = $km_per_week * $i;

        if ($i == 1) {
            $userScheduleDetail->modified_marker = true;
        } else {
            $userScheduleDetail->modified_marker = false;
        }

        $userScheduleDetail->save();
    }


    public function userScheduleDetail()
    {
        return $this->hasMany(UserScheduleDetail::class);
    }


    public function updateScheduleDetails()
    {
        $details = $this->userScheduleDetail()->count();
        if ($details != 0) {
            $start_date_current_week = Carbon::now()->startOfWeek()->format('Y-m-d');

            // is verleden week al gecheckt?
            if ($this->currentSchedule()->modified_marker == 0) {
                $start_last_week = Carbon::now()->startOfWeek()->subWeek();
                $end_last_week = Carbon::now()->startOfWeek()->subDay();
                $last_week_schedule_detail = $this->userScheduleDetail()->where('week', $start_last_week->format('Y-m-d'))->first();

                // we checken de stand van zaken van afgelopen week, want dat is nog niet gebeurd
                if ($last_week_schedule_detail != null) {
                    // bereken totale afstand alle activiteiten verleden week
                    $total_last_week = $this->activities()->where('start_date', '>=', $start_last_week)->where('start_date', '<=', $end_last_week)->sum('distance');
                    // haal de scheduled afstand van verleden week op
                    $scheduled_last_week = $last_week_schedule_detail->km_this_week_modified;

                    // bereken het verschil tussen beiden. indien negatief: overschrijf de km_this_week_modified van deze week
                    if ($total_last_week - $scheduled_last_week < 0) {
                        $current_schedule_detail = $this->userScheduleDetail()->where('week', $start_date_current_week)->first();
                        $current_schedule_detail->km_this_week_modified *= 1.2;
                        $this->zombie = 1;
                        $last_week_schedule_detail->goal_status = "fail";
                    } else {
                        $current_schedule_detail = $this->userScheduleDetail()->where('week', $start_date_current_week)->first();
                        $this->zombie = 0;
                        $last_week_schedule_detail->goal_status = "success";
                    };
                    $current_schedule_detail->modified_marker = 1;
                    $current_schedule_detail->save();
                    $last_week_schedule_detail->save();
                }
            }
        }
    }
}
