@extends('front.main')

@section('title', 'Home')

{{-- @include('front.partials.navbar') --}}

@section('content')

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
                            <img src="{{ asset('storage/assets/images/product_images/' . $product->nome_do_arquivo) ?? '' }} "
                                class="card-img-top" alt="{{ $product->nome }} Image">
                            <div class="card-body">
                                <h5 class="card-title mb-4">{{ $product->nome }}</h5>
                                <p class="card-text ">Price: ${{ $product->valor }}</p>
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



@endsection

{{-- @include('front.partials.footer') --}}
