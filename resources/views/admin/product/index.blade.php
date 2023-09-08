@extends('master')

@section('title', "dashboard")
@include('site.navbar')
@include('site.sidebar')
@section('content')

</div>
<div id="layoutSidenav_content">
    <main>
        <div class="container">
            <div class="row mt-3 m-3">
                <div class="col-md-12">
                    <h2>Lista de Produtos</h2>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-2" id="createNewProduct">Novo Produto</a>

                        @include('notification.notification')
                    <table class="table table-bordered" id="products-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Valor</th>
                                <th>Dimensões</th>
                                <th>Peso</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

</div>
</div>



@endsection
@include('site.footer')
@section('js')
<script>
    $(function() {

        $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var table = $('#products-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('admin.products.index') }}",
    columns: [
        { data: 'id', name: 'id' },
        {
            data: 'nome',
            name: 'nome',
            render: function (data, type, full, meta) {
                // Crie um link dinâmico para visualizar o produto
                var viewLink = "{{ route('admin.products.show', ':id') }}".replace(':id', full.id);
                return '<a class="link-offset-2 link-underline link-underline-opacity-0" href="' + viewLink + '">' + data + '</a>';
            }
        },
        { data: 'valor', name: 'valor' },
        { data: 'dimensoes', name: 'dimensoes' },
        { data: 'peso', name: 'peso' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ],
            createdRow: function(row, data, dataIndex) {
                var editLink = "{{ route('admin.products.edit', ':id') }}".replace(':id', data.id);
                var deleteLink = "{{ route('admin.products.destroy', ':id') }}".replace(':id', data.id);

                $(row).find('.editProduct').attr('data-id', data.id).attr('href', editLink);
                $(row).find('.deleteProduct').attr('data-id', data.id).attr('data-url', deleteLink);
            }
        });



        $('body').on('click', '.deleteProduct', function(e) {
            e.preventDefault();

            var product_id = $(this).data("id");
            var delete_url = $(this).data("url");
console.log(delete_url);
            var result = confirm("Tem certeza de que deseja excluir este produto?");

            if (result) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin.products.store') }}" +'/'+ product_id,// Usar a URL definida no atributo data-url
                    data: { id: product_id },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        alert("Produto excluído com sucesso.");

                        table.draw();


                    },
                    error: function(data) {
                        console.log('Erro:', data);
                    }
                });
            } else {
                return false;
            }
        });

    });
    </script>
@endsection
