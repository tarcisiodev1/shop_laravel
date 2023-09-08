<?php 
@extends('master')

@section('title', "dashboard")
@include('site.navbar')
@include('site.sidebar')
@section('content')

</div>
<div id="layoutSidenav_content">
    <main>
        <div class="container">
            <div class="row mt-5 m-5">
                <div class="col-md-12">
                    <h2>Lista de Produtos</h2>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-2">Novo Produto</a>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
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
        $('#products-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.products.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'nome', name: 'nome' },
                { data: 'valor', name: 'valor' },
                { data: 'dimensoes', name: 'dimensoes' },
                { data: 'peso', name: 'peso' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
    </script>
@endsection