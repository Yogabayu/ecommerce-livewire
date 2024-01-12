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

        .common-border {
            border: 1px solid #cdcdcd;
            border-radius: 0.5rem;
            padding: 1.2rem;
        }

        .head-text {
            color: #000000 !important;
            font-weight: 900 !important;
        }

        .body-text {
            color: #727171 !important;
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
                            <li><b>Kategori</b> <span>{{ $detailProduct->categoryName }}</span></li>
                            <li><b>Status</b> <span>Tersedia</span></li>
                            <li><b>Jadwal</b> <span>{{  \Carbon\Carbon::parse($schedule->schedule)->format('d/m/Y') }}</span></li>
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
                        <div class="row text-center">
                            <div class="col-sm-8 col-md-8 col-lg-8 col-12 text-left">
                                <hr>
                                {{-- deskripsi --}}
                                <div class="my-3 common-border">
                                    <h4 class="head-text">Deskripsi</h4>
                                    <span class="body-text">
                                        {!! $detailProduct->long_desc !!}
                                    </span>
                                </div>
                                {{-- alamat --}}
                                <div class="common-border my-3">
                                    <h4 class="head-text">Alamat</h4>
                                    <div class="row ml-2 my-2">
                                        <div style="max-width: 5%">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12"
                                                viewBox="0 0 384 512">
                                                <path
                                                    d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                                            </svg>
                                        </div>
                                        <div style="max-width: 95%">
                                            <span class="body-text">
                                                {{ $detailProduct->address }}
                                            </span>
                                            <br>
                                            <a class="btn btn-sm btn-secondary" href="{{ $detailProduct->gmaps }}"
                                                target="_blank" rel="noopener noreferrer">
                                                <i class="fa fa-map"></i> Lihat Lokasi
                                            </a>
                                        </div>
                                    </div>

                                    @if ($detailProduct->sup_doc)
                                        <h4 class="head-text">Dokumen Pendukung</h4>
                                        <div class="ml-2">
                                            <a class="btn btn-sm btn-secondary"
                                                href="{{ asset('storage/public/sup_doc/' . $detailProduct->sup_doc) }}"
                                                target="_blank" rel="noopener noreferrer">
                                                <i class="fa fa-file"></i> Lihat Dokumen
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <div class="common-border my-3">
                                    <h4 class="head-text">Informasi Lain</h4>
                                    <div class="row my-2">
                                        @if (
                                            $detailProduct->building_area ||
                                                $detailProduct->surface_area ||
                                                $detailProduct->bedroom ||
                                                $detailProduct->bathroom ||
                                                $detailProduct->floors ||
                                                $detailProduct->certificate ||
                                                $detailProduct->garage ||
                                                $detailProduct->electrical_power ||
                                                $detailProduct->building_year)
                                            <div class="col">
                                                {{-- bangunan --}}
                                                @if ($detailProduct->building_area)
                                                    <div class="col my-1"
                                                        style="display: flex; flex-direction: column;">
                                                        <span>Luas Bangunan:</span>
                                                        <span
                                                            class="font-weight-bold">{{ $detailProduct->building_area }}
                                                            m&sup2;</span>
                                                    </div>
                                                @endif
                                                @if ($detailProduct->surface_area)
                                                    <div class="col my-1"
                                                        style="display: flex; flex-direction: column;">
                                                        <span>Luas Tanah:</span>
                                                        <span
                                                            class="font-weight-bold">{{ $detailProduct->surface_area }}
                                                            m&sup2;</span>
                                                    </div>
                                                @endif
                                                @if ($detailProduct->bedroom)
                                                    <div class="col my-1"
                                                        style="display: flex; flex-direction: column;">
                                                        <span>Kamar tidur:</span>
                                                        <span
                                                            class="font-weight-bold">{{ $detailProduct->bedroom }}</span>
                                                    </div>
                                                @endif
                                                @if ($detailProduct->bathroom)
                                                    <div class="col my-1"
                                                        style="display: flex; flex-direction: column;">
                                                        <span>Kamar mandi:</span>
                                                        <span
                                                            class="font-weight-bold">{{ $detailProduct->bathroom }}</span>
                                                    </div>
                                                @endif
                                                @if ($detailProduct->floors)
                                                    <div class="col my-1"
                                                        style="display: flex; flex-direction: column;">
                                                        <span>Jumlah Lantai:</span>
                                                        <span
                                                            class="font-weight-bold">{{ $detailProduct->floors }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col">
                                                {{-- bangunan --}}
                                                @if ($detailProduct->certificate)
                                                    <div class="col my-1"
                                                        style="display: flex; flex-direction: column;">
                                                        <span>Sertifikat:</span>
                                                        <span
                                                            class="font-weight-bold">{{ $detailProduct->certificate }}</span>
                                                    </div>
                                                @endif
                                                @if ($detailProduct->garage)
                                                    <div class="col my-1"
                                                        style="display: flex; flex-direction: column;">
                                                        <span>Jumlah Garasi:</span>
                                                        <span
                                                            class="font-weight-bold">{{ $detailProduct->garage }}</span>
                                                    </div>
                                                @endif
                                                @if ($detailProduct->electrical_power)
                                                    <div class="col my-1"
                                                        style="display: flex; flex-direction: column;">
                                                        <span>Daya Listrik:</span>
                                                        <span
                                                            class="font-weight-bold">{{ $detailProduct->electrical_power }}
                                                            Kwh</span>
                                                    </div>
                                                @endif
                                                @if ($detailProduct->building_year)
                                                    <div class="col my-1"
                                                        style="display: flex; flex-direction: column;">
                                                        <span>Tahun Bangun:</span>
                                                        <span
                                                            class="font-weight-bold">{{ $detailProduct->building_year }}</span>
                                                    </div>
                                                @endif


                                            </div>
                                        @endif
                                        @if (
                                            $detailProduct->chassis_number ||
                                                $detailProduct->machine_number ||
                                                $detailProduct->brand ||
                                                $detailProduct->series ||
                                                $detailProduct->kilometers ||
                                                $detailProduct->cc ||
                                                $detailProduct->type ||
                                                $detailProduct->color ||
                                                $detailProduct->transmission ||
                                                $detailProduct->vehicle_year ||
                                                $detailProduct->date_stnk)
                                            <div class="col">
                                                @if ($detailProduct->type)
                                                    <div class="col my-1"
                                                        style="display: flex; flex-direction: column;">
                                                        <span>Tipe:</span>
                                                        <span
                                                            class="font-weight-bold">{{ $detailProduct->type }}</span>
                                                    </div>
                                                @endif
                                                @if ($detailProduct->color)
                                                    <div class="col my-1"
                                                        style="display: flex; flex-direction: column;">
                                                        <span>Warna:</span>
                                                        <span
                                                            class="font-weight-bold">{{ $detailProduct->color }}</span>
                                                    </div>
                                                @endif
                                                @if ($detailProduct->transmission)
                                                    <div class="col my-1"
                                                        style="display: flex; flex-direction: column;">
                                                        <span>Transmisi:</span>
                                                        <span
                                                            class="font-weight-bold">{{ $detailProduct->transmission }}</span>
                                                    </div>
                                                @endif
                                                @if ($detailProduct->vehicle_year)
                                                    <div class="col my-1"
                                                        style="display: flex; flex-direction: column;">
                                                        <span>Tahun:</span>
                                                        <span
                                                            class="font-weight-bold">{{ $detailProduct->vehicle_year }}</span>
                                                    </div>
                                                @endif
                                                @if ($detailProduct->date_stnk)
                                                    <div class="col my-1"
                                                        style="display: flex; flex-direction: column;">
                                                        <span>Tanggal STNK:</span>
                                                        <span
                                                            class="font-weight-bold">{{ $detailProduct->date_stnk }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col">
                                                @if ($detailProduct->chassis_number)
                                                    <div class="col my-1"
                                                        style="display: flex; flex-direction: column;">
                                                        <span>Nomor Rangka:</span>
                                                        <span
                                                            class="font-weight-bold">{{ $detailProduct->chassis_number }}
                                                        </span>
                                                    </div>
                                                @endif
                                                @if ($detailProduct->machine_number)
                                                    <div class="col my-1"
                                                        style="display: flex; flex-direction: column;">
                                                        <span>Nomor Mesin:</span>
                                                        <span
                                                            class="font-weight-bold">{{ $detailProduct->machine_number }}</span>
                                                    </div>
                                                @endif
                                                @if ($detailProduct->brand)
                                                    <div class="col my-1"
                                                        style="display: flex; flex-direction: column;">
                                                        <span>Merk:</span>
                                                        <span
                                                            class="font-weight-bold">{{ $detailProduct->brand }}</span>
                                                    </div>
                                                @endif
                                                @if ($detailProduct->series)
                                                    <div class="col my-1"
                                                        style="display: flex; flex-direction: column;">
                                                        <span>Seri:</span>
                                                        <span
                                                            class="font-weight-bold">{{ $detailProduct->series }}</span>
                                                    </div>
                                                @endif
                                                @if ($detailProduct->kilometers)
                                                    <div class="col my-1"
                                                        style="display: flex; flex-direction: column;">
                                                        <span>Kilometer:</span>
                                                        <span
                                                            class="font-weight-bold">{{ $detailProduct->kilometers }}</span>
                                                    </div>
                                                @endif
                                                @if ($detailProduct->cc)
                                                    <div class="col my-1"
                                                        style="display: flex; flex-direction: column;">
                                                        <span>CC:</span>
                                                        <span class="font-weight-bold">{{ $detailProduct->cc }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                @if ($accessProducts)
                                    <div class="common-border my-3">
                                        <h4 class="head-text">Akses</h4>
                                        <div class="row my-2">
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="20" viewBox="0 0 640 512">
                                                            <path
                                                                d="M232 0c-39.8 0-72 32.2-72 72v8H72C32.2 80 0 112.2 0 152V440c0 39.8 32.2 72 72 72h.2 .2 .2 .2 .2H73h.2 .2 .2 .2 .2 .2 .2 .2 .2 .2H75h.2 .2 .2 .2 .2 .2 .2 .2 .2 .2H77h.2 .2 .2 .2 .2 .2 .2 .2 .2 .2H79h.2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2H82h.2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2H85h.2 .2 .2 .2H86h.2 .2 .2 .2H87h.2 .2 .2 .2H88h.2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2H98h.2 .2 .2 .2H99h.2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2 .2v0H456h8v0H568c39.8 0 72-32.2 72-72V152c0-39.8-32.2-72-72-72H480V72c0-39.8-32.2-72-72-72H232zM480 128h88c13.3 0 24 10.7 24 24v40H536c-13.3 0-24 10.7-24 24s10.7 24 24 24h56v48H536c-13.3 0-24 10.7-24 24s10.7 24 24 24h56V440c0 13.3-10.7 24-24 24H480V336 128zM72 128h88V464h-.1-.2-.2-.2H159h-.2-.2-.2H158h-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2H154h-.2-.2-.2H153h-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2H150h-.2-.2-.2H149h-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2H146h-.2-.2-.2H145h-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2H142h-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2H139h-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2H136h-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2H133h-.2-.2-.2-.2-.2-.2-.2-.2H131h-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2H128h-.2-.2-.2-.2-.2-.2-.2-.2H126h-.2-.2-.2-.2-.2-.2-.2-.2H124h-.2-.2-.2-.2-.2-.2-.2-.2H122h-.2-.2-.2-.2-.2-.2-.2-.2H120h-.2-.2-.2-.2-.2-.2-.2-.2H118h-.2-.2-.2-.2-.2-.2-.2-.2H116h-.2-.2-.2-.2-.2-.2-.2-.2H114h-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2H111h-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2H108h-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2H105h-.2-.2-.2-.2H104h-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2H100h-.2-.2-.2-.2H99h-.2-.2-.2-.2H98h-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2H88h-.2-.2-.2-.2H87h-.2-.2-.2-.2H86h-.2-.2-.2-.2H85h-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2H82h-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2H79h-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2H77h-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2H75h-.2-.2-.2-.2-.2-.2-.2-.2-.2-.2H73h-.2-.2-.2-.2-.2H72c-13.2 0-24-10.7-24-24V336h56c13.3 0 24-10.7 24-24s-10.7-24-24-24H48V240h56c13.3 0 24-10.7 24-24s-10.7-24-24-24H48V152c0-13.3 10.7-24 24-24zM208 72c0-13.3 10.7-24 24-24H408c13.3 0 24 10.7 24 24V336 464H368V400c0-26.5-21.5-48-48-48s-48 21.5-48 48v64H208V72zm88 24v24H272c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h24v24c0 8.8 7.2 16 16 16h16c8.8 0 16-7.2 16-16V168h24c8.8 0 16-7.2 16-16V136c0-8.8-7.2-16-16-16H344V96c0-8.8-7.2-16-16-16H312c-8.8 0-16 7.2-16 16z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Rumah Sakit
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($accessProducts->hospital)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="20" viewBox="0 0 640 512">
                                                            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                            <path
                                                                d="M337.8 5.4C327-1.8 313-1.8 302.2 5.4L166.3 96H48C21.5 96 0 117.5 0 144V464c0 26.5 21.5 48 48 48H256V416c0-35.3 28.7-64 64-64s64 28.7 64 64v96H592c26.5 0 48-21.5 48-48V144c0-26.5-21.5-48-48-48H473.7L337.8 5.4zM96 192h32c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H96c-8.8 0-16-7.2-16-16V208c0-8.8 7.2-16 16-16zm400 16c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H512c-8.8 0-16-7.2-16-16V208zM96 320h32c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H96c-8.8 0-16-7.2-16-16V336c0-8.8 7.2-16 16-16zm400 16c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H512c-8.8 0-16-7.2-16-16V336zM232 176a88 88 0 1 1 176 0 88 88 0 1 1 -176 0zm88-48c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H336V144c0-8.8-7.2-16-16-16z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Sekolah
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($accessProducts->school)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="16" viewBox="0 0 512 512">
                                                            <path
                                                                d="M243.4 2.6l-224 96c-14 6-21.8 21-18.7 35.8S16.8 160 32 160v8c0 13.3 10.7 24 24 24H456c13.3 0 24-10.7 24-24v-8c15.2 0 28.3-10.7 31.3-25.6s-4.8-29.9-18.7-35.8l-224-96c-8-3.4-17.2-3.4-25.2 0zM128 224H64V420.3c-.6 .3-1.2 .7-1.8 1.1l-48 32c-11.7 7.8-17 22.4-12.9 35.9S17.9 512 32 512H480c14.1 0 26.5-9.2 30.6-22.7s-1.1-28.1-12.9-35.9l-48-32c-.6-.4-1.2-.7-1.8-1.1V224H384V416H344V224H280V416H232V224H168V416H128V224zM256 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Bank/ATM
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($accessProducts->bank)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="18" viewBox="0 0 576 512">
                                                            <path
                                                                d="M547.6 103.8L490.3 13.1C485.2 5 476.1 0 466.4 0H109.6C99.9 0 90.8 5 85.7 13.1L28.3 103.8c-29.6 46.8-3.4 111.9 51.9 119.4c4 .5 8.1 .8 12.1 .8c26.1 0 49.3-11.4 65.2-29c15.9 17.6 39.1 29 65.2 29c26.1 0 49.3-11.4 65.2-29c15.9 17.6 39.1 29 65.2 29c26.2 0 49.3-11.4 65.2-29c16 17.6 39.1 29 65.2 29c4.1 0 8.1-.3 12.1-.8c55.5-7.4 81.8-72.5 52.1-119.4zM499.7 254.9l-.1 0c-5.3 .7-10.7 1.1-16.2 1.1c-12.4 0-24.3-1.9-35.4-5.3V384H128V250.6c-11.2 3.5-23.2 5.4-35.6 5.4c-5.5 0-11-.4-16.3-1.1l-.1 0c-4.1-.6-8.1-1.3-12-2.3V384v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V384 252.6c-4 1-8 1.8-12.3 2.3z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Pasar
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($accessProducts->market)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="20" viewBox="0 0 640 512">
                                                            <path
                                                                d="M224 109.3V217.6L183.3 242c-14.5 8.7-23.3 24.3-23.3 41.2V512h96V416c0-35.3 28.7-64 64-64s64 28.7 64 64v96h96V283.2c0-16.9-8.8-32.5-23.3-41.2L416 217.6V109.3c0-8.5-3.4-16.6-9.4-22.6L331.3 11.3c-6.2-6.2-16.4-6.2-22.6 0L233.4 86.6c-6 6-9.4 14.1-9.4 22.6zM24.9 330.3C9.5 338.8 0 354.9 0 372.4V464c0 26.5 21.5 48 48 48h80V273.6L24.9 330.3zM592 512c26.5 0 48-21.5 48-48V372.4c0-17.5-9.5-33.6-24.9-42.1L512 273.6V512h80z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Rumah Ibadah
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($accessProducts->house_of_worship)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="16" viewBox="0 0 512 512">
                                                            <path
                                                                d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM48 368v32c0 8.8 7.2 16 16 16H96c8.8 0 16-7.2 16-16V368c0-8.8-7.2-16-16-16H64c-8.8 0-16 7.2-16 16zm368-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V368c0-8.8-7.2-16-16-16H416zM48 240v32c0 8.8 7.2 16 16 16H96c8.8 0 16-7.2 16-16V240c0-8.8-7.2-16-16-16H64c-8.8 0-16 7.2-16 16zm368-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V240c0-8.8-7.2-16-16-16H416zM48 112v32c0 8.8 7.2 16 16 16H96c8.8 0 16-7.2 16-16V112c0-8.8-7.2-16-16-16H64c-8.8 0-16 7.2-16 16zM416 96c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V112c0-8.8-7.2-16-16-16H416zM160 128v64c0 17.7 14.3 32 32 32H320c17.7 0 32-14.3 32-32V128c0-17.7-14.3-32-32-32H192c-17.7 0-32 14.3-32 32zm32 160c-17.7 0-32 14.3-32 32v64c0 17.7 14.3 32 32 32H320c17.7 0 32-14.3 32-32V320c0-17.7-14.3-32-32-32H192z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Bioskop
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($accessProducts->cinema)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="18" viewBox="0 0 576 512">
                                                            <path
                                                                d="M288 0C422.4 0 512 35.2 512 80V96l0 32c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32l0 160c0 17.7-14.3 32-32 32v32c0 17.7-14.3 32-32 32H416c-17.7 0-32-14.3-32-32V448H192v32c0 17.7-14.3 32-32 32H128c-17.7 0-32-14.3-32-32l0-32c-17.7 0-32-14.3-32-32l0-160c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h0V96h0V80C64 35.2 153.6 0 288 0zM128 160v96c0 17.7 14.3 32 32 32H272V128H160c-17.7 0-32 14.3-32 32zM304 288H416c17.7 0 32-14.3 32-32V160c0-17.7-14.3-32-32-32H304V288zM144 400a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm288 0a32 32 0 1 0 0-64 32 32 0 1 0 0 64zM384 80c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16s7.2 16 16 16H368c8.8 0 16-7.2 16-16z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Halte
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($accessProducts->halte)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="18" viewBox="0 0 576 512">
                                                            <path
                                                                d="M482.3 192c34.2 0 93.7 29 93.7 64c0 36-59.5 64-93.7 64l-116.6 0L265.2 495.9c-5.7 10-16.3 16.1-27.8 16.1l-56.2 0c-10.6 0-18.3-10.2-15.4-20.4l49-171.6L112 320 68.8 377.6c-3 4-7.8 6.4-12.8 6.4l-42 0c-7.8 0-14-6.3-14-14c0-1.3 .2-2.6 .5-3.9L32 256 .5 145.9c-.4-1.3-.5-2.6-.5-3.9c0-7.8 6.3-14 14-14l42 0c5 0 9.8 2.4 12.8 6.4L112 192l102.9 0-49-171.6C162.9 10.2 170.6 0 181.2 0l56.2 0c11.5 0 22.1 6.2 27.8 16.1L365.7 192l116.6 0z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Bandara
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($accessProducts->airport)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="20" viewBox="0 0 640 512">
                                                            <path
                                                                d="M352 0H608c17.7 0 32 14.3 32 32V480c0 17.7-14.3 32-32 32H352c-17.7 0-32-14.3-32-32V32c0-17.7 14.3-32 32-32zM480 200c-13.3 0-24 10.7-24 24v64c0 13.3 10.7 24 24 24s24-10.7 24-24V224c0-13.3-10.7-24-24-24zm24 184c0-13.3-10.7-24-24-24s-24 10.7-24 24v64c0 13.3 10.7 24 24 24s24-10.7 24-24V384zM480 40c-13.3 0-24 10.7-24 24v64c0 13.3 10.7 24 24 24s24-10.7 24-24V64c0-13.3-10.7-24-24-24zM32 96H288v64H248v64h40v96c-53 0-96 43-96 96v64c0 17.7-14.3 32-32 32H128c-17.7 0-32-14.3-32-32V416c0-53-43-96-96-96V224H72V160H32c-17.7 0-32-14.3-32-32s14.3-32 32-32zm168 64H120v64h80V160z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Toll
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($accessProducts->toll)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="18" viewBox="0 0 576 512">
                                                            <path
                                                                d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Mall
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($accessProducts->mall)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="14" viewBox="0 0 448 512">
                                                            <path
                                                                d="M210.6 5.9L62 169.4c-3.9 4.2-6 9.8-6 15.5C56 197.7 66.3 208 79.1 208H104L30.6 281.4c-4.2 4.2-6.6 10-6.6 16C24 309.9 34.1 320 46.6 320H80L5.4 409.5C1.9 413.7 0 419 0 424.5c0 13 10.5 23.5 23.5 23.5H192v32c0 17.7 14.3 32 32 32s32-14.3 32-32V448H424.5c13 0 23.5-10.5 23.5-23.5c0-5.5-1.9-10.8-5.4-15L368 320h33.4c12.5 0 22.6-10.1 22.6-22.6c0-6-2.4-11.8-6.6-16L344 208h24.9c12.7 0 23.1-10.3 23.1-23.1c0-5.7-2.1-11.3-6-15.5L237.4 5.9C234 2.1 229.1 0 224 0s-10 2.1-13.4 5.9z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Taman
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($accessProducts->park)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="18" viewBox="0 0 576 512">
                                                            <path
                                                                d="M142.4 21.9c5.6 16.8-3.5 34.9-20.2 40.5L96 71.1V192c0 53 43 96 96 96s96-43 96-96V71.1l-26.1-8.7c-16.8-5.6-25.8-23.7-20.2-40.5s23.7-25.8 40.5-20.2l26.1 8.7C334.4 19.1 352 43.5 352 71.1V192c0 77.2-54.6 141.6-127.3 156.7C231 404.6 278.4 448 336 448c61.9 0 112-50.1 112-112V265.3c-28.3-12.3-48-40.5-48-73.3c0-44.2 35.8-80 80-80s80 35.8 80 80c0 32.8-19.7 61-48 73.3V336c0 97.2-78.8 176-176 176c-92.9 0-168.9-71.9-175.5-163.1C87.2 334.2 32 269.6 32 192V71.1c0-27.5 17.6-52 43.8-60.7l26.1-8.7c16.8-5.6 34.9 3.5 40.5 20.2zM480 224a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Farmasi
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($accessProducts->pharmacy)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="14" viewBox="0 0 448 512">
                                                            <path
                                                                d="M416 0C400 0 288 32 288 176V288c0 35.3 28.7 64 64 64h32V480c0 17.7 14.3 32 32 32s32-14.3 32-32V352 240 32c0-17.7-14.3-32-32-32zM64 16C64 7.8 57.9 1 49.7 .1S34.2 4.6 32.4 12.5L2.1 148.8C.7 155.1 0 161.5 0 167.9c0 45.9 35.1 83.6 80 87.7V480c0 17.7 14.3 32 32 32s32-14.3 32-32V255.6c44.9-4.1 80-41.8 80-87.7c0-6.4-.7-12.8-2.1-19.1L191.6 12.5c-1.8-8-9.3-13.3-17.4-12.4S160 7.8 160 16V150.2c0 5.4-4.4 9.8-9.8 9.8c-5.1 0-9.3-3.9-9.8-9L127.9 14.6C127.2 6.3 120.3 0 112 0s-15.2 6.3-15.9 14.6L83.7 151c-.5 5.1-4.7 9-9.8 9c-5.4 0-9.8-4.4-9.8-9.8V16zm48.3 152l-.3 0-.3 0 .3-.7 .3 .7z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Restoran
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($accessProducts->restaurant)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="14" viewBox="0 0 448 512">
                                                            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                            <path
                                                                d="M96 0C43 0 0 43 0 96V352c0 48 35.2 87.7 81.1 94.9l-46 46C28.1 499.9 33.1 512 43 512H82.7c8.5 0 16.6-3.4 22.6-9.4L160 448H288l54.6 54.6c6 6 14.1 9.4 22.6 9.4H405c10 0 15-12.1 7.9-19.1l-46-46c46-7.1 81.1-46.9 81.1-94.9V96c0-53-43-96-96-96H96zM64 96c0-17.7 14.3-32 32-32H352c17.7 0 32 14.3 32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V96zM224 288a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Stasiun
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($accessProducts->station)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="16" viewBox="0 0 512 512">
                                                            <path
                                                                d="M32 64C32 28.7 60.7 0 96 0H256c35.3 0 64 28.7 64 64V256h8c48.6 0 88 39.4 88 88v32c0 13.3 10.7 24 24 24s24-10.7 24-24V222c-27.6-7.1-48-32.2-48-62V96L384 64c-8.8-8.8-8.8-23.2 0-32s23.2-8.8 32 0l77.3 77.3c12 12 18.7 28.3 18.7 45.3V168v24 32V376c0 39.8-32.2 72-72 72s-72-32.2-72-72V344c0-22.1-17.9-40-40-40h-8V448c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32V64zM96 80v96c0 8.8 7.2 16 16 16H240c8.8 0 16-7.2 16-16V80c0-8.8-7.2-16-16-16H112c-8.8 0-16 7.2-16 16z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        SPBU/SPKLU
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($accessProducts->gas_station)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($facilitiesProduct)
                                    <div class="common-border my-3">
                                        <h4 class="head-text">Fasilitas</h4>
                                        <div class="row my-2">
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="20" viewBox="0 0 640 512">
                                                            <path
                                                                d="M64 160C64 89.3 121.3 32 192 32H448c70.7 0 128 57.3 128 128v33.6c-36.5 7.4-64 39.7-64 78.4v48H128V272c0-38.7-27.5-71-64-78.4V160zM544 272c0-20.9 13.4-38.7 32-45.3c5-1.8 10.4-2.7 16-2.7c26.5 0 48 21.5 48 48V448c0 17.7-14.3 32-32 32H576c-17.7 0-32-14.3-32-32H96c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V272c0-26.5 21.5-48 48-48c5.6 0 11 1 16 2.7c18.6 6.6 32 24.4 32 45.3v48 32h32H512h32V320 272z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Perabotan
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($facilitiesProduct->furnished)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="18" viewBox="0 0 576 512">
                                                            <path
                                                                d="M309.5 178.4L447.9 297.1c-1.6 .9-3.2 2-4.8 3c-18 12.4-40.1 20.3-59.2 20.3c-19.6 0-40.8-7.7-59.2-20.3c-22.1-15.5-51.6-15.5-73.7 0c-17.1 11.8-38 20.3-59.2 20.3c-10.1 0-21.1-2.2-31.9-6.2C163.1 193.2 262.2 96 384 96h64c17.7 0 32 14.3 32 32s-14.3 32-32 32H384c-26.9 0-52.3 6.6-74.5 18.4zM160 160A64 64 0 1 1 32 160a64 64 0 1 1 128 0zM306.5 325.9C329 341.4 356.5 352 384 352c26.9 0 55.4-10.8 77.4-26.1l0 0c11.9-8.5 28.1-7.8 39.2 1.7c14.4 11.9 32.5 21 50.6 25.2c17.2 4 27.9 21.2 23.9 38.4s-21.2 27.9-38.4 23.9c-24.5-5.7-44.9-16.5-58.2-25C449.5 405.7 417 416 384 416c-31.9 0-60.6-9.9-80.4-18.9c-5.8-2.7-11.1-5.3-15.6-7.7c-4.5 2.4-9.7 5.1-15.6 7.7c-19.8 9-48.5 18.9-80.4 18.9c-33 0-65.5-10.3-94.5-25.8c-13.4 8.4-33.7 19.3-58.2 25c-17.2 4-34.4-6.7-38.4-23.9s6.7-34.4 23.9-38.4c18.1-4.2 36.2-13.3 50.6-25.2c11.1-9.4 27.3-10.1 39.2-1.7l0 0C136.7 341.2 165.1 352 192 352c27.5 0 55-10.6 77.5-26.1c11.1-7.9 25.9-7.9 37 0z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Kolam renang
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($facilitiesProduct->swimming_pool)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="16" viewBox="0 0 512 512">
                                                            <path
                                                                d="M132.7 4.7l-64 64c-4.6 4.6-5.9 11.5-3.5 17.4s8.3 9.9 14.8 9.9H208c6.5 0 12.3-3.9 14.8-9.9s1.1-12.9-3.5-17.4l-64-64c-6.2-6.2-16.4-6.2-22.6 0zM64 128c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V192c0-35.3-28.7-64-64-64H64zm96 96a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM80 400c0-26.5 21.5-48 48-48h64c26.5 0 48 21.5 48 48v16c0 17.7-14.3 32-32 32H112c-17.7 0-32-14.3-32-32V400zm192 0c0-26.5 21.5-48 48-48h64c26.5 0 48 21.5 48 48v16c0 17.7-14.3 32-32 32H304c-17.7 0-32-14.3-32-32V400zm32-128a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zM356.7 91.3c6.2 6.2 16.4 6.2 22.6 0l64-64c4.6-4.6 5.9-11.5 3.5-17.4S438.5 0 432 0H304c-6.5 0-12.3 3.9-14.8 9.9s-1.1 12.9 3.5 17.4l64 64z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Lift
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($facilitiesProduct->lift)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="20" viewBox="0 0 640 512">
                                                            <path
                                                                d="M96 64c0-17.7 14.3-32 32-32h32c17.7 0 32 14.3 32 32V224v64V448c0 17.7-14.3 32-32 32H128c-17.7 0-32-14.3-32-32V384H64c-17.7 0-32-14.3-32-32V288c-17.7 0-32-14.3-32-32s14.3-32 32-32V160c0-17.7 14.3-32 32-32H96V64zm448 0v64h32c17.7 0 32 14.3 32 32v64c17.7 0 32 14.3 32 32s-14.3 32-32 32v64c0 17.7-14.3 32-32 32H544v64c0 17.7-14.3 32-32 32H480c-17.7 0-32-14.3-32-32V288 224 64c0-17.7 14.3-32 32-32h32c17.7 0 32 14.3 32 32zM416 224v64H224V224H416z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Gym
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($facilitiesProduct->gym)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="14" viewBox="0 0 448 512">
                                                            <path
                                                                d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM192 256h48c17.7 0 32-14.3 32-32s-14.3-32-32-32H192v64zm48 64H192v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V288 168c0-22.1 17.9-40 40-40h72c53 0 96 43 96 96s-43 96-96 96z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Carport / Parkiran
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($facilitiesProduct->carport)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="16" viewBox="0 0 512 512">
                                                            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                            <path
                                                                d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Sambungan Telepone
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($facilitiesProduct->telephone)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="20" viewBox="0 0 640 512">
                                                            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                            <path
                                                                d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c1.8 0 3.5-.2 5.3-.5c-76.3-55.1-99.8-141-103.1-200.2c-16.1-4.8-33.1-7.3-50.7-7.3H178.3zm308.8-78.3l-120 48C358 277.4 352 286.2 352 296c0 63.3 25.9 168.8 134.8 214.2c5.9 2.5 12.6 2.5 18.5 0C614.1 464.8 640 359.3 640 296c0-9.8-6-18.6-15.1-22.3l-120-48c-5.7-2.3-12.1-2.3-17.8 0zM591.4 312c-3.9 50.7-27.2 116.7-95.4 149.7V273.8L591.4 312z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Keamanan
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($facilitiesProduct->security)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="20" viewBox="0 0 640 512">
                                                            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                            <path
                                                                d="M0 488V171.3c0-26.2 15.9-49.7 40.2-59.4L308.1 4.8c7.6-3.1 16.1-3.1 23.8 0L599.8 111.9c24.3 9.7 40.2 33.3 40.2 59.4V488c0 13.3-10.7 24-24 24H568c-13.3 0-24-10.7-24-24V224c0-17.7-14.3-32-32-32H128c-17.7 0-32 14.3-32 32V488c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24zm488 24l-336 0c-13.3 0-24-10.7-24-24V432H512l0 56c0 13.3-10.7 24-24 24zM128 400V336H512v64H128zm0-96V224H512l0 80H128z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Garasi
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($facilitiesProduct->garage)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="max-width: 5%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                            width="14" viewBox="0 0 448 512">
                                                            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                            <path
                                                                d="M210.6 5.9L62 169.4c-3.9 4.2-6 9.8-6 15.5C56 197.7 66.3 208 79.1 208H104L30.6 281.4c-4.2 4.2-6.6 10-6.6 16C24 309.9 34.1 320 46.6 320H80L5.4 409.5C1.9 413.7 0 419 0 424.5c0 13 10.5 23.5 23.5 23.5H192v32c0 17.7 14.3 32 32 32s32-14.3 32-32V448H424.5c13 0 23.5-10.5 23.5-23.5c0-5.5-1.9-10.8-5.4-15L368 320h33.4c12.5 0 22.6-10.1 22.6-22.6c0-6-2.4-11.8-6.6-16L344 208h24.9c12.7 0 23.1-10.3 23.1-23.1c0-5.7-2.1-11.3-6-15.5L237.4 5.9C234 2.1 229.1 0 224 0s-10 2.1-13.4 5.9z" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-6 col-md-6 col-sm-6" style="max-width: 85%">
                                                        Taman
                                                    </div>
                                                    <div class="col-4 col-md-4 col-sm-4">
                                                        @if ($facilitiesProduct->park)
                                                            <p class="font-weight-bold">Ada</p>
                                                        @else
                                                            <p class="font-weight-bold">Tidak Ada</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 col-12 common-border">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Kalkulator KPR</h4>
                                            </div>
                                            <div class="card-body text-left">
                                                <div class="form-group">
                                                    <label for="assetName">Harga Aset</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            placeholder="Masukkan harga asset" name="priceKpr"
                                                            id="assetName" required oninput="formatNumber(this)">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="interestRate">Suku Bunga (%)</label>
                                                    <div class="input-group">
                                                        <input type="number" step="0.01" class="form-control"
                                                            placeholder="Masukkan suku bunga" name="interestRate"
                                                            id="interestRate" required>
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                %
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="loanTerm">Jangka Waktu Pinjaman (bulan)</label>
                                                    <input type="number" class="form-control"
                                                        placeholder="Masukkan jangka waktu pinjaman" name="loanTerm"
                                                        id="loanTerm" required>
                                                    <span class="text-danger">Maksimal 120 Bulan</span>
                                                </div>
                                                <button class="btn btn-primary"
                                                    onclick="calculateKPR()">Hitung</button>
                                                <div id="result" style="margin-top: 10px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{-- <div style="display: flex;align-items:center;justify-content: center;">
            <a href="https://wa.me/{{ $detailProduct->no_pic }}?text=%2ASelamat%20Datang%20di%20Website%20Lelang%20Bank%20Arthaya.%2A%20Silahkan%20isi%20formulir%20dibawah.%0A%0ANama:%20xxx%0A%0AAlamat:%20xxx%0A%0ALelang:%20{{ $generalProduct->name }}.%20%0A%0ABank:%20Bank%20Arthaya.%0A%0A%2ATerima%20Kasih%20Telah%20Menggunakan%20Aplikasi%20Lelang%20Bank%20Arthaya%2A"
                class="primary-btn" target="_blank"> <i class="fa fa-whatsapp"></i> hubungi via
                WhatsApp</a>
        </div> --}}
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
                                        <a href="#"
                                            style="display: flex; align-items: center; justify-content: center;">
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
                                        <a href="#"
                                            style="display: flex; align-items: center; justify-content: center;">
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
                                        <a href="{{ route('detailproduct', ['slug' => $rp->slug]) }}"
                                            style="display: flex; align-items: center; justify-content: center;">
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

@push('script')
    <script>
        function formatNumber(input) {
            var numericValue = input.value.replace(/\D/g, '');
            var formattedValue = new Intl.NumberFormat('id-ID').format(numericValue);
            input.value = formattedValue;
        }

        function calculateKPR() {
            var hargaAsset = parseFloat(document.getElementById('assetName').value.replace(/\D/g, ''));
            var sukuBunga = parseFloat(document.getElementById('interestRate').value) /
                100; // Convert percentage to decimal
            var jangkaWaktu = parseInt(document.getElementById('loanTerm').value);

            var hasilKPR = ((hargaAsset * sukuBunga) + hargaAsset) / jangkaWaktu;
            // var monthlyPayment = hasilKPR / jangkaWaktu;

            document.getElementById('result').innerHTML = '<div class="common-border">' +
                '<h4>Hasil KPR</h4> <br>' +
                '<strong style="color: blue">Rp. ' + hasilKPR.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') +
                '</strong>/ bulan' + '</div>';

            document.getElementById('result').innerHTML +=
                '<p style="margin-top: 10px; font-size: 12px;">*Catatan: Perhitungan ini adalah hasil perkiraan aplikasi KPR secara umum. Data perhitungan di atas dapat berbeda dengan perhitungan bank. Untuk perhitungan yang akurat, silahkan hubungi kantor cabang kami.</p>';
        }
    </script>
    <script src="{{ asset('guest/js/main.js') }}"></script>
@endpush
