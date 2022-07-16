<div class="header">
    <a class="hover-underline-animation" href="{{ route('user.index') }}">Home</a>
    <a class="hover-underline-animation" href="{{ route('user.about') }}">About</a>
    <div class="dropdown">
        <button class="dropbtn">Event</button>
        <div class="dropdown-content">
            <a class="hover-underline-animation" href="{{ route('user.seminar') }}">Seminar</a>
            <a class="hover-underline-animation" href="{{ route('user.pjtln') }}">PJTLN</a>
        </div>
    </div>
    
    <div class="dropdown">
        <button class="dropbtn">Competition</button>
        <div class="dropdown-content">
            <a class="hover-underline-animation" href="{{ route('user.feature') }}">Features</a>
            <a class="hover-underline-animation" href="{{ route('user.newsanchor') }}">News Anchor</a>
            <a class="hover-underline-animation" href="{{ route('user.video') }}">Video</a>
            <a class="hover-underline-animation" href="{{ route('user.mininews') }}">Mini News Paper</a>
        </div>
    </div>
    <a class="hover-underline-animation" href="">Sponsorship</a>
</div>
    