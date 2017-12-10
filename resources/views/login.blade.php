@extends('layouts.default')
@section('container')

    <div class="login">
        <div class="loginBlock">
            <div class="logo"></div>
            <div>
            <h3>Humans VS Zombies</h3>

            <ul>
                <li>Rule 1 : Stay human</li>
                <li>Rule 2 : Don't become a zombie</li>
            </ul>
                <p>Slacked off? Turned into a zombie?<br>Run more to turn human again!</p>
            </div>

        </div>
        <div id="infoZombie"></div>
        <h3>Now login and start running!</h3>
            <a class="btn btn-primary loginBtn" href="https://www.strava.com/oauth/authorize?client_id={{$client_id}}&response_type=code&redirect_uri={{$redirect_uri}}/token_exchange&approval_prompt=auto">Log in met strava!</a>
        <h4>or checkout the hall of fame  <a class="btn btn-primary" href="/hall-of-fame"><i class="fa fa-trophy fa-2x" aria-hidden="true"></i></a> </h4>

    </div>
@endsection