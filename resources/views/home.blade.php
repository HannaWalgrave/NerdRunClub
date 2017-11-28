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
