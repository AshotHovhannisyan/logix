<header>
    <div class="container">
        <div class="main-nav">
            <h1><a href="{{ route('home')}}">Logix</a></h1>
            <nav>
                <ul>
                    <li><a href="{{ route('article')}}">Article</a></li>
                    @auth
                        <li><a href="{{ route('profile') }}">Profile</a></li>
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                    @else
                        <li><a href="{{ route('login')}}">Login</a></li>
                        <li><a href="{{ route('register')}}">Register</a></li>
                    @endauth
                </ul>
            </nav>
        </div>
    </div>
</header>
