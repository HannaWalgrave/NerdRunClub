@extends('layouts.default')
@section('container')
    <div class="scheduleWrap">
        @include('includes.menu')
        <div class="scheduleText">

            <h1>Hello {{ $user->firstname }}! Ready to run?</h1>
            <h4>To get your running schedule please select one below.</h4>
        </div>
        <form method="post" class="calender" action="/schedule">

            {{ csrf_field() }}

            <title>Select A Running Schedule</title>


            <select name="schedule">
                @forelse ($schedules as $schedule)

                    <option value="{{ $schedule->id }}" name="schedule_option">{{ $schedule->name }}</option>

                @empty
                    <option value="choice">No schedules are available.</option>
                @endforelse
            </select>

            <button class="btn btn-primary" type="submit">Let's run!</button>

        </form>
    </div>

@endsection
@section('footerscripts')
    <script>
        $(function () {
            $("#datepicker").datepicker({
                onSelect: function (date) {
                    $('.dateValue').val(date);
                }
            });
        });

    </script>
@endsection