<nav class="navbar navbar-expand-md text-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="/img/sthenos-logo.svg" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <i class="bi bi-list text-white"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
                <a class="nav-link text-white" href="#">Features</a>
                <a class="nav-link text-white" href="#">Pricing</a>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @auth
                @if (Auth::user()->instrutor)
                <li class="navbar-nav">
                    <a class="nav-link text-white" href="{{ route('exercicio.index') }}">Exercicios</a>
                </li>
                <li class="navbar-nav">
                    <a class="nav-link text-white" href="{{ route('treino.index') }}">Treinos</a>
                </li>
                @endif
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            {{ __('Perfil') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            {{ __('Sair') }}
                        </a>
                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @else
                <a href="{{ route('login') }}" class="nav-link text-white">
                    {{ __('Entrar') }}
                </a>
                <a href="{{ route('register') }}" class="nav-link text-white">
                    {{ __('Cadastrar') }}
                </a>
                @endauth
            </ul>
        </div>
    </div>
</nav>