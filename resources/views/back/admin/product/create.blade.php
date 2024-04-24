@extends('back.main')

@section('title', 'Cadastro de Produto')

@include('back.partials.navbar')
@include('back.partials.sidebar')

@section('content')
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h2 class="text-center font-weight-light my-4">Cadastro de Produto</h2>
                            </div>
                            <div class="card-body">
                                <form id="createProductForm" method="POST" action="{{ route('admin.products.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome do Produto</label>
                                        <input type="text" class="form-control" id="nome" name="nome">
                                        <div class="feedback" id="nomeError"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="valor" class="form-label">Valor</label>
                                        <input type="text" class="form-control" id="valor" name="valor">
                                        <div class="feedback" id="valorError"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dimensoes" class="form-label">Dimensões</label>
                                        <input type="text" class="form-control" id="dimensoes" name="dimensoes">
                                        <div class="feedback" id="dimensoesError"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="peso" class="form-label">Peso</label>
                                        <input type="text" class="form-control" id="peso" name="peso">
                                        <div class="feedback" id="pesoError"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="imagem" class="form-label">Imagem do Produto (até 5MB)</label>
                                        <input type="file" class="form-control-file" id="imagem" name="imagem"
                                            accept="image/*">
                                        <div class="feedback" id="imagemError"></div>
                                    </div>
                                    <div class="feedback" id="generalError"></div>
                                    <button type="submit" class="btn btn-primary">Cadastrar</button>
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
                $('#createProductForm').on('submit', function(e) {
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
                                // Exibir erros de validação abaixo de cada campo
                                var errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    $('#' + key + 'Error').html(
                                        '<span class="text-danger">' +
                                        value[0] + '</span>');
                                });
                            } else {
                                // Exibir mensagem de erro geral em uma div
                                console.log(xhr);
                                $('#generalError').html(
                                    '<span class="text-danger">Erro ao criar o produto</span>'
                                );
                            }
                        }
                    });
                });
            });
        });
    </script>
@endsection
