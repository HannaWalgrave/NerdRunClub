<div class="menu-top {{ $user->zombie ? "zombie" : "human" }}">
    <img class="userImg" src="{{ $user->profile == "avatar/athlete/large.png" ? asset('img/human.svg') : $user->profile  }}" alt="profile picture">
    <a class="btn HomeButton" href="/"><i class="fa fa-home fa-2x" aria-hidden="true"></i> <br>Home</a>
    <a class="btn activityButton" href="/schedule"><i class="fa fa-calendar fa-2x" aria-hidden="true"></i> <br>Schedule</a>
    <a class="btn dashButton" href="/dashboard"><i class="fa fa-bar-chart fa-2x" aria-hidden="true"></i> <br>Dashboard </a>
    <a class="btn LogoutButton" href="/hall-of-fame"><i class="fa fa-trophy fa-2x" aria-hidden="true"></i><br>Hall of fame</a>
    <a class="btn LogoutButton" href="/logout"><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i><br>Log Out</a>
    <img src="url" alt="">
</div>