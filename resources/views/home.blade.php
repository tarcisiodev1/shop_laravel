@extends('master')

@section('title')

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
                            <a href="{{ route('dashboard') }}"
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
                <!-- Product Cards Here -->
            </div>
        </div>
    </section>
    <!-- Products -->

    <!-- Footer -->
    <footer class="text-center text-lg-start text-muted mt-3" style="background-color: #f5f5f5;">
        <section class="">
            <div class="container text-center text-md-start pt-4 pb-4">
                <div class="row mt-3">
                    <div class="col-12 col-lg-3 col-sm-12 mb-2">
                        <a href="https://mdbootstrap.com/" target="_blank" class="">
                            <img src="https://mdbootstrap.com/img/logo/mdb-transaprent-noshadows.png" height="35" />
                        </a>
                        <p class="mt-2 text-dark">
                            © 2023 Copyright: MDBootstrap.com
                        </p>
                    </div>

                    <div class="col-6 col-sm-4 col-lg-2">
                        <h6 class="text-uppercase text-dark fw-bold mb-2">
                            Store
                        </h6>
                        <ul class="list-unstyled mb-4">
                            <li><a class="text-muted" href="#">About us</a></li>
                            <li><a class="text-muted" href="#">Find store</a></li>
                            <li><a class="text-muted" href="#">Categories</a></li>
                            <li><a class="text-muted" href="#">Blogs</a></li>
                        </ul>
                    </div>

                    <div class="col-6 col-sm-4 col-lg-2">
                        <h6 class="text-uppercase text-dark fw-bold mb-2">
                            Information
                        </h6>
                        <ul class="list-unstyled mb-4">
                            <li><a class="text-muted" href="#">Help center</a></li>
                            <li><a class="text-muted" href="#">Money refund</a></li>
                            <li><a class="text-muted" href="#">Shipping info</a></li>
                            <li><a class="text-muted" href="#">Refunds</a></li>
                        </ul>
                    </div>

                    <div class="col-6 col-sm-4 col-lg-2">
                        <h6 class="text-uppercase text-dark fw-bold mb-2">
                            Support
                        </h6>
                        <ul class="list-unstyled mb-4">
                            <li><a class="text-muted" href="#">Help center</a></li>
                            <li><a class="text-muted" href="#">Documents</a></li>
                            <li><a class="text-muted" href="#">Account restore</a></li>
                            <li><a class="text-muted" href="#">My orders</a></li>
                        </ul>
                    </div>

                    <div class="col-6 col-sm-4 col-lg-3">
                        <h6 class="text-uppercase text-dark fw-bold mb-2">Newsletter</h6>
                        <p class="text-muted">Stay in touch with latest updates about our products and offers</p>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control border" placeholder="Email" aria-label="Email"
                                aria-describedby="button-addon2" />
                            <button class="btn btn-light border shadow-0" type="button" id="button-addon2"
                                data-mdb-ripple-color="dark">
                                Join
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="">
            <div class="container">
                <div class="d-flex justify-content-between py-4 border-top">
                    <div>
                        <i class="fab fa-lg fa-cc-visa text-dark"></i>
                        <i class="fab fa-lg fa-cc-amex text-dark"></i>
                        <i class="fab fa-lg fa-cc-mastercard text-dark"></i>
                        <i class="fab fa-lg fa-cc-paypal text-dark"></i>
                    </div>
                    <div class="dropdown dropup">
                        <a class="dropdown-toggle text-dark" href="#" id="Dropdown" role="button"
                            data-mdb-toggle="dropdown" aria-expanded="false">
                            <i class="flag-united-kingdom flag m-0 me-1"></i>English
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="Dropdown">
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-united-kingdom flag"></i>English
                                    <i class="fa fa-check text-success ms-2"></i></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-poland flag"></i>Polski</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-china flag"></i>中文</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-japan flag"></i>日本語</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-germany flag"></i>Deutsch</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-france flag"></i>Français</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-spain flag"></i>Español</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-russia flag"></i>Русский</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="flag-portugal flag"></i>Português</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer -->
@endsection
