@extends('layouts.default')
@section('container')
    <div class="menu-top">
        <a class="btn HomeButton" href="/"><i class="fa fa-home fa-2x" aria-hidden="true"></i> <br>Home</a>
    </div>
    <div class="wrap">

        <h1>Hall of fame</h1>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                @foreach($schedules as $schedule)
                    <li class="breadcrumb-item all"><a class="btn btn-primary" href="/hall-of-fame/{!! str_replace(' ', '-', $schedule->name) !!}">{{ $schedule->name }}</a></li>
                @endforeach
            </ol>
        </nav>

        <div class="hall-of-fame">
            @forelse($users as $user)
                <div class="Fame_user">
                    <img src="{{ $user->profile == "avatar/athlete/large.png" ? asset('img/human.svg') : $user->profile   }}" alt="{{ $user->firstname }} {{ $user->lastname }}"><p>{{ $user->firstname }}  {{ $user->lastname }}</p>
                    <p>{{ $user->totalDistance }} km</p>
                </div>
            @empty
                <p>Nobody has run this week :( Y'all becoming zombies!</p>
            @endforelse
        </div>

    </div>
@endsection