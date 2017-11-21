@extends('layouts.default')

@section('container')
    <div>
        @include('includes.menu')
        <h1>Your schedule</h1>
        <ul class="scheduleList" style="padding:0;">
            @foreach($pastGoals as $detail)
                <li class="pastGoals"
                    style="width: 100%; margin: 10px 0; padding: 10px; list-style-type: none; background:#FE8E44; color:#fff; display:flex; flex-wrap:wrap; justify-content: space-between;">
                    <div>
                        <p class="schedule_week_count">week {{$detail->week_count}}</p>
                        <p class="schedule_week_dates">
                            {{ Carbon\Carbon::parse($detail->week)->format('d/m/Y') }}
                            - {{Carbon\Carbon::parse($detail->week)->addDays(6)->format('d/m/Y') }}
                        </p>
                    </div>

                    <p class="schedule_week_goal">{{$detail->km_this_week_modified}}km</p>
                </li>
            @endforeach

            <li class="currentGoal" id="{{$currentGoal->id}}"
                style="width: 100%; margin: 10px 0; padding: 10px; list-style-type: none; background:#FE5C11; color:#fff; display:flex; flex-wrap:wrap; justify-content: space-between;">
                <div>
                    <p class="schedule_week_count">This week</p>
                </div>

                <p class="schedule_week_goal">{{$currentGoal->km_this_week_modified}}km</p>


            </li>

            @foreach($nextGoals as $detail)
                <li class="nextGoals"
                    style="width: 100%; margin: 10px 0; padding: 10px; list-style-type: none; background:#FE8E44; color:#fff; display:flex; flex-wrap:wrap; justify-content: space-between;">
                    <div>
                        @if(Carbon\Carbon::parse($detail->week)->format('d/m/Y') == Carbon\Carbon::parse($currentGoal->week)->addWeek()->format('d/m/Y'))
                            <p class="schedule_week_count">Next week</p>
                        @else
                            <p class="schedule_week_count">week {{$detail->week_count}}</p>
                            <p class="schedule_week_dates">
                                {{ Carbon\Carbon::parse($detail->week)->format('d/m/Y') }}
                                - {{Carbon\Carbon::parse($detail->week)->addDays(6)->format('d/m/Y') }}
                            </p>
                        @endif
                    </div>

                    <p class="schedule_week_goal">{{$detail->km_this_week_modified}}km</p>
                </li>
            @endforeach
        </ul>
    <div>
@endsection

@section('footerscripts')
    <script>
        $('.currentGoal').on('click', function(){
            $.get("activities",
                {
                    '_token': '{{csrf_token()}}',
                    'schedule_id': $(this).attr('id')

                }
            ).done(function (data) {
                console.log(data);
            })
        })
    </script>
@endsection
