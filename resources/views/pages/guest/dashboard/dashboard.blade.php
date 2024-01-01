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
            border-radius: 10px;
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
                        <h2>Featured Product</h2>
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
                                    <li data-toggle="tooltip" title="Jumlah Dilihat"><a href="#"><i
                                                class="fa fa-eye"></i> {{ $fp->max_seeing_count }}</a>
                                    </li>
                                    <li data-toggle="tooltip" title="Jumlah share"><a href="#"><i
                                                class="fa fa-share"></i>{{ $fp->share_count }}</a></li>
                                    <li data-toggle="tooltip" title="Info Selengkapnya"><a
                                            href="{{ route('detailproduct', ['slug' => $fp->slug]) }}"><i
                                                class="fa fa-info"></i></a></li>
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
                            <img src="{{ asset('storage/public/banners/' . $banner->banner_img) }}"
                                alt="{{ $banner->banner_img }}" wire:key="{{ $banner->id }}"
                                style="max-width: 570px;max-height: 270px">
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
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div wire:ignore class="latest-product__slider owl-carousel">
                            @foreach ($latesProducts->chunk(3) as $chunk)
                                <div class="latest-prdouct__slider__item">
                                    @foreach ($chunk as $product)
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
                                                    <p style="text-decoration: line-through">Rp.{{ $product->price }}
                                                    </p>
                                                @else
                                                    <span>Rp.{{ $product->price }}</span>
                                                @endif
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Most Viewed Products</h4>
                        <div wire:ignore class="latest-product__slider owl-carousel">
                            @foreach ($viewedProducts->chunk(3) as $chunk)
                                <div class="latest-prdouct__slider__item">
                                    @foreach ($chunk as $product)
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
                                                    <p style="text-decoration: line-through">Rp.{{ $product->price }}
                                                    </p>
                                                @else
                                                    <span>Rp.{{ $product->price }}</span>
                                                @endif
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Most Share Products</h4>
                        <div wire:ignore class="latest-product__slider owl-carousel">
                            @foreach ($mostSharedProducts->chunk(3) as $chunk)
                                <div class="latest-prdouct__slider__item ">
                                    @foreach ($chunk as $product)
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
                                                {{-- <span>${{ $product->price }}</span> --}}
                                                @if ($product->after_sale)
                                                    <span>Rp.{{ $product->after_sale }}</span>
                                                    <p style="text-decoration: line-through">Rp.{{ $product->price }}
                                                    </p>
                                                @else
                                                    <span>Rp.{{ $product->price }}</span>
                                                @endif
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
