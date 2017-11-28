@extends('layouts.default')
@section('container')
    <div class="wrap">
        @include('includes.menu')
        <div class="userProfile">
            <img class="userImg" src="{{ $user->profile }}" alt="profile picture">

            <h1>{{ $user->firstname }} {{$user->lastname}}</h1>
        </div>

        <div class="message">
            <p>{{ $this_weeks_message }}</p>
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
        <p>Your selected running schedule is {{ $user->schedule->name }}.</p>
       

        <a class="btn btn-primary" href="schedule">Go to your schedule</a>
    </div>
@endsection
