<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/css/styles.css', 'resources/sass/app.scss', 'resources/js/app.js', 'resources/js/script.js', 'resources/js/datatables-simple-demo.js'])
    {{-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" /> --}}
    <link href="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-html5-2.4.2/datatables.min.css"
        rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body>
    @include('front.partials.navbar')
    @yield('content')
    @include('front.partials.footer')
    <script src="{{ asset('storage/assets/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-html5-2.4.2/datatables.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('storage/assets/chart-area-demo.js') }}"></script>
    <script src="{{ asset('storage/assets/chart-bar-demo.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" --}}
    {{-- crossorigin="anonymous"></script> --}}
    <script src="{{ asset('storage/assets/datatables-simple-demo.js') }}"></script>
    @yield('js')


    {{-- <script>
            $(document).ready(function () {
    // Verifica se o elemento com a classe "custom-alert" existe
    if ($(".custom-alert").length > 0) {
        // Após 5 segundos, oculta o elemento com uma animação de fade
        setTimeout(function () {
            $(".custom-alert").fadeOut(500, function () {
                // Remove o elemento do DOM após a animação
                $(this).remove();

                // Remova a mensagem da sessão (assumindo que você esteja usando Laravel)
                $.ajax({
                    url: "{{ route('clear.session.message') }}",
                    method: "GET",
                    success: function (response) {
                        // A mensagem da sessão foi removida com sucesso
                        console.log("sessão removida com sucesso");
                    },
                    error: function (error) {
                        console.log(
                            "Erro ao remover a mensagem da sessão:",
                            error
                        );
                    },
                });
            });
        }, 5000); // 5000 milissegundos = 5 segundos
    }
});

        </script> --}}
</body>

</html>
