@extends('layouts.default')
@section('container')
    @include('includes.menu')
    <div class="wrap {{$user->zombie?"ZombieWrap":"Human"}}">
        <div class="graph1">
            <h2>your goal this week</h2>
        <canvas id="myGraph" width="400" height="400"></canvas>
        </div>

        <div class="graph2">
            <h2>Humans Vs Zombies</h2>
            <canvas id="GraphZombievsHuman" width="400" height="400"></canvas>
        </div>
    </div>
    @endsection