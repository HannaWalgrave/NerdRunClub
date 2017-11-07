@extends('layouts.default')
@section('container')
    <div class="wrap">
        <div><a href="">MENU</a>  </div>
        <div class="userProfile">
        <img class="userImg" src="{{ $user->profile }}" alt="profile picture">

        <h1>{{ $user->firstname }} {{$user->lastname}}</h1>
        </div>

        <div id="badges">
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
        <p>Here is your schedule:</p>
        <ul>
            @foreach($user->userData as $data)
                <li>{{$data->date}}</li>
            @endforeach
        </ul>



        <a href="activities">Go to activities</a>
    </div>
@endsection
