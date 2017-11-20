@extends('layouts.default')
@section('container')
    <div class="wrap">
        <div><a class="btn btn-primary" href="menu">MENU</a></div>
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

    <!--
<p>Your selected running schedule is {{ $user->schedule_id }}.</p>
-->
        <p>Your selected running schedule is {{ $user->schedule->name }}.</p>
       

        <a class="btn btn-primary" href="activities">Go to activities</a>
    </div>
@endsection
