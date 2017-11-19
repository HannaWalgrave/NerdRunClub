@extends('layouts.default')
@section('container')
    <div class="wrap">
        <div><a href="menu">MENU</a></div>
        <div class="userProfile">
            <img class="userImg" src="{{ $user->profile }}" alt="profile picture">

            <h1>{{ $user->firstname }} {{$user->lastname}}</h1>
        </div>

        <div id="badges">
            <p>No badges yet , start running to earn some!</p>
            <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
<canvas id="myGraph">

</canvas>
    <!--
<p>Your selected running schedule is {{ $user->schedule_id }}.</p>
-->
        <p>Your selected running schedule is {{ $user->schedule->name }}.</p>
        <p>Here is your schedule:</p>

        <ul>
            @foreach($user->userScheduleDetail as $detail)
                <li>week {{$detail->week_count}}: {{$detail->km_this_week}}km</li>
            @endforeach
        </ul>



        <a href="activities">Go to activities</a>
    </div>
@endsection
