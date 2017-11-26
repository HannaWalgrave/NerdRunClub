@extends('layouts.default')

@section('container')
    <div class="wrap">
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

            @unless($currentGoal == null)
                <li class="currentGoal" id="{{$currentGoal->id}}"
                    style="width: 100%; margin: 10px 0; padding: 10px; list-style-type: none; background:#FE5C11; color:#fff; display:flex; flex-wrap:wrap; justify-content: space-between;">
                    <div>
                        <p class="schedule_week_count">This week</p>
                    </div>
                    <p class="schedule_week_goal">{{$currentGoal->km_this_week_modified}}km</p>
                    <ul class="activity_list" style="width:100%;"></ul>
                </li>
            @endunless

            @foreach($nextGoals as $detail)
                <li class="nextGoals"
                    style="width: 100%; margin: 10px 0; padding: 10px; list-style-type: none; background:#FE8E44; color:#fff; display:flex; flex-wrap:wrap; justify-content: space-between;">
                    <div>
                        @if(Carbon\Carbon::parse($detail->week)->format('d/m/Y') == Carbon\Carbon::now()->startOfWeek()->addWeek()->format('d/m/Y'))
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
                    $('.currentGoal').on('click', function () {
                        var that = $(this);
                        $.get("activities",
                            {
                                '_token': '{{csrf_token()}}',
                                'schedule_id': $(this).attr('id')

                            }
                        ).done(function (data) {
                            if (data === []) {
                                that.find('ul.activity_list').append("<li style='list-style-type: none;'> You don't have any activities yet this week. Start running or zombies will eat your brains! </li>");
                            } else {
                                that.find('ul.activity_list').append("<li style='list-style-type: none;'><p>Your activities:</p></li>");
                                $.each(data, function (i, value) {
                                    that.find('ul.activity_list').append("<li style='list-style-type: none; display: flex; justify-content: space-around;'><p class='activity_date'>" + value[0] + "</p> <p class='activity_distance'>" + value[1] + " km done!</p></li>");
                                });
                            }
                        })
                    });

                    $('body').on('click', function () {
                        $(this).find('ul.activity_list').children().remove();
                    })
                </script>
@endsection
