@extends('layouts.default')
@section('container')
    <div class="wrap">
        @include('includes.menu')
        <div class="userProfile">
            <img class="userImg" src="{{ $user->profile }}" alt="profile picture">

            <h1>{{ $user->firstname }} {{$user->lastname}}</h1>

            <div class="message">
                <p>{{ $this_weeks_message }}</p>
            </div>
        </div>

        <h3>your progress</h3>

        <ul class="progress_bar">

            <!--  dit wordt nog een foreach  -->

            <li class="progress_bar_item progress_bar_item_past_success"><p>week 1</p></li>
            <li class="progress_bar_item progress_bar_item_past_fail"><p>week 2</p></li>
            <li class="progress_bar_item progress_bar_item_current"><p>week 3</p></li>
            <li class="progress_bar_item progress_bar_item_future"><p>week 4</p></li>
            <li class="progress_bar_item progress_bar_item_future"><p>week 5</p></li>

        </ul>

        <div class="progress_bar_legend">

            <h4 class="progress_bar_legend_title">Legend</h4>

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

        <div class="bodyHome">

            <div class="humanStatus status">
                <h2>You are a {{$user->zombie?"Zombie":"Human"}} all is safe!</h2>
                <h3>Keep up the good work</h3>
            </div>

            <div class="kmStatus status">
                <h2>Your goal this week</h2>
                <h3>Run {{ $currentGoal-> km_this_week }} Km</h3>
            </div>



        {{--< <div id="badges">
             <p>No badges yet , start running to earn some!</p>
             <ul>
                 <li></li>
                 <li></li>
                 <li></li>
                 <li></li>
                 <li></li>
             </ul>
         </div>>--}}

         {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}

    <!--
<p>Your selected running schedule is {{ $user->schedule_id }}.</p>
-->
        <div class="selected status">
        <p>Your selected running schedule is {{ $user->schedule->name }}.</p>

        <a class="btn btn-primary" href="schedule">Go to your schedule</a>
        </div>
        </div>
    </div>
@endsection
