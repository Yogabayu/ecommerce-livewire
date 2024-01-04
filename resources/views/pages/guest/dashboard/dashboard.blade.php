@push('style')
    <style>
        .imgSpecial {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .item-hover:hover {
            /* border: 1px solid #39fc03; */
            background-color: #03b5fc;
            border-radius: 1.5rem;
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

        .see_all {
            color: #aaaaaa;
            font-weight: 600
        }

        .see_all>a {
            text-decoration: none;
            color: #000;
            transition: color 0.3s;
        }

        .see_all>a:hover {
            color: #3e49b3;
        }

    </style>
@endpush
<div>
    @include('pages.guest.dashboard.components.hero')
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div wire:ignore class="categories__slider owl-carousel">
                    @foreach ($categories as $cat)
                        <div wire:key='{{ $cat->id }}' class="col-lg-3">
                            <div class="categories__item item-hover">
                                <img class="imgSpecial" src="{{ asset('storage/public/categories/' . $cat->image) }}"
                                    alt="{{ $setting->name_app }}" srcset="">
                                <h5>
                                    <a href="{{ route('search', ['inputText' => $cat->name]) }}">
                                        {{ $cat->name }}
                                    </a>
                                </h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Aset Lelang</h2>
                    </div>
                    <div class="featured__controls">
                        <ul wire:ignore>
                            <li class="{{ $activeFilter === 'all' ? 'active' : '' }}"
                                wire:click.debounce.500ms="updateFeaturedCat('all')" data-filter="all">All</li>
                            @foreach ($categories as $cat)
                                <li class="{{ $activeFilter === $cat->slug ? 'active' : '' }}"
                                    wire:click.debounce.500ms="updateFeaturedCat('{{ $cat->slug }}')"
                                    data-filter=".{{ $cat->slug }}">{{ $cat->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">

                @if ($featuredProdList->isEmpty())
                    <div class="col-12 text-center">
                        <p>***Asset tidak ditemukan***</p>
                        <p>***Tidak Ada Asset di kategori ini***</p>
                    </div>
                @else
                    @foreach ($featuredProdList as $fp)
                        <div wire:loading>
                            <div id="preloder">
                                <div class="loader"></div>
                            </div>
                        </div>
                        <div wire:key="{{ $fp->slugCat }}"
                            class="col-lg-3 col-md-4 col-sm-6 item-hover mix {{ $fp->slugCat }}">
                            <div class="featured__item">
                                <div class="featured__item__pic">
                                    <img class="imgSpecial" src="{{ asset('storage/public/photos/' . $fp->photo) }}"
                                        alt="{{ $setting->name_app }}" srcset="">
                                    @if ($fp->after_sale)
                                        <div class="sale">Sale</div>
                                    @endif
                                    <ul class="featured__item__pic__hover">
                                        <li data-toggle="tooltip" title="Jumlah Dilihat">
                                            <a href="#"
                                                style="display: flex; align-items: center; justify-content: center;">
                                                <i class="fa fa-eye" style="margin: 0; padding: 0;"></i>
                                                @if ($fp->max_seeing_count >= 1000)
                                                    <span>
                                                        {{ $fp->max_seeing_count >= 1000000
                                                            ? number_format($fp->max_seeing_count / 1000000, 1) . 'M'
                                                            : number_format($fp->max_seeing_count / 1000, 1) . 'k' }}
                                                    </span>
                                                @else
                                                    <span>{{ $fp->max_seeing_count }}</span>
                                                @endif
                                            </a>
                                        </li>
                                        <li data-toggle="tooltip" title="Jumlah share">
                                            <a href="#"
                                                style="display: flex; align-items: center; justify-content: center;">
                                                {{-- <i class="fa fa-share"></i> --}}
                                                {{-- {{ $fp->share_count }} --}}
                                                <i class="fa fa-share" style="margin: 0; padding: 0;"></i>
                                                @if ($fp->share_count >= 1000)
                                                    <span>
                                                        {{ $fp->share_count >= 1000000
                                                            ? number_format($fp->share_count / 1000000, 1) . 'M'
                                                            : number_format($fp->share_count / 1000, 1) . 'k' }}
                                                    </span>
                                                @else
                                                    <span>{{ $fp->share_count }}</span>
                                                @endif
                                            </a>
                                        </li>
                                        <li data-toggle="tooltip" title="Info Selengkapnya">
                                            <a href="{{ route('detailproduct', ['slug' => $fp->slug]) }}" style="display: flex; align-items: center; justify-content: center;">
                                                <i class="fa fa-info" style="margin: 0; padding: 0;"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6><a
                                            href="{{ route('detailproduct', ['slug' => $fp->slug]) }}">{{ $fp->name }}</a>
                                    </h6>
                                    @if ($fp->after_sale)
                                        <h5>Rp.{{ $fp->after_sale }}</h5>
                                        <span style="text-decoration: line-through">Rp.{{ $fp->price }}</span>
                                    @else
                                        <h5>Rp.{{ $fp->price }}</h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row" wire:ignore>
                @foreach ($banners as $banner)
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="banner__pic">
                            <a href="{{$banner->url}}" target="_blank">
                                <img src="{{ asset('storage/public/banners/' . $banner->banner_img) }}"
                                alt="{{ $banner->banner_img }}" wire:key="{{ $banner->id }}"
                                style="max-width: 570px;max-height: 270px">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="latest-product__text">
                        <div style="display: flex; justify-content: space-between">
                            <h4>Aset Terbaru</h4>
                            <h5 class="see_all"><a href="{{ route('shop') }}">lihat semua</a></h5>
                        </div>
                        <div wire:ignore class="latest-product__slider owl-carousel">
                            @foreach ($latesProducts->chunk(3) as $chunk)
                                <div class="latest-prdouct__slider__item">
                                    <div class="row">
                                        @foreach ($chunk as $product)
                                            <div class="col-md-4">
                                                <a href="{{ route('detailproduct', ['slug' => $product->slug]) }}"
                                                    class="latest-product__item item-hover" data-toggle="tooltip"
                                                    title="{{ $product->name }}">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{ asset('storage/public/photos/' . $product->photo) }}"
                                                            alt="{{ $product->name }}"
                                                            style="max-width: 110px; max-height: 110px">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>{{ $product->name }}</h6>
                                                        @if ($product->after_sale)
                                                            <span>Rp.{{ $product->after_sale }}</span>
                                                            <p style="text-decoration: line-through">
                                                                Rp.{{ $product->price }}</p>
                                                        @else
                                                            <span>Rp.{{ $product->price }}</span>
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="latest-product__text">
                        <div style="display: flex; justify-content: space-between">
                            <h4>Aset Populer</h4>
                            <h5 class="see_all"><a href="{{ route('shop') }}">lihat semua</a></h5>
                        </div>
                        <div wire:ignore class="latest-product__slider owl-carousel">
                            @foreach ($viewedProducts->chunk(3) as $chunk)
                                <div class="latest-prdouct__slider__item">
                                    <div class="row">
                                        @foreach ($chunk as $product)
                                            <div class="col-md-4">
                                                <a href="{{ route('detailproduct', ['slug' => $product->slug]) }}"
                                                    class="latest-product__item item-hover" data-toogle="tooltip"
                                                    title="{{ $product->name }}">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{ asset('storage/public/photos/' . $product->photo) }}"
                                                            alt="{{ $product->name }}"
                                                            style="max-width: 110px;max-height: 110px">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>{{ $product->name }}</h6>
                                                        @if ($product->after_sale)
                                                            <span>Rp.{{ $product->after_sale }}</span>
                                                            <p style="text-decoration: line-through">
                                                                Rp.{{ $product->price }}
                                                            </p>
                                                        @else
                                                            <span>Rp.{{ $product->price }}</span>
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="latest-product__text">
                        <div style="display: flex; justify-content: space-between">
                            <h4>Asset Terbanyak Dibagikan</h4>
                            <h5 class="see_all"><a href="{{ route('shop') }}">lihat semua</a></h5>
                        </div>
                        <div wire:ignore class="latest-product__slider owl-carousel">
                            @foreach ($mostSharedProducts->chunk(3) as $chunk)
                                <div class="latest-prdouct__slider__item ">
                                    <div class="row">
                                        @foreach ($chunk as $product)
                                            <div class="col-md-4">
                                                <a href="{{ route('detailproduct', ['slug' => $product->slug]) }}"
                                                    class="latest-product__item item-hover" data-toogle="tooltip"
                                                    title="{{ $product->name }}">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{ asset('storage/public/photos/' . $product->photo) }}"
                                                            alt="{{ $product->name }}"
                                                            style="max-width: 110px;max-height: 110px">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>{{ $product->name }}</h6>
                                                        @if ($product->after_sale)
                                                            <span>Rp.{{ $product->after_sale }}</span>
                                                            <p style="text-decoration: line-through">
                                                                Rp.{{ $product->price }}
                                                            </p>
                                                        @else
                                                            <span>Rp.{{ $product->price }}</span>
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    {{-- <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-1.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Cooking tips make cooking simple</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-2.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-3.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Visit the clean farm in the US</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Blog Section End -->
</div>
