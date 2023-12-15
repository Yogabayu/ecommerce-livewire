<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ $title }} &mdash; tester</title>

    {{-- <link rel="icon" href="{{ asset('file/setting/' . $app->logo) }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('file/setting/' . $app->logo) }}" type="image/x-icon"> --}}

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('style')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/components.css') }}">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 50% !important;
            padding: 0.5em 0.9em !important;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- END GA -->

    <livewire:styles />
</head>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <!-- Header -->
            @include('layouts.admin.components.header')

            <!-- Sidebar -->
            @include('layouts.admin.components.sidebar')

            <!-- Content -->
            {{-- @yield('main') --}}
            {{ $slot }}

            <!-- Footer -->
            @include('layouts.admin.components.footer')
        </div>
    </div>

    <!-- General JS Scripts -->
    {{-- @include('sweetalert::alert')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script> --}}
    <script src="{{ asset('admin/library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('admin/library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('admin/library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('admin/library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('admin/js/stisla.js') }}"></script>
    <script src="{{ asset('admin/library/izitoast/dist/js/iziToast.min.js') }}"></script>

    <script>
        "use strict";
        @if (session()->has('success'))
            console.log();
            iziToast.success({
                title: 'Success',
                message: '{{ session('success') }}',
                position: 'topRight'
            });
        @endif

        @if (session()->has('error'))
            console.log();
            iziToast.error({
                title: 'Error',
                message: '{{ session('error') }}',
                position: 'topRight'
            });
        @endif
    </script>

    @stack('scripts')

    <!-- Template JS File -->
    <script src="{{ asset('admin/js/scripts.js') }}"></script>
    <script src="{{ asset('admin/js/custom.js') }}"></script>

    <livewire:scripts />

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />
</body>

</html>
