<!-- Main Navigation -->
<header class="">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-primary bg-primary">
        <div class="container justify-content-center justify-content-md-between">
            <button class="navbar-toggler border py-2 text-dark" type="button" data-toggle="collapse"
                data-target="#navbarLeftAlignExample" aria-controls="navbarLeftAlignExample" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarLeftAlignExample">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#products">Products</a>
                    </li>
                </ul>

                @guest
                    <a href="{{ route('login') }}" class="nav-link text-white pt-2  me-3">
                        <span class="pt-1">Sign in</span>
                    </a>
                @else
                    @if (auth()->user()->type === 'admin' || auth()->user()->type === 'superadmin')
                        <a href="{{ route('admin.') }}" class="nav-link text-white pt-2  me-3">
                            <span class="pt-1">Dashboard</span>
                        </a>
                    @endif

                    <form id="meuForm" action="{{ route('logout') }}" method="post">
                        @csrf
                        <a href="#" onclick="document.getElementById('meuForm').submit();"
                            class="nav-link text-white pt-2">
                            <span class="pt-1">Logout</span>
                        </a>
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Jumbotron -->
    <div class="bg-primary text-white py-5">
        <div class="container py-5">
            <h1 class="bg-primary text-white ">
                Best products & <br />
                brands in our store
            </h1>
            <p>
                Trendy Products, Factory Prices, Excellent Service cards
            </p>
            <button type="button" class="btn btn-outline-light">
                Learn more
            </button>
        </div>
    </div>
    <!-- Jumbotron -->
</header>
