@push('style')
    <style>
        .imgSpecial {
            idth: 100%;
            height: 100%;
            object-fit: contain;
        }

        .sale {
            height: 45px;
            width: 45px;
            background: #dd2222;
            border-radius: 50%;
            font-size: 14px;
            color: #ffffff;
            line-height: 45px;
            text-align: center;
            position: absolute;
            left: 15px;
            top: 15px;
        }
    </style>
@endpush
<div>
    <livewire:HeadComponent />
    <!-- Breadcrumb Section Begin -->
    <section wire:ignore class="breadcrumb-section set-bg" data-setbg="{{ asset('guest/img/background-footer.webp') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ $setting->name_app }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Kategori</h4>
                            <ul>
                                @foreach ($categories as $cat)
                                    <li wire:key='{{ $cat->id }}' class="hover-bg active-pad"><a
                                            href="{{ route('search', ['category' => $cat->name]) }}">{{ $cat->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        {{-- <div class="sidebar__item">
                            <h4>Harga</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="1000000" data-max="9999999999999999">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount"> -
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="sidebar__item">
                            <h4>Tag Populer</h4>
                            @foreach ($populartags as $pt)
                                <div wire:key='{{ $pt->name }}' class="sidebar__item__size">
                                    <label for="large-{{ $pt->name }}">
                                        <a href="{{ route('search', ['tag' => $pt->name]) }}"
                                            class="hover-bg active-pad" style="color: #000000">
                                            {{ $pt->name }}
                                            <input type="radio" id="large-{{ $pt->name }}">
                                        </a>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="sidebar__item">
                            <h4>
                                Harga
                            </h4>
                            <form wire:submit.prevent='search' class="d-flex justify-content-center">
                                <input type="text" class="form-control" id="formattedPrice" wire:model='lowPrice'>
                                s.d
                                <input type="text" class="form-control" id="formattedPrice2" wire:model='highPrice'>
                                <button type="submit" class="btn btn-sm search-btn">Filter</button>
                            </form>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Asset Terbaru</h4>
                                <div wire:ignore class="latest-product__slider owl-carousel">
                                    @foreach ($latesProducts->chunk(3) as $chunk)
                                        <div class="latest-prdouct__slider__item">
                                            @foreach ($chunk as $product)
                                                <a href="{{ route('detailproduct', ['slug' => $product->slug]) }}"
                                                    class="latest-product__item" data-toogle="tooltip"
                                                    title="{{ $product->name }}">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{ asset('storage/public/photos/' . $product->photo) }}"
                                                            alt="{{ $product->name }}"
                                                            style="max-width: 110px;max-height: 110px">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>{{ $product->name }}</h6>
                                                        <span>Rp.{{ $product->price }}</span>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Hot Sale</h2>
                        </div>
                        <div class="row">
                            <div wire:ignore class="product__discount__slider owl-carousel">
                                @foreach ($saleProducts as $sp)
                                    <div class="col-lg-4"
                                        onclick="window.location='{{ route('detailproduct', ['slug' => $sp->slug]) }}';"
                                        style="cursor: pointer;">
                                        <div class="product__discount__item">
                                            <div class="product__discount__item__pic ">
                                                <img class="imgSpecial"
                                                    src="{{ asset('storage/public/photos/' . $sp->photo) }}"
                                                    alt="{{ $setting->name_app }}" srcset="">
                                                @if ($sp->after_sale)
                                                    <div class="product__discount__percent">Sale</div>
                                                @endif
                                                <ul class="product__item__pic__hover">
                                                    <li>
                                                        <a href="#"
                                                            style="display: flex; align-items: center; justify-content: center;">
                                                            <i class="fa fa-eye" style="margin: 0; padding: 0;"></i>
                                                            {{-- {{ $sp->seeing_count }} --}}
                                                            @if ($sp->seeing_count >= 1000)
                                                                <span>
                                                                    {{ $sp->share_count >= 1000000
                                                                        ? number_format($sp->seeing_count / 1000000, 1) . 'M'
                                                                        : number_format($sp->seeing_count / 1000, 1) . 'k' }}
                                                                </span>
                                                            @else
                                                                <span>{{ $sp->seeing_count }}</span>
                                                            @endif
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            style="display: flex; align-items: center; justify-content: center;">
                                                            <i class="fa fa-share" style="margin: 0; padding: 0;"></i>
                                                            {{-- {{ $sp->share_count }} --}}
                                                            @if ($sp->share_count >= 1000)
                                                                <span>
                                                                    {{ $sp->share_count >= 1000000
                                                                        ? number_format($sp->share_count / 1000000, 1) . 'M'
                                                                        : number_format($sp->share_count / 1000, 1) . 'k' }}
                                                                </span>
                                                            @else
                                                                <span>{{ $sp->share_count }}</span>
                                                            @endif
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('detailproduct', ['slug' => $sp->slug]) }}"
                                                            style="display: flex; align-items: center; justify-content: center;">
                                                            <i class="fa fa-info" style="margin: 0; padding: 0;">
                                                            </i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="product__discount__item__text">
                                                <span>{{ $sp->nameCategory }}</span>
                                                <h5><a
                                                        href="{{ route('detailproduct', ['slug' => $sp->slug]) }}">{{ $sp->name }}</a>
                                                </h5>
                                                <div class="product__item__price">
                                                    @if ($sp->after_sale)
                                                        Rp. {{ $sp->after_sale }}
                                                        <span>Rp.{{ $sp->price }}</span>
                                                    @else
                                                        Rp.{{ $sp->price }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div wire:loading>
                        <div id="preloder">
                            <div class="loader"></div>
                        </div>
                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-8 col-md-6">
                                <div class="filter__sort">
                                    <span>Urutkan </span>
                                    <button class="btn btn-sm {{ $state == 0 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(0)'>Default</button>
                                    <button class="btn btn-sm {{ $state == 1 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(1)'>Terbaru</button>
                                    <button class="btn btn-sm {{ $state == 2 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(2)'> Terlama</button>
                                    <button class="btn btn-sm {{ $state == 3 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(3)'> A-Z</button>
                                    <button class="btn btn-sm {{ $state == 4 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(4)'> Z-A</button>
                                    <button class="btn btn-sm {{ $state == 5 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(5)'> Termahal</button>
                                    <button class="btn btn-sm {{ $state == 6 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(6)'> Termurah</button>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__found">
                                    <h6><span>{{ $countProduct }}</span> Asset ditemukan</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach ($sortProducts as $sp)
                            <div class="col-lg-4 col-md-6 col-sm-6" wire:key='{{ $sp->id }}'
                                onclick="window.location='{{ route('detailproduct', ['slug' => $sp->slug]) }}';"
                                style="cursor: pointer;">
                                <div class="product__item">
                                    <div class="product__item__pic">
                                        <img class="imgSpecial"
                                            src="{{ asset('storage/public/photos/' . $sp->photo) }}"
                                            alt="{{ $setting->name_app }}" srcset="">

                                        <ul class="product__item__pic__hover">
                                            <li>
                                                <a href="#"
                                                    style="display: flex; align-items: center; justify-content: center;">
                                                    <i class="fa fa-eye" style="margin: 0; padding: 0;"></i>
                                                    {{-- {{ $sp->seeing_count }} --}}
                                                    @if ($sp->seeing_count >= 1000)
                                                        <span>
                                                            {{ $sp->seeing_count >= 1000000
                                                                ? number_format($sp->seeing_count / 1000000, 1) . 'M'
                                                                : number_format($sp->seeing_count / 1000, 1) . 'k' }}
                                                        </span>
                                                    @else
                                                        <span>{{ $sp->seeing_count }}</span>
                                                    @endif
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    style="display: flex; align-items: center; justify-content: center;">
                                                    <i class="fa fa-share" style="margin: 0; padding: 0;"></i>
                                                    {{-- {{ $sp->share_count }} --}}
                                                    @if ($sp->share_count >= 1000)
                                                        <span>
                                                            {{ $sp->share_count >= 1000000
                                                                ? number_format($sp->share_count / 1000000, 1) . 'M'
                                                                : number_format($sp->share_count / 1000, 1) . 'k' }}
                                                        </span>
                                                    @else
                                                        <span>{{ $sp->share_count }}</span>
                                                    @endif
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('detailproduct', ['slug' => $sp->slug]) }}"
                                                    style="display: flex; align-items: center; justify-content: center;">
                                                    <i class="fa fa-info" style="margin: 0; padding: 0;">
                                                    </i>
                                                </a>
                                            </li>
                                        </ul>
                                        @if ($sp->after_sale)
                                            <div class="sale">Sale</div>
                                        @endif
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#">{{ $sp->name }}</a></h6>
                                        @if ($sp->after_sale)
                                            <h5>Rp.{{ $sp->after_sale }}</h5>
                                            <span style="text-decoration: line-through">Rp.{{ $sp->price }}</span>
                                        @else
                                            <h5>Rp.{{ $sp->price }}</h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="product__pagination">
                        {{ $sortProducts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
</div>


@push('script')
    <script>
        document.getElementById('formattedPrice').addEventListener('input', function(event) {
            // Remove existing commas and dots
            let inputValue = event.target.value.replace(/[,\.]/g, '');

            // Format the number with commas
            let formattedValue = Number(inputValue).toLocaleString('id-ID'); // 'id-ID' for Indonesian locale

            // Update the input value
            event.target.value = formattedValue;
        });

        document.getElementById('formattedPrice2').addEventListener('input', function(event) {
            // Remove existing commas and dots
            let inputValue = event.target.value.replace(/[,\.]/g, '');

            // Format the number with commas
            let formattedValue = Number(inputValue).toLocaleString('id-ID'); // 'id-ID' for Indonesian locale

            // Update the input value
            event.target.value = formattedValue;
        });
    </script>
    {{-- <script src="{{ asset('guest/js/main.js') }}"></script> --}}
@endpush
