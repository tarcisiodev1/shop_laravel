@extends('front.main')

@section('title', 'Visualizar Produto')


@section('content')
    <div id="layoutSidenav_content">

        <main>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-6  mt-5 mb-5">
                        <!-- Exibir imagens do produto -->
                        <div id="product-images" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @if ($productImages->count() > 0)
                                    @foreach ($productImages as $key => $image)
                                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                            <img class="d-block w-100"
                                                src="{{ asset('storage/assets/images/' . $image->nome_do_arquivo) }}"
                                                alt="Imagem do Produto">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <a class="carousel-control-prev" href="#product-images" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Anterior</span>
                            </a>
                            <a class="carousel-control-next" href="#product-images" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Próximo</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 mt-5 mb-5">
                        <h2 class="mb-4">Detalhes do Produto</h2>
                        <ul class="list-group">
                            {{-- <li class="list-group-item"><strong>ID:</strong> {{ $product->id }}</li> --}}
                            <li class="list-group-item"><strong>Nome:</strong> {{ $product->nome }}</li>
                            <li class="list-group-item"><strong>Valor:</strong> R$ {{ $product->valor }}</li>
                            {{-- <li class="list-group-item"><strong>Dimensões:</strong> {{ $product->dimensoes }}</li> --}}
                            {{-- <li class="list-group-item"><strong>Peso:</strong> {{ $product->peso }}</li> --}}
                            <!-- Adicione outros campos do produto aqui -->
                        </ul>

                        <!-- Seção para calcular o frete (CEP) -->
                        <div class="mt-4">
                            <h4 class="mb-3">Calcular Frete (CEP)</h4>
                            <form id="calculateShippingForm">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" name="cep" id="cep"
                                        placeholder="Digite o CEP" required>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Calcular</button>
                                    </div>
                                </div>
                            </form>
                            <div id="valor-frete" class="mt-3 font-weight-bold"></div>
                        </div>
                        <!-- Fim da seção para calcular o frete (CEP) -->
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
@section('js')
    <script>
        // Adicionando um listener para o formulário
        document.getElementById('calculateShippingForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita o comportamento padrão do formulário

            const cep = document.getElementById('cep').value; // Obtém o valor do CEP

            // Envia a requisição AJAX
            fetch("{{ route('calculate.shipping') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        cep: cep
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Atualiza a div com o valor do frete
                    document.getElementById('valor-frete').innerHTML = 'Valor do frete: R$ ' + data.valor_frete;
                })
                .catch(error => {
                    console.error('Erro ao calcular o frete:', error);
                    document.getElementById('valor-frete').innerHTML = 'Erro ao calcular o frete.';
                });
        });
    </script>
@endsection
