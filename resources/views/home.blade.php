@extends('layouts.default')
@section('container')
    <div class="wrap {{$user->zombie?"ZombieWrap":"Human"}}">
        @include('includes.menu')
        <div class="background {{$user->zombie?"backgroundZombie":"Human"}} ">
            <div class="userProfile {{$user->zombie?"glitch":"Human"}}">
                <img class="userImg" src="{{ $user->profile }}" alt="profile picture">

                <h1>{{ $user->firstname }} {{$user->lastname}}</h1>
            </div>

            <div class="message {{$user->zombie?"glitch":"Human"}}">
                <p>{{ $this_weeks_message }}</p>
                <p>Your selected running schedule is {{ $user->schedule->name }}.</p>
            </div>

            <div>
                <a href="/deleteUserSchedule">Change your running schedule</a>
            </div>

            <div class="bodyHome">
                <div class="backgroundImg {{ $user->zombie ? "zombie" : "human" }}"></div>
                <div class="humanStatus status {{$user->zombie?"glitch":"Human"}}">
                    <h2>You are a {{$user->zombie?"Zombie":"Human"}} </h2>
                    <h3>{{$user->zombie?"Start running faster!":"Keep up the good work!"}}</h3>
                </div>

                <div class="kmStatus status {{$user->zombie?"glitch":"Human"}}">
                    @if($user->currentSchedule() )
                        <h2>Your goal this week</h2>
                        <h3>Run {{ $user->currentSchedule()->km_this_week_modified }} Km</h3>
                    @else
                        <h2>Relax, take it easy! You don't have to run this week!</h2>
                    @endif
                </div>
                <div class="progressBar">
                    <h3>your progress</h3>

                    <ul class="progress_bar">
                        @foreach($user->userScheduleDetail as $schedule_detail)

                            @if($schedule_detail->modified_marker == false)
                                <li class="progress_bar_item progress_bar_item_future">
                                    <p>week {{$schedule_detail->week_count}}</p>
                                </li>
                            @elseif($schedule_detail->goal_status == "to do" && $user->currentSchedule() == null)
                                <li class="progress_bar_item progress_bar_item_future">
                                    <p>week {{$schedule_detail->week_count}}</p>
                                </li>
                            @elseif($schedule_detail->goal_status == "to do" && $user->currentSchedule() != null)
                                <li class="progress_bar_item progress_bar_item_current">
                                    <p>week {{$schedule_detail->week_count}}</p>
                                </li>
                            @elseif($schedule_detail->goal_status == "success")
                                <li class="progress_bar_item progress_bar_item_past_success">
                                    <p>week {{$schedule_detail->week_count}}</p>
                                </li>
                            @elseif($schedule_detail->goal_status == "fail")
                                <li class="progress_bar_item progress_bar_item_past_fail">
                                    <p>week {{$schedule_detail->week_count}}</p>
                                </li>
                            @endif

                        @endforeach

                    </ul>

                    <div class="progress_bar_legend">

                        <h4 class="progress_bar_legend_title">Legend</h4>
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


        </div>
    </div>

    </div>
@endsection
