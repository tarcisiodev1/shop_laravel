<!--Main Navigation-->
<header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container justify-content-center justify-content-md-between">
            <button class="navbar-toggler border py-2 text-dark" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarLeftAlignExample" aria-controls="navbarLeftAlignExample" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarLeftAlignExample">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-dark" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#products">Products</a>
                    </li>
                </ul>

                @guest
                    <a href="{{ route('login') }}"
                        class="btn btn-light shadow-0 text-primary pt-2 border border-white me-3">
                        <span class="pt-1">Sign in</span>
                    </a>
                @else
                    @if (auth()->user()->type === 'admin' || auth()->user()->type === 'superadmin')
                        <a href="{{ route('admin.') }}"
                            class="btn btn-light shadow-0 text-primary pt-2 border border-white me-3">
                            <span class="pt-1">Dashboard</span>
                        </a>
                    @endif
                    <a href="{{ route('logout') }}" class="btn btn-light shadow-0 text-primary pt-2 border border-white">
                        <span class="pt-1">Logout</span>
                    </a>
                @endguest
            </div>
        </div>
    </nav>
    <!-- Navbar -->

    <!-- Jumbotron -->
    <div class="bg-primary text-white py-5">
        <div class="container py-5">
            <h1>
                Best products & <br />
                brands in our store
            </h1>
            <p>
                Trendy Products, Factory Prices, Excellent Service
            </p>
            <button type="button" class="btn btn-outline-light">
                Learn more
            </button>
        </div>
    </div>
    <!-- Jumbotron -->
</header>
