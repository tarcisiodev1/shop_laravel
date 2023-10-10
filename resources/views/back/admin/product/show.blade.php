@extends('back.main')

@section('title', 'Visualizar Produto')

@include('back.partials.navbar')
@include('back.partials.sidebar')

@section('content')
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container">
                <div class="row mt-5">
                    <div class="col-md-12">
                        <h2>Detalhes do Produto</h2>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary mb-2">Editar
                            Produto</a>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $product->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nome</th>
                                        <td>{{ $product->nome }}</td>
                                    </tr>
                                    <tr>
                                        <th>Valor</th>
                                        <td>{{ $product->valor }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dimensões</th>
                                        <td>{{ $product->dimensoes }}</td>
                                    </tr>
                                    <tr>
                                        <th>Peso</th>
                                        <td>{{ $product->peso }}</td>
                                    </tr>
                                    <!-- Outros campos do produto aqui -->

                                    <!-- Exibindo imagens do produto -->
                                    @if ($productImages->count() > 0)


                                        <tr>
                                            <th>Imagens</th>
                                            <td>
                                                @foreach ($productImages as $image)
                                                    <img src="{{ asset('storage/assets/images/' . $image->nome_do_arquivo) }}"
                                                        alt="Imagem do Produto">
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </main>

    </div>
    </div>
@endsection

@include('back.partials.footer')
