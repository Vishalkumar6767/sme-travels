<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('bootstrap/bootstrap-icons.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('quill/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('remixicon/remixicon.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
   

    

    @stack('styles')
</head>
<body id="page-top">
 
    <div id="wrapper">
        @include('sme_Cpanel.partials.sidebar') <!-- Include Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('sme_Cpanel.partials.topbar') <!-- Include Topbar -->
                <div class="container-fluid">
                    @yield('content') <!-- Dynamic Content -->
                </div>
            </div>
            @include('sme_Cpanel.partials.footer') <!-- Include Footer -->
        </div>
    </div>

    <!-- Scripts -->
    {{-- <script src="{{ asset('/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
    <!-- Include jQuery and Bootstrap's JS (place at the end of your body tag) -->


</body>
</html>
