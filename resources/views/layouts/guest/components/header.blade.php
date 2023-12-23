<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="{{ Storage::url('setting/' . $setting->logo) }}" alt="{{ $setting->name_app }}"
                style="max-width: 120px;max-height: 50px;"></a>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Daftar Lelang</a></li>
            <li><a href="#">Peta</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="{{ route('faq') }}">FaQ</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="{{ $setting->fb }}" target="_blank"><i class="fa fa-facebook"></i></a>
        <a href="{{ $setting->ig }}" target="_blank"><i class="fa fa-instagram"></i></a>
        <a href="https://wa.me/{{ $setting->wa }}" target="_blank"><i class="fa fa-whatsapp"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> {{ $setting->email }}</li>
            <li>Copyright &copy; {{ $setting->name_app }} {{ date('Y') }}</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header" style="margin-bottom: 10px">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> {{ $setting->email }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="{{ $setting->fb }}" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="{{ $setting->ig }}" target="_blank"><i class="fa fa-instagram"></i></a>
                            <a href="https://wa.me/{{ $setting->wa }}" target="_blank"><i
                                    class="fa fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container"
        style="box-shadow: 0px 15px 9px -5px rgba(0,0,0,0.11);
-webkit-box-shadow: 0px 15px 9px -5px rgba(0,0,0,0.11);
-moz-box-shadow: 0px 15px 9px -5px rgba(0,0,0,0.11);">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ Storage::url('setting/' . $setting->logo) }}" alt="{{ $setting->name_app }}"
                            style="max-width: 120px;max-height: 50px;">
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="#">Daftar Lelang</a></li>
                        <li><a href="#">Peta</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="{{ route('faq') }}">FaQ</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->
