@extends('layouts.default')
@section('container')
    <div>
<h1>Homepage</h1>

<p>Hello, {{ $user->firstname }}, how are you doing today? I sure hope you feel like running! :-)</p>
<!--
<p>Your selected running schedule is {{ $user->schedule_id }}.</p>
-->
<p>Your selected running schedule is {{ $user->schedule->name }}.</p>

<img width="250px" height="250px" src="{{ $user->profile }}" alt="profile picture">

<a href="activities">Go to activities</a>
    </div>
@endsection
