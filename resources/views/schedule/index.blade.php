@extends('layouts.default')

@section('container')
    <div class="wrap  {{$user->zombie?"ZombieWrap":"Human"}}" xmlns:v-on="http://www.w3.org/1999/xhtml">
        @include('includes.menu')
        <div class="scheduleBody">
        <h1>Your schedule</h1>
            <p>Your selected running schedule is {{ $user->schedule->name }}.</p>
            <a class="btn btn-primary {{$user->zombie?"zombiebtn":""}}" href="/deleteUserSchedule">Change your running schedule</a>

            <ul class="scheduleList">

            @foreach($pastGoals as $detail)
                <li class="pastGoals showActivities"  id="{{$detail->id}}" {{$detail->goal_status=="success"?"style=background-color:green;
                ":"style=background-color:red;"}}>
                    <div>
                        <p class="schedule_week_count">week {{$detail->week_count}}</p>
                        <p class="schedule_week_dates">
                            {{ Carbon\Carbon::parse($detail->week)->format('d/m/Y') }}
                            - {{Carbon\Carbon::parse($detail->week)->addDays(6)->format('d/m/Y') }}
                        </p>
                    </div>
                    <p class="schedule_week_goal">{{$detail->km_this_week_modified}}km</p>
                    <ul class="activity_list" style="width:100%;"></ul>
                </li>

            @endforeach

            @unless($currentGoal == null)
                <li class="currentGoal showActivities" id="{{$currentGoal->id}}">
                    <div>
                        <p class="schedule_week_count">This week</p>
                    </div>
                    <p class="schedule_week_goal">Already run: {{ $user->runThisWeek() }}km - Goal: {{$currentGoal->km_this_week_modified}}km</p>
                    <ul class="activity_list" style="width:100%;"></ul>
                </li>
            @endunless

            @foreach($nextGoals as $detail)
                <li class="nextGoals">
                    <div>
                        @if(Carbon\Carbon::parse($detail->week)->format('d/m/Y') == Carbon\Carbon::now()->startOfWeek()->addWeek()->format('d/m/Y'))
                            <p class="schedule_week_count">Next week</p>
                        @else
                            <p class="schedule_week_count">week {{$detail->week_count}}</p>
                            <p class="schedule_week_dates">
                                {{ Carbon\Carbon::parse($detail->week)->format('d/m/Y') }}
                                - {{Carbon\Carbon::parse($detail->week)->addDays(6)->format('d/m/Y') }}
                            </p>
                        @endif
                    </div>

                    <p class="schedule_week_goal">{{$detail->km_this_week_modified}}km</p>
                </li>
            @endforeach
        </ul>
        </div>
        </div>
            @endsection

            @section('footerscripts')
                <script src='app.js'></script>
@endsection
