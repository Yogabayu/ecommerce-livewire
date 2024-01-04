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

        .link:hover {
            color: #666
        }

        .imgSpecial {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
    </style>
@endpush
<div>
    <!-- Hero Section Begin -->
    <livewire:HeadComponent />
    <!-- Hero Section End -->
    <!-- Breadcrumb Section Begin -->
    <section wire:ignore.self class="breadcrumb-section set-bg" data-setbg="{{ asset('guest/img/sales.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ $generalProduct->name }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <a href="">{{ $generalProduct->nameCategory }}</a>
                            <span>{{ $generalProduct->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            @foreach ($photoProducts as $photo)
                                @if ($photo->is_primary == 1)
                                    <img class="product__details__pic__item--large"
                                        src="{{ asset('storage/public/photos/' . $photo->photo) }}" alt="">
                                @endif
                            @endforeach
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            @foreach ($photoProducts as $index => $photo)
                                @php
                                    $nextIndex = ($index + 4) % count($photoProducts);
                                    $nextPhoto = $photoProducts[$nextIndex];
                                @endphp

                                <img data-imgbigurl="{{ asset('storage/public/photos/' . $nextPhoto->photo) }}"
                                    src="{{ asset('storage/public/photos/' . $photo->photo) }}"
                                    alt="{{ $generalProduct->name }}">
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $generalProduct->name }}</h3>
                        <div class="product__details__rating">
                            @if ($viewCount <= 5)
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <span>({{ $viewCount }} Views)</span>
                            @elseif ($viewCount > 5 && $viewCount <= 10)
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <span>({{ $viewCount }} Views)</span>
                            @else
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <span>(@if ($viewCount >= 1000)
                                        {{ $viewCount >= 1000000 ? number_format($viewCount / 1000000, 1) . 'M' : number_format($viewCount / 1000, 1) . 'k' }}
                                    @else
                                        {{ $viewCount }}
                                    @endif Views)</span>
                            @endif
                        </div>
                        <div class="product__details__price">
                            @if ($detailProduct->after_sale)
                                <span>
                                    Rp.{{ $detailProduct->after_sale }}*</span>
                                <h4 class="text-center normal-price">
                                    Rp.{{ $generalProduct->price }}*</h4>
                            @else
                                <span>Rp.{{ $generalProduct->price }}*</span>
                            @endif
                        </div>
                        <p style="margin-bottom: 10px">{{ $generalProduct->short_desc }}</p>
                        <div class="product__details__quantity" style="width: 20%">

                        </div>
                        <a href="https://wa.me/{{ $detailProduct->no_pic }}?text=%2ASelamat%20Datang%20di%20Website%20Lelang%20Bank%20Arthaya.%2A%20Silahkan%20isi%20formulir%20dibawah.%0A%0ANama:%20xxx%0A%0AAlamat:%20xxx%0A%0ALelang:%20{{ $generalProduct->name }}.%20%0A%0ABank:%20Bank%20Arthaya.%0A%0A%2ATerima%20Kasih%20Telah%20Menggunakan%20Aplikasi%20Lelang%20Bank%20Arthaya%2A"
                            class="primary-btn" target="_blank"> <i class="fa fa-whatsapp"></i> hubungi via
                            WhatsApp</a>
                        <ul style="padding-top: 5px;margin-top:5px;">
                            <li><b>Status</b> <span>Tersedia</span></li>
                            <li>
                                <b>Bagikan</b>
                                <div class="share">
                                    <a href="#"
                                        wire:click.prevent="addShareCount('{{ $generalProduct->id }}', 'https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}')"
                                        target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="#"
                                        wire:click.prevent="addShareCount('{{ $generalProduct->id }}','https://twitter.com/share?url={{ urlencode(url()->current()) }}')"
                                        target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a href="#"
                                        wire:click.prevent="addShareCount('{{ $generalProduct->id }}','https://api.whatsapp.com/send?text={{ rawurlencode($generalProduct->name . ', Lelang Bank Arthaya , Buka Di: ' . url()->current()) }}')"
                                        target="_blank"><i class="fa fa-whatsapp"></i></a>
                                    {{-- <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                        target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="https://twitter.com/share?url={{ urlencode(url()->current()) }}"
                                        target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a href="https://api.whatsapp.com/send?text={{ rawurlencode($generalProduct->name . ', Lelang Bank Arthaya , Buka Di: ' . url()->current()) }}"
                                        target="_blank"><i class="fa fa-whatsapp"></i></a> --}}
                                </div>
                            </li>
                            <li>
                                @foreach ($tagProducts as $tp)
                                    <a class="link" href="{{ route('search', ['inputText' => $tp->name]) }}">
                                        <span>#{{ $tp->name }}</span>
                                    </a>
                                @endforeach
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Detail</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc ">
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <h6>Kategori</h6>
                                            <p>{{ $generalProduct->nameCategory }}</p>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <h6>Cara Penjualan</h6>
                                            <p>
                                                @if ($detailProduct->type_sales == 1)
                                                    Lelang
                                                @else
                                                    Jual Langsung
                                                @endif
                                            </p>
                                        </div>
                                        @if ($detailProduct->surface_area)
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <h6>Luas Tanah</h6>
                                                <p>{{ $detailProduct->surface_area }} (m&sup2;)</p>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <h6>Luas Bangunan</h6>
                                                <p>
                                                    {{ $detailProduct->building_area }} (m&sup2;)
                                                </p>
                                            </div>
                                        @endif
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <h6>Harga</h6>
                                            <div class="product__details__text">
                                                <div class="product__details__price">
                                                    @if ($detailProduct->after_sale)
                                                        <span>
                                                            Rp.{{ $detailProduct->after_sale }}*</span>
                                                        <h4 class="text-center normal-price">
                                                            Rp.{{ $generalProduct->price }}*</h4>
                                                    @else
                                                        <span>Rp.{{ $generalProduct->price }}*</span>
                                                    @endif
                                                </div>
                                                <p class="note">*Harga Tersebut Belum Termasuk Pajak Pembeli , Biaya
                                                    Balik Nama Dan Biaya Lainya
                                                    Harga Bisa Berubah Sewaktu - Waktu</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <h6>Lokasi</h6>
                                            <p>Provinsi: {{ $detailProduct->name_province }}</p>
                                            <p>Kota: {{ $detailProduct->name_city }}</p>
                                            <p>Alamat Lengkap: {{ $detailProduct->address }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Detail Lain: </h6>
                                    {!! $detailProduct->long_desc !!}

                                    <div class="row " style="margin-top: 10px">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <h6 class="d-flex justify-content-center">Dokumen Pendukung</h6>
                                            <p class="d-flex justify-content-center">
                                                <a class="btn btn-sm btn-secondary"
                                                    href="{{ asset('storage/public/sup_doc/' . $detailProduct->sup_doc) }}"
                                                    target="_blank" rel="noopener noreferrer">
                                                    <i class="fa fa-file"></i> Lihat Dokumen
                                                </a>
                                            </p>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <h6 class="d-flex justify-content-center">Lokasi</h6>
                                            <p class="d-flex justify-content-center">
                                                <a class="btn btn-sm btn-secondary"
                                                    href="{{ $detailProduct->gmaps }}" target="_blank"
                                                    rel="noopener noreferrer">
                                                    <i class="fa fa-map"></i> Lihat Lokasi
                                                </a>
                                            </p>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <h6 class="d-flex justify-content-center">PIC</h6>
                                            <p class="d-flex justify-content-center">
                                                {{ $generalProduct->username }}
                                            </p>
                                            <p class="d-flex justify-content-center">
                                                <a class="btn btn-sm btn-secondary"
                                                    href="https://wa.me/{{ $detailProduct->no_pic }}?text=Selamat%20Datang%20di%20Website%20Lelang%20Bank%20Arthaya.%20Silahkan%20isi%20formulir%20dibawah.%0A%0ANama:%20xxx%0AAlamat:%20xxx%0ALelang:{{ $generalProduct->name }}.%20%0ABank:%20Bank%20Arthaya."
                                                    target="_blank" rel="noopener noreferrer">
                                                    <i class="fa fa-phone"></i> + {{ $detailProduct->no_pic }}
                                                </a>
                                            </p>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <h6 class="d-flex justify-content-center">Tanggal Input</h6>
                                            <p class="d-flex justify-content-center">
                                                {{ \Carbon\Carbon::make($detailProduct->created_at)->format('d-m-Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div style="display: flex;align-items:center;justify-content: center;">
            <a href="https://wa.me/{{ $detailProduct->no_pic }}?text=%2ASelamat%20Datang%20di%20Website%20Lelang%20Bank%20Arthaya.%2A%20Silahkan%20isi%20formulir%20dibawah.%0A%0ANama:%20xxx%0A%0AAlamat:%20xxx%0A%0ALelang:%20{{ $generalProduct->name }}.%20%0A%0ABank:%20Bank%20Arthaya.%0A%0A%2ATerima%20Kasih%20Telah%20Menggunakan%20Aplikasi%20Lelang%20Bank%20Arthaya%2A"
                class="primary-btn" target="_blank"> <i class="fa fa-whatsapp"></i> hubungi via
                WhatsApp</a>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($relatedProducts as $rp)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg">
                                <img class="imgSpecial" src="{{ asset('storage/public/photos/' . $rp->photo) }}"
                                    alt="{{ $setting->name_app }}" srcset="">
                                @if ($rp->after_sale)
                                    <div class="tag">Sale</div>
                                @endif
                                <ul class="product__item__pic__hover">
                                    <li>
                                        <a href="#" style="display: flex; align-items: center; justify-content: center;">
                                            <i class="fa fa-eye" style="margin: 0; padding: 0;"></i>
                                            @if ($rp->seeing_count >= 1000)
                                                <span>
                                                    {{ $rp->seeing_count >= 1000000
                                                        ? number_format($rp->seeing_count / 1000000, 1) . 'M'
                                                        : number_format($rp->seeing_count / 1000, 1) . 'k' }}
                                                </span>
                                            @else
                                                <span>{{ $rp->seeing_count }}</span>
                                            @endif
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" style="display: flex; align-items: center; justify-content: center;">
                                            <i class="fa fa-share" style="margin: 0; padding: 0;"></i>
                                            {{-- {{ $rp->share_count }} --}}
                                            @if ($rp->share_count >= 1000)
                                                {{-- <span> --}}
                                                    {{ $rp->share_count >= 1000000
                                                        ? number_format($rp->share_count / 1000000, 1) . 'M'
                                                        : number_format($rp->share_count / 1000, 1) . 'k' }}
                                                {{-- </span> --}}
                                            @else
                                                {{-- <span> --}}
                                                    {{ $rp->share_count }}
                                                {{-- </span> --}}
                                            @endif
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('detailproduct', ['slug' => $rp->slug]) }}" style="display: flex; align-items: center; justify-content: center;">
                                            <i class="fa fa-info" style="margin: 0; padding: 0;"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a
                                        href="{{ route('detailproduct', ['slug' => $rp->slug]) }}">{{ $rp->name }}</a>
                                </h6>
                                <h5>Rp.{{ $rp->price }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
</div>
