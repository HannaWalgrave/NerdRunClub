@extends('layouts.default')
@section('container')
    <div class="wrap">

        <h1>Hall of fame</h1>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                @foreach($schedules as $schedule)
                    <li class="breadcrumb-item all"><a href="/hall-of-fame/{!! str_replace(' ', '-', $schedule->name) !!}">{{ $schedule->name }}</a></li>
                @endforeach
            </ol>
        </nav>

        @forelse($users as $user)
            <img src="{{$user->profile}}" alt="{{ $user->firstname }} {{ $user->lastname }}"><p>{{ $user->firstname }}  {{ $user->lastname }}</p>
            <p>{{ $user->distance/1000 }} km</p>
        @empty
            <p>Nobody has run this week :( Y'all becoming zombies!</p>
        @endforelse
    </div>
@endsection