<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Website Lelang Bank Arthaya Indotama Pusaka">
    <meta name="keywords" content="lelang, bank arthaya indotama pusaka, situs lelang">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lelang Bank Arthaya Indotama Pusaka</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    @stack('style')

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('guest/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('guest/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('guest/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('guest/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('guest/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('guest/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('guest/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('guest/css/style.css') }}" type="text/css">

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
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include('layouts.guest.components.header')

    {{ $slot }}

    <!-- Footer Section Begin -->
    @include('layouts.guest.components.footer')
    <!-- Footer Section End -->

    @stack('script')
    <!-- Js Plugins -->
    <script src="{{ asset('guest/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('guest/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('guest/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('guest/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('guest/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('guest/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('guest/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('guest/js/main.js') }}"></script>

    <livewire:scripts />
</body>

</html>
