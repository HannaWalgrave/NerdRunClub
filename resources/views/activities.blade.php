@extends('layouts.default')
@section('container')
    <div>
<h1>Activities</h1>

<p>Hi {{ $user->firstname }} these are your activities!</p>

<!--
UITLEG:
Een forelse loop is hetzelfde als een foreach loop met als verschil dat je er een empty functie in kunt steken.
Deze wordt uitgevoerd indien er niets te loopen valt (dus als er nog geen activities zijn in dit geval)
 -->

        <ul>
            @forelse ($activities as $activity)
                <li>
                    <p class="activity_date">{{Carbon\Carbon::parse($activity->start_date)->format('d/m/Y') }}</p>
                    <p class="activity_distance">{{ number_format($activity->distance / 1000, 1, ",", ".") }}km
                        done!</p>

                </li>

            @empty
                <li>You don't have any activities yet. Start running or zombies will eat your brains!</li>
            @endforelse
        </ul>
@forelse ($activities as $activity)
    <p>This is activity {{ $activity->id }}, in which you ran {{ $activity->distance }} meters on {{Carbon\Carbon::parse($activity->start_date)->format('d/m/Y') }}.</p>

@empty
    <p>You don't have any activities yet. Start running or zombies will eat your brains!</p>
@endforelse

@endsection

