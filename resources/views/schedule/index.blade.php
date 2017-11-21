@extends('layouts.default')

@section('container')
    <div>
        @include('includes.menu')
        <h1>Your schedule</h1>
        <ul>
            @foreach($pastGoals as $detail)
                <li style="margin: 10px 0; list-style-type: none; background:#FE8E44; color:#fff; display:flex; flex-wrap:wrap;">
                    <p class="schedule_week_count">week {{$detail->week_count}}</p>
                    <p class="schedule_week_dates">
                        {{ Carbon\Carbon::parse($detail->week)->format('d/m/Y') }}
                        - {{Carbon\Carbon::parse($detail->week)->addDays(6)->format('d/m/Y') }}
                    </p>
                    <p class="schedule_week_goal">{{$detail->km_this_week_modified}}km</p>
                </li>
            @endforeach

            <li style="margin: 10px 0; list-style-type: none; background:#FE5C11; color:#fff; display:flex; flex-wrap:wrap;">
                <p class="schedule_week_count">This week</p>
                <p class="schedule_week_dates">
                    {{ Carbon\Carbon::parse($currentGoal->week)->format('d/m/Y') }}
                    - {{Carbon\Carbon::parse($currentGoal->week)->addDays(6)->format('d/m/Y') }}
                </p>
                <p class="schedule_week_goal">{{$currentGoal->km_this_week_modified}}km</p>


            </li>

            @foreach($nextGoals as $detail)
                <li style="margin: 10px 0; list-style-type: none; background:#FE8E44; color:#fff; display:flex; flex-wrap:wrap;">
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