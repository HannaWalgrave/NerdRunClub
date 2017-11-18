@extends('layouts.default')
@section('container')
    <div>
<h1>Activities</h1>

<!--
UITLEG:
Een forelse loop is hetzelfde als een foreach loop met als verschil dat je er een empty functie in kunt steken.
Deze wordt uitgevoerd indien er niets te loopen valt (dus als er nog geen activities zijn in dit geval)
 -->

        <ul>
            @foreach($user->userScheduleDetail as $detail)
                <li>
                    <p class="schedule_week_count">week {{$detail->week_count}}</p>
                    <p class="schedule_week_dates">dates komen hier</p>
                    <p class="schedule_week_goal">{{$detail->km_this_week}}km</p>
                    <p class="schedule_week_success">Goal reached! / Goal not reached</p>
                </li>
            @endforeach
        </ul>

        <ul class="activity_list">
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


@endsection

