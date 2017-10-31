<h1>Choose a training schedule</h1>

<p>Hello user {{ $user->firstname }}!</p>

<!--  check whether user already has a running schedule. If yes, use it. If no, let user select from available
schedules  -->

@if ($schedule == 0)

    <p>You still have to select a running schedule to participate in. Please select one from the list.</p>

    <form method="post">

        {{ csrf_field() }}

        <title>Select A Running Schedule</title>

        <select>
            @forelse ($allSchedules as $schedule)

                <option value="{{ $schedule->id }}">{{ $schedule->name }}</option>

            @empty
                <option value="choice">No schedules are available.</option>
            @endforelse

        </select>

        <button type="submit">Select this running schedule!</button>

    </form>

@else

    <p>You are participating in running schedule {{ $schedule }}, congratulations!</p>

@endif

