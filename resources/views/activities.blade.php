@extends('layouts.default')
@section('container')
    <div>
<h1>Activities</h1>

<p>Hi {{ $user->firstname }}, who has id {{ $user->id }}, these are your activities!</p>

<!--
UITLEG:
Een forelse loop is hetzelfde als een foreach loop met als verschil dat je er een empty functie in kunt steken.
Deze wordt uitgevoerd indien er niets te loopen valt (dus als er nog geen activities zijn in dit geval)
 -->

@forelse ($activities as $activity)
    <p>This is activity {{ $activity->id }}, in which you ran {{ $activity->distance }} meters on {{

     Carbon\Carbon::parse($activity->start_date)->format('d/m/Y') }}.</p>
@endforeach
    </div>
@endsection

     Carbon\Carbon::parse($activity->start_date)->format('d/m/Y') }}.
@empty
    <p>You don't have any activities yet. Start running or zombies will eat your brains!</p>
@endforelse

