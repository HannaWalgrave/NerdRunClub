@extends('layouts.default')

@section('container')
    <div>

        @include('includes.menu')
<h1>Activities</h1>


        <ul>
            <li>
                <p class="schedule_week_count">This week</p>
                <p class="schedule_week_dates">
                    {{ Carbon\Carbon::parse($currentGoal->week)->format('d/m/Y') }}
                    - {{Carbon\Carbon::parse($currentGoal->week)->addDays(6)->format('d/m/Y') }}
                </p>
                <p class="schedule_week_goal">{{$currentGoal->km_this_week_modified}}km</p>
                <p class="schedule_week_success">
                    @if($activities->where('start_date', '>', $currentGoal->week)->where('start_date', '<', Carbon\Carbon::parse($currentGoal->week)->addDays(6))->sum('distance') / 1000 > $currentGoal->km_this_week_modified)
                        Goal reached!
                    @else
                        Goal not reached
                    @endif
                </p>

                <ul class="activity_list">
                    @forelse ($activities as $activity)
                        @if($activity->start_date >= $currentGoal->week AND $activity->start_date <= Carbon\Carbon::parse($currentGoal->week)->addDays(6))
                            <li>
                                <p class="activity_date">
                                    {{ Carbon\Carbon::parse($activity->start_date)->format('d/m/Y') }}
                                </p>
                                <p class="activity_distance">
                                    {{ number_format($activity->distance / 1000, 1, ",", ".") }}km done!
                                </p>
                            </li>
                        @endif
                    @empty
                        <li>
                            You don't have any activities yet this week. Start running or zombies will eat your
                            brains!
                        </li>
                    @endforelse
                </ul>
            </li>

            @foreach($nextGoals as $detail)
                <li style="opacity:0.5">
                    @if(Carbon\Carbon::parse($detail->week)->format('d/m/Y') == Carbon\Carbon::parse($currentGoal->week)->addWeek()->format('d/m/Y'))
                        <p class="schedule_week_count">Next week</p>
                    @else
                        <p class="schedule_week_count">week {{$detail->week_count}}</p>
                        <p class="schedule_week_dates">
                            {{ Carbon\Carbon::parse($detail->week)->format('d/m/Y') }}
                            - {{Carbon\Carbon::parse($detail->week)->addDays(6)->format('d/m/Y') }}
                        </p>
                    @endif
                    <p class="schedule_week_goal">{{$detail->km_this_week_modified}}km</p>
                </li>
            @endforeach
        </ul>
        <div>
@endsection