@extends('master')

@section('title', "dashboard")
@include('site.navbar')
@include('site.sidebar')
@section('content')



<body class="sb-nav-fixed">

    @yield('admin')
       


</body>
@endsection
@include('site.footer')

