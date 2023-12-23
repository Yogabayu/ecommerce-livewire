@push('style')
    <style>
        .bg-overdrive {
            background-color: #FFFF;
            padding-inline: 5px;
            border-radius: 10px
        }
    </style>
@endpush
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
                <div wire:ignore class="hero__item set-bg"
                    data-setbg="{{ $heroProd ? Storage::url('photos/' . $heroProd->photo) : asset('guest/img/banner/banner-home.webp') }}">
                    <div class="hero__text">
                        @if ($heroProd)
                            <span class="bg-overdrive">{{ $heroProd->category ?? 'kategori' }}</span>
                            <h2 class="bg-overdrive">{{ $heroProd->name ?? 'name product' }}</h2>
                            <p class="bg-overdrive">{{ $heroProd->short_desc ?? 'short desc' }}</p>
                            <a href="#" class="primary-btn">Detail</a>
                        @else
                            <p class="bg-overdrive">No product available</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->
