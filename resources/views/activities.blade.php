@extends('layouts.default')

@section('container')
    <div>
        @include('includes.menu')
<h1>Activities</h1>

<!--
UITLEG:
Een forelse loop is hetzelfde als een foreach loop met als verschil dat je er een empty functie in kunt steken.
Deze wordt uitgevoerd indien er niets te loopen valt (dus als er nog geen activities zijn in dit geval)
 -->

<!--
We loopen voor de ingelogde user z'n schedule details per week uit en tonen deze. We tonen ook of het doel voor die
week reeds bereikt werd of nog moet gehaald worden, en dat de week in de toekomst ligt indien van toepassing.
Daaronder staat, indien van toepassing, dan een lijst met de afgelegde activiteiten van die week, met afstand en datum.
 -->

        <ul>

            @foreach($user->userScheduleDetail as $detail)

                <li>
                    <p class="schedule_week_count">week {{$detail->week_count}}</p>
                    <p class="schedule_week_dates">{{ Carbon\Carbon::parse($detail->week)->format('d/m/Y') }} - {{Carbon\Carbon::parse($detail->week)->addDays(6)->format('d/m/Y') }}</p>
                    <p class="schedule_week_goal">{{$detail->km_this_week}}km</p>
                    <p class="schedule_week_success">
                        @if($detail->week > Carbon\Carbon::now())
                            Week still to come
                        @elseif($activities->where('start_date', '>', $detail->week)->where('start_date', '<', Carbon\Carbon::parse($detail->week)->addDays(6))->sum('distance') / 1000 > $detail->km_this_week)
                            Goal reached!
                        @else
                            Goal not reached
                        @endif
                    </p>

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

