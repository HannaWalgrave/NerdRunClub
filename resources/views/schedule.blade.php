<h1>Choose or make a training schedule</h1>

<p>Hello user {{ $user->firstname }}!</p>

@if ($schedule == 0)

    <p>You still have to select a running schedule to participate in. Please select one from the list.</p>

@else

    <p>You are participating in running schedule {{ $schedule }}, congratulations!</p>

@endif