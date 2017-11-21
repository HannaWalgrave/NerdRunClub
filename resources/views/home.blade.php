@extends('layouts.default')
@section('container')
    <div class="wrap">
        @include('includes.menu')
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

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <canvas id="myGraph" width="400" height="400"></canvas>
    <!--
<p>Your selected running schedule is {{ $user->schedule_id }}.</p>
-->
        <p>Your selected running schedule is {{ $user->schedule->name }}.</p>
       

        <a class="btn btn-primary" href="activities">Go to activities</a>
    </div>
@endsection
