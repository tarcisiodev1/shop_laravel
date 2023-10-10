@extends('back.main')

@section('title', 'dashboard')
@include('back.partials.navbar')
@include('back.partials.sidebar')
@section('content')
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container">
                <div class="row mt-3 m-3">
                    <div class="col-md-12">
                        <h2>Lista de Usuários</h2>

                        @include('notification.notification')
                        <table class="table table-bordered" id="users-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Tipo</th>
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
@include('back.partials.footer')
@section('js')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.users.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                createdRow: function(row, data, dataIndex) {
                    var deleteLink = "{{ route('admin.users.destroy', ':id') }}".replace(':id', data
                        .id);

                    // Verifica se o usuário é do tipo "superadmin" para mostrar o botão de deletar
                    if ("{{ auth()->user()->type }}" === 'superadmin') {
                        $(row).find('.deleteUser').attr('data-id', data.id).attr('data-url',
                            deleteLink);
                    }
                }
            });

            $('body').on('click', '.deleteUser', function(e) {
                e.preventDefault();

                var user_id = $(this).data("id");
                var delete_url = $(this).data("url");
                var result = confirm("Tem certeza de que deseja excluir este usuário?");

                if (result) {
                    $.ajax({
                        type: "DELETE",
                        url: delete_url,
                        data: {
                            id: user_id
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            alert("Usuário excluído com sucesso.");

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
