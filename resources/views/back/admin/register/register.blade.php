@extends('back.main') <!-- Estenda o layout principal -->

@section('title', 'Register Admin') <!-- Define o título da página -->

@include('back.partials.navbar')
@include('back.partials.sidebar')
@section('content') <!-- Conteúdo da página -->
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">Create Account</h3>
                            </div>
                            <div class="card-body">
                                <form id="registerAdminForm" method="POST" action="{{ route('admin.register') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="inputFirstName" class="form-label">Name</label>
                                        <input class="form-control" id="inputFirstName" type="text" name="name"
                                            placeholder="Enter your first name" />
                                        <div id="nameError" class="feedback"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputEmail" class="form-label">Email address</label>
                                        <input class="form-control" id="inputEmail" type="email" name="email"
                                            placeholder="name@example.com" />
                                        <div id="emailError" class="feedback"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputPassword" class="form-label">Password</label>
                                        <input class="form-control" id="inputPassword" type="password" name="password"
                                            placeholder="Create a password" />
                                        <div id="passwordError" class="feedback">

                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                        <input class="form-control" id="password_confirmation" type="password"
                                            name="password_confirmation" placeholder="Confirm password" />
                                        <div id="passwordError" class="feedback">

                                        </div>

                                    </div>

                                    <div class="mt-4 mb-0">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                                        </div>
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
                $('#registerAdminForm').on('submit', function(e) {
                    e.preventDefault();
                    console.log('funciotnsodnqopwfiwenw');
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function(response) {

                            $('feedback').html('');


                            window.location.href =
                                '{{ route('admin.users.index') }}';
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                // Exibir erros de validação abaixo de cada campo

                                var errors = xhr.responseJSON.errors;

                                $.each(errors, function(key, value) {
                                    console.log(errors);
                                    $('#' + key + 'Error').html(
                                        '<span class="text-danger">' +
                                        value[0] + '</span>');
                                });
                            }
                        }
                    });
                });
            });
        });
    </script>
@endsection
