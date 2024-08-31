<nav class="navbar navbar-expand-lg text-white">
    <div class="container-fluid">
        <img src="/img/sthenos-logo.svg" alt="Logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="background-color: white;"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav text-white">
                <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
                <a class="nav-link text-white" href="#">Features</a>
                <a class="nav-link text-white" href="#">Pricing</a>
                <a class="nav-link disabled text-white" aria-disabled="true">Disabled</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-link text-white">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="nav-link text-white">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-link text-white">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>
