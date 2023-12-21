<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Semua Kategori</span>
                    </div>
                    <ul>
                        @foreach ($categories as $cat)
                            <li><a href="#">{{ $cat->name }}</a></li>
                        @endforeach
                        {{-- <li><a href="#">Kategori 2</a></li>
                        <li><a href="#">Kategori 3</a></li>
                        <li><a href="#">Kategori 4</a></li> --}}
                        {{-- <li><a href="#">Kategori 5</a></li>
                        <li><a href="#">Kategori 6</a></li>
                        <li><a href="#">Kategori 7</a></li>
                        <li><a href="#">Kategori 8</a></li>
                        <li><a href="#">Kategori 9</a></li>
                        <li><a href="#">Kategori 10</a></li>
                        <li><a href="#">Kategori 11</a></li> --}}
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <input type="text" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+ {{ $setting->main_tlp }}</h5>
                            <span>Always Supporting You</span>
                        </div>
                    </div>
                </div>
                <div class="hero__item set-bg" data-setbg="{{ asset('guest/img/banner/banner-home.webp') }}">
                    <div class="hero__text">
                        <span>Kategori 1</span>
                        <h2>Produk 1 <br /> short-desc</h2>
                        <p>Free Pickup and Delivery Available</p>
                        <a href="#" class="primary-btn">Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->
