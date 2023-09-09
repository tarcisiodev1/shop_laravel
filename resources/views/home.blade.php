@extends('master')

@section('title', 'Home')

@section('content')
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
    <!-- Products -->
    <section id="products">
        <div class="container my-5">
            <header class="mb-4">
                <h3>Products</h3>
            </header>

            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/assets/images/' . $product->nome_do_arquivo) ?? '' }} "
                                class="card-img-top" alt="{{ $product->nome }} Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->nome }}</h5>
                                <p class="card-text">Price: ${{ $product->valor }}</p>
                                <p class="card-text">Dimensions: {{ $product->dimensoes }}</p>
                                <p class="card-text">Weight: {{ $product->peso }} kg</p>
                                <a href="{{ route('home.product', ['id' => $product->id]) }}"
                                    class="btn btn-primary">Details</a>
                                <a href="#" class="btn btn-success">Buy</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginação -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </section>
    <!-- Products -->

    <!-- Footer -->
    <footer class="text-center text-lg-start text-muted mt-3" style="background-color: #f5f5f5;">
        <div class="container pt-4">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase">Sobre Nós</h5>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel tincidunt nunc.
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase">Links Úteis</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="#!">Perguntas frequentes</a>
                        </li>
                        <li>
                            <a href="#!">Termos de Serviço</a>
                        </li>
                        <li>
                            <a href="#!">Política de Privacidade</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase">Entre em Contato</h5>
                    <ul class="list-unstyled">
                        <li>
                            <i class="fas fa-envelope me-2"></i>
                            <a href="mailto:contato@example.com">contato@example.com</a>
                        </li>
                        <li>
                            <i class="fas fa-phone me-2"></i>
                            <a href="tel:+1234567890">+1 (234) 567-890</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © {{ date('Y') }} Seu Site. Todos os direitos reservados.
        </div>
    </footer>
    <!-- Footer -->
@endsection
