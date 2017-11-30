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
        $userScheduleDetail->week = Carbon::parse($start_date)->addweeks($i - 1);
        $userScheduleDetail->km_this_week = $km_per_week * $i;
        $userScheduleDetail->km_this_week_modified = $km_per_week * $i;

        if($i == 1) {
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
            $detail_this_week_modified = $this->userScheduleDetail()->where('week', $start_date_current_week)->first()->modified_marker;

            // is verleden week al gecheckt?
            if ($detail_this_week_modified == 0) {
                // we checken de stand van zaken van afgelopen week, want dat is nog niet gebeurd

                // bereken totale afstand alle activiteiten verleden week
                $start_last_week = Carbon::now()->startOfWeek()->subWeek();
                //dd($start_last_week);
                $end_last_week = Carbon::now()->startOfWeek()->subDay();
                $total_last_week = $this->activities()->where('start_date', '>=', $start_last_week)->where('start_date', '<=', $end_last_week)->sum('distance');

                if ($this->userScheduleDetail()->where('week', $start_last_week->format('Y-m-d'))->first() != null) {
                    // haal de scheduled afstand van verleden week op
                    $scheduled_last_week = $this->userScheduleDetail()->where('week', $start_last_week->format('Y-m-d'))->first()->km_this_week_modified;

                    // bereken het verschil tussen beiden
                    $last_week_schedule_vs_activity = $total_last_week - $scheduled_last_week;

                    // indien negatief: overschrijf de km_this_week_modified van deze week
                    if ($last_week_schedule_vs_activity < 0) {
                        $current_schedule_detail = $this->userScheduleDetail()->where('week', $start_date_current_week)->first();
                        $current_schedule_detail->km_this_week_modified = $current_schedule_detail->km_this_week_modified * 1.2;
                        $current_schedule_detail->modified_marker = 1;
                        $current_schedule_detail->message = "You did not reach last week's goal, so you will have to run more in order to become human again!";
                        $current_schedule_detail->save();

                        $last_week_schedule_detail = $this->userScheduleDetail()->where('week', $start_last_week->format('Y-m-d'))->first();
                        $last_week_schedule_detail->goal_status = "fail";
                        $last_week_schedule_detail->save();

                    } else {
                        $current_schedule_detail = $this->userScheduleDetail()->where('week', $start_date_current_week)->first();
                        $current_schedule_detail->modified_marker = 1;
                        $current_schedule_detail->message = "You managed to reach last week's goal, oh human! Keep going & make sure not to turn into a zombie!";
                        $current_schedule_detail->save();

                        $last_week_schedule_detail = $this->userScheduleDetail()->where('week', $start_last_week->format('Y-m-d'))->first();
                        $last_week_schedule_detail->goal_status = "success";
                        $last_week_schedule_detail->save();
                    };

                }


            } /*else {
                // hier doen we niets, want deze week werd de stand van zaken over verleden week al gecheckt
            };*/
        }
    }

}
