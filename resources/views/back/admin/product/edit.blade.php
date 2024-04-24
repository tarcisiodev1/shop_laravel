@extends('back.main')

@section('title', 'Editar Produto')

@include('back.partials.navbar')
@include('back.partials.sidebar')

@section('content')
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container ">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h2 class="text-center font-weight-light my-4">Editar Produto</h2>
                            </div>
                            <div class="card-body">
                                <form id="editProductForm" method="POST"
                                    action="{{ route('admin.products.update', $product->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Nome do Produto -->
                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome do Produto</label>
                                        <input type="text" class="form-control" id="nome" name="nome"
                                            value="{{ $product->nome }}" required>
                                        <div class="feedback" id="nomeError"></div>
                                    </div>

                                    <!-- Valor -->
                                    <div class="mb-3">
                                        <label for="valor" class="form-label">Valor</label>
                                        <input type="text" class="form-control" id="valor" name="valor"
                                            value="{{ $product->valor }}" required>
                                        <div class="feedback" id="valorError"></div>
                                    </div>

                                    <!-- Dimensões -->
                                    <div class="mb-3">
                                        <label for="dimensoes" class="form-label">Dimensões</label>
                                        <input type="text" class="form-control" id="dimensoes" name="dimensoes"
                                            value="{{ $product->dimensoes }}" required>
                                        <div class="feedback" id="dimensoesError"></div>
                                    </div>

                                    <!-- Peso -->
                                    <div class="mb-3">
                                        <label for="peso" class="form-label">Peso</label>
                                        <input type="text" class="form-control" id="peso" name="peso"
                                            value="{{ $product->peso }}" required>
                                        <div class="feedback" id="pesoError"></div>
                                    </div>

                                    <!-- Imagem Atual -->
                                    <div class="mb-3">
                                        <label class="form-label">Imagem Atual do Produto</label>
                                        <div class="text-center">
                                            @if ($productImage)
                                                <img src="{{ asset('storage/assets/images/product_images/' . $productImage->nome_do_arquivo) }}"
                                                    alt="Imagem Atual do Produto" class="img-fluid">
                                            @else
                                                <p class="text-muted">Nenhuma imagem disponível</p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Nova Imagem -->
                                    <div class="mb-3">
                                        <label for="imagem" class="form-label">Nova Imagem do Produto (até 5MB)</label>
                                        <input type="file" class="form-control-file" id="imagem" name="imagem"
                                            accept="image/*">
                                        <div class="feedback" id="imagemError"></div>
                                    </div>

                                    <!-- Mensagem de Erro Geral -->
                                    <div class="feedback" id="generalError"></div>

                                    <!-- Botão de Atualizar -->
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary">Atualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </div>
@endsection

@include('back.partials.footer')

@section('js')
    <script>
        $(document).ready(function() {
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#editProductForm').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        success: function(response) {

                            $('.feedback').html('');


                            window.location.href =
                                '{{ route('admin.products.index') }}';
                        },
                        error: function(xhr) {
                            $('.feedback').html('');
                            if (xhr.status === 422) {

                                var errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    $('#' + key + 'Error').html(
                                        '<span class="text-danger">' +
                                        value[0] + '</span>');
                                });
                            } else {
                                // Exibir mensagem de erro geral em uma div
                                $('#generalError').html(
                                    '<span class="text-danger">Erro ao atualizar o produto</span>'
                                );
                            }
                        }
                    });
                });
            });
        });
    </script>
@endsection
