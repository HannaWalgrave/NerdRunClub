@extends('layouts.default')
@section('container')

    <div class="vertical">
        <img src="img/logo_test1.jpg" id="login_logo">
            <a class="btn btn-primary login" href="https://www.strava.com/oauth/authorize?client_id={{$client_id}}&response_type=code&redirect_uri={{$redirect_uri}}/token_exchange&approval_prompt=force">Log in met strava!</a>
    </div>
@endsection