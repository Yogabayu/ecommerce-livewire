@push('style')
    <style>
        .bg-overdrive {
            background-color: #FFFF;
            padding-inline: 5px;
            border-radius: 10px
        }

        .hover-bg:hover {
            color: #290491;
            border-radius: 5px;
            font-weight: 900;
        }

        .prod_count {
            margin-top: 0.7rem;
            display: inline-block;
            min-width: 10px;
            padding: 3px 7px;
            font-size: 12px;
            font-weight: bold;
            line-height: 1;
            color: #ffffff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            background-color: #350f72;
            border-radius: 10px;
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
                        @foreach ($categories->take(10) as $index => $cat)
                            <li wire:key='{{ $cat->id }}' class="hover-bg">
                                <div class="row" style="display: flex; justify-content: space-between;margin-right:2rem">
                                    <a href="{{ route('search', ['category' => $cat->name]) }}" >{{ $cat->name }}</a>
                                    @if ($cat->prod_count)
                                        <p class="prod_count">{{ $cat->prod_count }}</p>
                                    @endif
                                </div>
                            </li>
                        @endforeach

                        @if ($categories->count() > 10)
                            <li wire:key='more-categories' class="hover-bg">
                                <div class="row" style="display: flex; justify-content: space-between;margin-right:2rem">
                                    <a href="{{ route('shop') }}">lainnya</a>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <livewire:SearchBoxComponent />
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
                    data-setbg="{{ $heroProd ? asset('storage/public/photos/' . $heroProd->photo) : asset('guest/img/banner/banner-home.webp') }}"
                    style="max-width: 870px; max-height: 430px; border-radius: 15px;">
                    <div class="hero__text">
                        @if ($heroProd)
                            <span class="bg-overdrive">{{ $heroProd->category ?? 'kategori' }}</span>
                            <div style="max-width: 600px;">
                                <h2 class="bg-overdrive">{{ $heroProd->name ?? 'name product' }}</h2>
                                <p class="bg-overdrive">{{ $heroProd->short_desc ?? 'short desc' }}</p>
                            </div>
                            <a href="{{ route('detailproduct', ['slug' => $heroProd->slug]) }}"
                                class="primary-btn">Detail</a>
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
