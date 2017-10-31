<h1>Choose or make a training schedule</h1>

<p>Hello user {{ $user->firstname }}!</p>

@if ($schedule == 0)

    <p>You still have to select a running schedule to participate in. Please select one from the list.</p>

    <form>
        <title>Select A Running Schedule</title>

        <select>
            @forelse ($allSchedules as $schedule)

                <option value="{{ $schedule->id }}">{{ $schedule->name }}</option>

            @empty
                <option value="geen">No schedules are available.</option>
            @endforelse

        </select>

    </form>

@else

    <p>You are participating in running schedule {{ $schedule }}, congratulations!</p>

@endif