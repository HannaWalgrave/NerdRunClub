@extends('layouts.default')
@section('container')
    <div class="wrap {{$user->zombie?"ZombieWrap":"Human"}}">
        @include('includes.menu')
        <div class="background {{$user->zombie?"backgroundZombie":"Human"}} ">
            <div class="bodyHome">
                <div class="backgroundImg {{ $user->zombie ? "zombie" : "human" }}"></div>
                <div class="humanStatus status {{$user->zombie?"glitch":"Human"}}">
                    <h2>You are a {{$user->zombie?"Zombie":"Human"}} </h2>
                    <h3>{{$user->zombie?"Start running faster!":"Keep up the good work!"}}</h3>
                </div>
                <div class="kmStatus status {{$user->zombie?"glitch":"Human"}}">
                    <h3>You still have {{$days_until_goal}} days to go! <br> You are in week {{$weeks_until_goal}}.
                    </h3>
                </div>

                <div class="progressBar">
                    <div class="kmStatus status {{$user->zombie?"glitch":"Human"}}">
                        @if($user->currentSchedule() )
                            @if($user->currentSchedule()->goal_status == "to do")
                                <h3>Your goal this week: <br>
                                    Run {{ $user->currentSchedule()->km_this_week_modified }} Km</h3>
                            @else
                                <h3>Congratulations! <br> You have reached your weekly goal!</h3>
                            @endif
                        @else
                            <h3>Relax, take it easy! You don't have to run this week!</h3>
                        @endif
                    </div>

                    <ul class="progress_bar">
                        @foreach($user->userScheduleDetail as $schedule_detail)

                            @if($schedule_detail->modified_marker == false)
                                <li class="progress_bar_item progress_bar_item_future">
                                    <p>{{$schedule_detail->week_count}}</p>
                                </li>

                            @elseif($schedule_detail->week_count == $user->currentSchedule()->week_count)
                                @if($schedule_detail->goal_status == "to do")
                                    <li class="progress_bar_item progress_bar_item_current">
                                        <p>{{$schedule_detail->week_count}}</p>
                                    </li>
                                @else
                                    <li class="progress_bar_item progress_bar_item_current progress_bar_item_past_success">
                                        <p>{{$schedule_detail->week_count}}</p>
                                    </li>
                                @endif

                            @elseif($schedule_detail->goal_status == "success")
                                <li class="progress_bar_item progress_bar_item_past_success">
                                    <p>{{$schedule_detail->week_count}}</p>
                                </li>
                            @elseif($schedule_detail->goal_status == "fail")
                                <li class="progress_bar_item progress_bar_item_past_fail">
                                    <p>{{$schedule_detail->week_count}}</p>
                                </li>
                            @endif
                        @endforeach

                    </ul>

                    <div class="progress_bar_legend">

                        <div class="progress_bar_legend_items">
                            <div class="progress_bar_legend_item">
                                <p class="progress_bar_legend_color progress_bar_legend_color_success"></p>
                                <p class="progress_bar_legend_text">goal reached</p>
                            </div>

                            <div class="progress_bar_legend_item">
                                <p class="progress_bar_legend_color progress_bar_legend_color_fail"></p>
                                <p class="progress_bar_legend_text">goal not reached</p>
                            </div>

                            <div class="progress_bar_legend_item">
                                <p class="progress_bar_legend_color progress_bar_legend_color_current"></p>
                                <p class="progress_bar_legend_text">current week</p>
                            </div>

                            <div class="progress_bar_legend_item">
                                <p class="progress_bar_legend_color progress_bar_legend_color_future"></p>
                                <p class="progress_bar_legend_text">still to come</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
