<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="description"
        content="Lelang Bank Arthaya Indotama Pusaka - Situs Resmi Lelang Properti dan Aset Bank di Indonesia. Temukan properti dan aset berkualitas dengan harga terbaik.">
    <meta name="keywords"
        content="lelang, bank arthaya indotama pusaka, situs lelang, properti, bank, rumah lelang, kendaraan, lelang properti, lelang aset, lelang rumah, lelang kendaraan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Bank Arthaya Indotama Pusaka | Yoga Bayu Anggana Pratama">
    <title>Lelang Bank Arthaya Indotama Pusaka - Situs Resmi Lelang Properti dan Aset Bank di Indonesia</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/public/setting/' . $setting->logo) }}" type="image/x-icon">

    @stack('style')
    <style>
        .footer-logo {
            max-width: 90px;
            max-height: 40px;
        }
    </style>

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('guest/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('guest/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('guest/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('guest/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('guest/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('guest/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('guest/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('guest/css/style.css') }}" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-PBT5HPR3');
    </script>
    <!-- End Google Tag Manager -->

    <livewire:styles />
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PBT5HPR3" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Page Preloder -->
    {{-- <div id="preloder">
        <div class="loader"></div>
    </div> --}}

    @include('layouts.guest.components.header')

    {{ $slot }}

    <!-- Footer Section Begin -->
    @include('layouts.guest.components.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    
    <script src="{{ asset('guest/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('guest/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('guest/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('guest/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('guest/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('guest/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('guest/js/owl.carousel.min.js') }}"></script>
    @stack('script')
    <livewire:scripts />
</body>

</html>
