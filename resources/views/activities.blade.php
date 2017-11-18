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
                    <p class="schedule_week_dates">{{ Carbon\Carbon::parse($detail->week)->format('d/m/Y') }} - {{Carbon\Carbon::parse($detail->week)->addDays(6)->format('d/m/Y') }}</p>
                    <p class="schedule_week_goal">{{$detail->km_this_week}}km</p>
                    <p class="schedule_week_success">Goal reached! / Goal not reached</p>

                    <ul class="activity_list">
                        @forelse ($activities as $activity)
                            @if($activity->start_date >= $detail->week AND $activity->start_date <= Carbon\Carbon::parse($detail->week)->addDays(6))
                                <li>
                                    <p class="activity_date">{{ Carbon\Carbon::parse($activity->start_date)->format('d/m/Y') }}</p>
                                    <p class="activity_distance">{{ number_format($activity->distance / 1000, 1, ",", ".") }}km
                                        done!</p>
                                </li>
                            @endif

                        @empty
                            <li>You don't have any activities yet this week. Start running or zombies will eat your brains!</li>
                        @endforelse
                    </ul>

                </li>
            @endforeach
        </ul>
<div>
@endsection

