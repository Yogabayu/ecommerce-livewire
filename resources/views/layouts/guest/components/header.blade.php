<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="{{ asset('storage/public/setting/' . $setting->logo) }}" alt="{{ $setting->name_app }}"
                style="max-width: 120px;max-height: 50px;"></a>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="#">Home</a></li>
            <li class="{{ request()->is('shop') ? 'active' : '' }}"><a href="{{ route('shop') }}">Daftar Lelang</a></li>
            <li class="{{ request()->is('schedule') ? 'active' : '' }}"><a href="{{ route('schedule') }}">Jadwal Lelang</a></li>
            <li class="{{ request()->is('contactus') ? 'active' : '' }}"><a href="{{ route('contactus') }}">Contact</a></li>
            <li class="{{ request()->is('faq') ? 'active' : '' }}"><a href="{{ route('faq') }}">FaQ</a></li>
            <li class="{{ request()->is('procedure') ? 'active' : '' }}"><a href="{{ route('procedure') }}">Prosedur</a></li>
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
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> {{ $setting->email }}</li>
                            <li>Ternama dan Terpercaya</li>
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
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('storage/public/setting/' . $setting->logo) }}"
                            alt="{{ $setting->name_app }}" style="max-width: 120px;max-height: 50px;">
                    </a>
                </div>
            </div>
            <div class="col-lg-9">
                <nav class="header__menu">
                    <ul>
                        <li class="{{ request()->is('/') ? 'active' : '' }}">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="{{ request()->is('shop') ? 'active' : '' }}">
                            <a href="{{ route('shop') }}">Daftar Lelang</a>
                        </li>
                        <li class="{{ request()->is('schedule') ? 'active' : '' }}">
                            <a href="{{ route('schedule') }}">Jadwal Lelang</a>
                        </li>
                        <li class="{{ request()->is('contactus') ? 'active' : '' }}">
                            <a href="{{ route('contactus') }}">Contact</a>
                        </li>
                        <li class="nav-item dropdown {{ request()->is('faq') || request()->is('procedure') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">Informasi Lelang</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item ml-3 {{ request()->is('faq') ? 'active' : '' }}" href="{{ route('faq') }}">FAQ</a>
                                <a class="dropdown-item ml-3 {{ request()->is('procedure') ? 'active' : '' }}"
                                    href="{{ route('procedure') }}">Prosedur</a>
                            </div>
                        </li>
                        {{-- <li class="{{ request()->is('faq') ? 'active' : '' }}">
                            <a href="{{ route('faq') }}">FaQ</a>
                        </li> --}}
                        {{-- <li class="{{ request()->is('procedure') ? 'active' : '' }}">
                            <a href="{{ route('procedure') }}">Prosedur</a>
                        </li>                         --}}
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
