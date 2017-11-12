@extends('layouts.default')
@section('container')
    <div class="scheduleWrap">

<!--  check whether user already has a running schedule. If yes, use it. If no, let user select from available
schedules  -->
@if ($user->schedule == null)

<h1>Hello {{ $user->firstname }}! Choose your schedule</h1>
    <form method="post" class="calender">

        {{ csrf_field() }}

        <title>Select A Running Schedule</title>


        <select name="schedule">
            @forelse ($schedules as $schedule)

                <option value="{{ $schedule->id }}">{{ $schedule->name }}</option>

            @empty
                <option value="choice">No schedules are available.</option>
            @endforelse
        </select>

        <h2>Select a start or end date</h2>
        <select name="date">
            <option value="start">start date</option>
            <option value="end">end date</option>
        </select>

        <div id="datepicker"></div>
        <input type="hidden" class="dateValue" name="dateValue">

        <button class="btn btn-primary" type="submit">Let's run!</button>

    </form>

@else

    <p>You are participating in running schedule {{ $user->schedule->name }}, congratulations!</p>

@endif
    </div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
        $("#datepicker").datepicker({
            onSelect: function(date) {
                $('.dateValue').val(date);
            }
        });
    } );

</script>
@endsection