@extends('layouts.default')
@section('container')

    <div class="vertical login">
        <img src="img/logo_test1.jpg" id="login_logo">

        <div class="login_text"><p>Welcome to <b>Humans vs Zombies</b>! Select a running schedule if you haven't
                yet, and
                run
            like you've never run before!</p>
            <p>If you fail to reach your weekly goal, <b>zombies will eat your brain</b> and you will become a zombie yourself. Afterwards, you will need to run more than originally scheduled to return to being human.</p>
            <p>Your overall goal is to <b>remain human</b> at any time, and to finish your running schedule as
                a human. <b>Don't let the zombies win!</b></p>
        </div>

            <a class="btn btn-primary login" href="https://www.strava.com/oauth/authorize?client_id={{$client_id}}&response_type=code&redirect_uri={{$redirect_uri}}/token_exchange&approval_prompt=auto">Log in met strava!</a>
    </div>
@endsection