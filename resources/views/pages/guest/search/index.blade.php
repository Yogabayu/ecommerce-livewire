@push('style')
    <style>
        .note {
            font-size: 12px;
            /* Ukuran font */
            color: #666;
            /* Warna teks */
            text-align: justify;
            /* Posisi teks (jika diinginkan) */
            margin-bottom: 10px;
            /* Jarak bawah dari elemen berikutnya */
        }

        .discount {
            font-size: 30px;
            color: #dd2222;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .normal-price {
            display: inline-block;
            font-weight: 400;
            text-decoration: line-through;
            margin-left: 10px;
        }

        .tag {
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

        .hover-bg:hover {
            color: #96d424;
            font-weight: 900;
            cursor: pointer;
        }

        .active-pad {
            color: #290491;
            font-weight: 900;
        }

        @media only screen and (max-width: 767px) {
            .hidden-on-phone {
                display: none;
            }
        }

        .item-hover:hover {
            /* border: 1px solid #39fc03; */
            background-color: #03b5fc;
            border-radius: 10px;
        }

        .imgSpecial {
            width: 100%;
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
    <section wire:ignore class="breadcrumb-section set-bg" data-setbg="{{ asset('guest/img/sales.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ $setting->name_app }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>Search</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <section style="margin-top:3%">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Cari Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item hidden-on-phone">
                            <h4>Kategori</h4>
                            <ul>
                                @foreach ($categories as $cat)
                                    <li wire:key='{{ $cat->id }}'
                                        class="@if ($inputText == $cat->name) active-pad @endif hover-bg">
                                        <a wire:click="updateText('{{ $cat->name }}')">{{ $cat->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Tag Populer</h4>
                            @foreach ($populartags as $pt)
                                <div wire:key='{{ $pt->name }}' class="sidebar__item__size">
                                    <label for="large-{{ $pt->name }}"
                                        wire:click="updateText('{{ $pt->name }}')"
                                        class="@if ($inputText == $pt->name) active-pad @endif hover-bg">
                                        {{ $pt->name }}
                                        <input type="radio" id="large-{{ $pt->name }}">
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="sidebar__item hidden-on-phone">
                            <div class="latest-product__text">
                                <h4>Produk Terbaru</h4>
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
                    <div class="filter_item">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="filter__sort">
                                    <span>Urutkan </span>
                                    <button class="btn btn-sm {{ $state == 0 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(0)'>Default</button>
                                    <button class="btn btn-sm {{ $state == 1 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(1)'>Terbaru</button>
                                    <button class="btn btn-sm {{ $state == 2 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(2)'>
                                        Terlama</button>
                                    <button class="btn btn-sm {{ $state == 3 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(3)'>
                                        A-Z</button>
                                    <button class="btn btn-sm {{ $state == 4 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(4)'>
                                        Z-A</button>
                                    <button class="btn btn-sm {{ $state == 5 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(5)'>
                                        Termahal</button>
                                    <button class="btn btn-sm {{ $state == 6 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(6)'>
                                        Termurah</button>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="filter__found">
                                    <h6>Terkait: <span>{{ $inputText }}</span></h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="filter__found">
                                    <h6><span>{{ $countProduct }}</span> Produk ditemukan</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 1rem">
                        @if ($results->isEmpty())
                            <div class="col-12 text-center">
                                <p>***Produck tidak ditemukan***</p>
                                <p>***Coba Cari dengan kata kunci lain***</p>
                            </div>
                        @else
                            @foreach ($results as $sp)
                                <div class="col-lg-4 col-md-6 col-sm-6 item-hover" wire:key='{{ $sp->id }}'>
                                    <div class="product__item">
                                        <div class="product__item__pic">
                                            <img class="imgSpecial"
                                                src="{{ asset('storage/public/photos/' . $sp->photo) }}"
                                                alt="{{ $setting->name_app }}" srcset="">
                                            @if ($sp->after_sale)
                                                <div class="sale">Sale</div>
                                            @endif
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-eye"></i>
                                                        {{ $sp->seeing_count }}</a></li>
                                                <li><a href="#"><i class="fa fa-share"></i>
                                                        {{ $sp->share_count }}</a></li>
                                                <li><a href="{{ route('detailproduct', ['slug' => $sp->slug]) }}"><i
                                                            class="fa fa-info"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6><a href="#">{{ $sp->name }}</a></h6>
                                            @if ($sp->after_sale)
                                                <h5>Rp.{{ $sp->after_sale }}</h5>
                                                <span
                                                    style="text-decoration: line-through">Rp.{{ $sp->price }}</span>
                                            @else
                                                <h5>Rp.{{ $sp->price }}</h5>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="product__pagination">
                        {{ $results->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Produk Lainnya</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($relatedProducts as $rp)
                    <div class="col-lg-3 col-md-4 col-sm-6 item-hover">
                        <div class="product__item">
                            <div class="product__item__pic">
                                <img class="imgSpecial" src="{{ asset('storage/public/photos/' . $rp->photo) }}"
                                    srcset="">
                                @if ($rp->after_sale)
                                    <div class="tag">Sale</div>
                                @endif
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-eye"></i> {{ $rp->seeing_count }}</a></li>
                                    <li><a href="#"><i class="fa fa-share"></i> {{ $rp->share_count }}</a></li>
                                    <li><a href="{{ route('detailproduct', ['slug' => $rp->slug]) }}"><i
                                                class="fa fa-info"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a
                                        href="{{ route('detailproduct', ['slug' => $rp->slug]) }}">{{ $rp->name }}</a>
                                </h6>
                                @if ($rp->after_sale)
                                    <h5>Rp.{{ $rp->after_sale }}</h5>
                                    <span style="text-decoration: line-through">Rp.{{ $rp->price }}</span>
                                @else
                                    <h5>Rp.{{ $rp->price }}</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
</div>
@push('script')
    <script src="{{ asset('guest/js/main.js') }}"></script>
@endpush
