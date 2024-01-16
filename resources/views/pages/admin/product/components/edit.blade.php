@extends('layouts.admin.app')

@section('title')
    Edit Produk
@endsection

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="{{ asset('admin/library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/library/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/library/codemirror/theme/duotone-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/library/select2/dist/css/select2.min.css') }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="row">
                    <a href="{{ route('product.index') }}">
                        <button class="btn btn-secondary btn-sm mr-3">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                    </a>
                    <h1>Produk</h1>
                </div>
            </div>

            <div class="section-body">
                <form action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Asset Secara Umum</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama Aset</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-inbox"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Masukkan nama asset"
                                                name="name" value="{{ $product->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi Singkat</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-circle-info"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" placeholder="deskripsi singkat"
                                                name="short_desc" maxlength="250" value="{{ $product->short_desc }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <div class="input-group">
                                            <select name="category_id" id="category_id" class="form-control">
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}"
                                                        @if ($cat->id == $product->category_id) selected @endif>
                                                        {{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-tag"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" placeholder="harga produk"
                                                name="price" id="formattedPrice" value="{{ $product->price }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Publish</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-eye"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" name="publish" id="publish">
                                                <option value="1" @if ($product->publish == 1) selected @endif>Ya
                                                </option>
                                                <option value="0" @if ($product->publish == 0) selected @endif>
                                                    Tidak
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Apakah akan ditampilkan di Layar Utama (hero)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-eye"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" name="is_hero" id="is_hero">
                                                <option value="1" @if ($product->is_hero == 1) selected @endif>Ya
                                                </option>
                                                <option value="0" @if ($product->is_hero == 0) selected @endif>
                                                    Tidak
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4>Detail Produk</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Alamat Lengkap</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-location-dot"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="address" id="address" class="form-control"
                                                value="{{ $detailProduct->address }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi Panjang</label>
                                        <div class="input-group">
                                            <textarea class="form-control summernote" name="long_desc" id="long_desc">{!! $detailProduct->long_desc !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Link Gmaps</label>
                                        <div class="input-group">
                                            <div style="width: 75%">
                                                <input type="text" name="gmaps" id="gmaps" class="form-control"
                                                    value="{{ $detailProduct->gmaps }}">
                                            </div>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <a href="{{ $detailProduct->gmaps }}" target="_blank"
                                                        rel="noopener noreferrer" class="btn btn-sm btn-primary">cek
                                                        link</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Penjualan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-question"></i>
                                                </div>
                                            </div>
                                            <select name="type_sales" id="type_sales" class="form-control">
                                                <option value="1" @if ($detailProduct->type_sales == 1) selected @endif>
                                                    Lelang
                                                </option>
                                                <option value="2" @if ($detailProduct->type_sales == 2) selected @endif>Dibawah tangan</option>
                                            </select>
                                        </div>
                                    </div>
                                    @if ($detailProduct->after_sale)
                                        <div class="form-group">
                                            <label>Harga Setelah diskon</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-tag"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="after_sale" id="formattedPrice2"
                                                    class="form-control" value="{{ $detailProduct->after_sale }}">
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label data-toggle="tooltip" title="nomor diawali dengan 62 tanpa tanda +">Nomor
                                            WhatsApp
                                            PIC</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa-brands fa-whatsapp"></i>
                                                </div>
                                            </div>
                                            <input class="form-control" type="text" name="no_pic" id="no_pic"
                                                value="{{ $detailProduct->no_pic }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Photo Produk
                                            <a class="btn btn-primary" data-toggle="modal" data-target="#AddPhotoModal"
                                                data-backdrop="false"><i class="fas fa-add" aria-hidden="true"></i>
                                                Foto</a></label>
                                        <div class="row">
                                            @foreach ($productPhotos as $pp)
                                                <div class="col-6 col-md-3 mb-3"
                                                    style="display: flex; flex-direction: column; align-items: center;">
                                                    <img src="{{ asset('storage/public/photos/' . $pp->photo) }}"
                                                        alt="{{ $pp->photo }}" class="img-fluid">
                                                    <div class="row">
                                                        <a class="btn btn-danger btn-sm" title="Delete"
                                                            onclick="confirmDelete('{{ route('deletePhotos', $pp->id) }}')"
                                                            style="margin-top: 10px;">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                        @if ($pp->is_primary != 1)
                                                            <a href="{{ route('changePhotoPrimary', $pp->id) }}"
                                                                style="margin-top: 10px; margin-left:5px"
                                                                data-toggle="tooltip" title="Jadikan Gambar Utama">
                                                                <button type="button" class="btn btn-warning btn-sm"><i
                                                                        class="fas fa-recycle"></i></button>
                                                            </a>
                                                        @endif
                                                    </div>

                                                    @if ($pp->is_primary == 1)
                                                        <p>Gambar Utama</p>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    @if ($detailProduct->sup_doc)
                                        <div class="form-group">
                                            <label>Dokumen Pendukung (jika ada)</label>
                                            <div class="input-group">
                                                <iframe src="{{ asset('storage/public/sup_doc/' . $detailProduct->sup_doc) }}" frameborder="1" width="100%"
                                                    height="300px"></iframe>
                                            </div>
                                        </div>
                                    @endif                                    

                                    {{-- semua yg berkaitan dengan tanah/bangunan --}}
                                    @if ($detailProduct->surface_area)
                                        <div class="form-group">
                                            <label>Luas Tanah (m&sup2;)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        {{-- <i class="fas fa-chart-area"></i> --}}
                                                        LT
                                                    </div>
                                                </div>
                                                <input type="number" name="surface_area" id="surface_area"
                                                    class="form-control" value="{{ $detailProduct->surface_area }}">
                                            </div>
                                        </div>
                                    @endif

                                    @if ($detailProduct->building_area)
                                        <div class="form-group">
                                            <label>Luas Bangunan (m&sup2;)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        {{-- <i class="fas fa-chart-area"></i> --}}
                                                        LB
                                                    </div>
                                                </div>
                                                <input type="number" name="building_area" id="building_area"
                                                    class="form-control" value="{{ $detailProduct->building_area }}">
                                            </div>
                                        </div>
                                    @endif

                                    @if ($detailProduct->bedroom)
                                        <div class="form-group">
                                            <label>Jumlah Kamar Tidur</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-bed"></i>
                                                    </div>
                                                </div>
                                                <input type="number" name="bedroom" id="bedroom" class="form-control"
                                                    value="{{ $detailProduct->bedroom }}">
                                            </div>
                                        </div>
                                    @endif

                                    @if ($detailProduct->bathroom)
                                        <div class="form-group">
                                            <label>Jumlah Kamar mandi</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-bath"></i>
                                                    </div>
                                                </div>
                                                <input type="number" name="bathroom" id="bathroom"
                                                    class="form-control" value="{{ $detailProduct->bathroom }}">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($detailProduct->floors)
                                        <div class="form-group">
                                            <label>Jumlah Lantai</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        {{-- <i class="fas fa-chart-area"></i> --}}
                                                        JL
                                                    </div>
                                                </div>
                                                <input type="number" name="floors" id="floors" class="form-control"
                                                    value="{{ $detailProduct->floors }}">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($detailProduct->garage)
                                        <div class="form-group">
                                            <label>Jumlah Garasi</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-warehouse"></i>
                                                    </div>
                                                </div>
                                                <input type="number" name="garage" id="garage" class="form-control"
                                                    value="{{ $detailProduct->garage }}">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($detailProduct->certificate)
                                        <div class="form-group">
                                            <label>Jenis Sertifikat</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-certificate"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="certificate" id="certificate"
                                                    class="form-control" value="{{ $detailProduct->certificate }}">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($detailProduct->electrical_power)
                                        <div class="form-group">
                                            <label>Daya Listrik</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-bolt"></i>
                                                    </div>
                                                </div>
                                                <input type="number" name="electrical_power" id="electrical_power"
                                                    class="form-control" value="{{ $detailProduct->electrical_power }}">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($detailProduct->building_year)
                                        <div class="form-group">
                                            <label>Tahun Bangun</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-calendar"></i>
                                                    </div>
                                                </div>
                                                <input type="number" name="building_year" id="building_year"
                                                    class="form-control" value="{{ $detailProduct->building_year }}">
                                            </div>
                                        </div>
                                    @endif

                                    <hr>

                                    {{-- semua yg berkaitan dengan kendaraan --}}
                                    @if ($detailProduct->chassis_number)
                                        <div class="form-group">
                                            <label>Nomor Rangka</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-gear"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="chassis_number" id="chassis_number"
                                                    class="form-control" value="{{ $detailProduct->chassis_number }}">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($detailProduct->machine_number)
                                        <div class="form-group">
                                            <label>Nomor Mesin</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-gear"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="machine_number" id="machine_number"
                                                    class="form-control" value="{{ $detailProduct->machine_number }}">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($detailProduct->brand)
                                        <div class="form-group">
                                            <label>Merk</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-gear"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="brand" id="brand" class="form-control"
                                                    value="{{ $detailProduct->brand }}">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($detailProduct->series)
                                        <div class="form-group">
                                            <label>Seri</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-gear"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="series" id="series" class="form-control"
                                                    value="{{ $detailProduct->series }}">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($detailProduct->kilometers)
                                        <div class="form-group">
                                            <label>Kilometer</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-gear"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="kilometers" id="kilometers"
                                                    class="form-control" value="{{ $detailProduct->kilometers }}">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($detailProduct->cc)
                                        <div class="form-group">
                                            <label>Jenis CC</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-gear"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="cc" id="cc" class="form-control"
                                                    value="{{ $detailProduct->cc }}">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($detailProduct->type)
                                        <div class="form-group">
                                            <label>Tipe</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-gear"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="type" id="type" class="form-control"
                                                    value="{{ $detailProduct->type }}">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($detailProduct->color)
                                        <div class="form-group">
                                            <label>Warna</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-gear"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="color" id="color" class="form-control"
                                                    value="{{ $detailProduct->color }}">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($detailProduct->transmission)
                                        <div class="form-group">
                                            <label>Transmisi</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-gear"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="transmission" id="transmission"
                                                    class="form-control" value="{{ $detailProduct->transmission }}">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($detailProduct->vehicle_year)
                                        <div class="form-group">
                                            <label>Tahun (khusus aset kendaraan)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-calendar"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="vehicle_year" id="vehicle_year"
                                                    class="form-control" value="{{ $detailProduct->vehicle_year }}">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($detailProduct->date_stnk)
                                        <div class="form-group">
                                            <label>Tanggal STNK</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-calendar"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="date_stnk" id="date_stnk"
                                                    class="form-control" value="{{ $detailProduct->date_stnk }}">
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="tags">Tag Produk</label>
                                        <div class="input-group">
                                            <select class="form-control select2" multiple="multiple" id="tags"
                                                name="tags[]" required>
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}"
                                                        @if (in_array($tag->id, $productTags)) selected @endif>
                                                        {{ $tag->name }}
                                                    </option>
                                                @endforeach

                                                </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- jadwal lelang --}}
                            <div class="card">
                                <div class="card-header">
                                    <h4>Jadwal Lelang</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Tanggal Lelang (WIB)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-calendar"></i>
                                                </div>
                                            </div>
                                            <input type="datetime-local" name="schedule" id="schedule" class="form-control"
                                                value="{{ \Carbon\Carbon::parse($auctionSchedule->schedule)->format('Y-m-d\TH:i') }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>KPKNL</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-location-dot"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="kpknl" id="kpknl" class="form-control"
                                                value="{{ $auctionSchedule->kpknl }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- akses ke fasilitas umum --}}
                            <div class="card">
                                <div class="card-header">
                                    Akses Fasilitas Umum
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Akses Rumah Sakit ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-hospital"></i>
                                                </div>
                                            </div>
                                            <select name="hospital" id="hospital" class="form-control">
                                                <option value="1" @if ($accessProduct && $accessProduct->hospital == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$accessProduct || !$accessProduct->hospital) selected @endif>Tidak Ada
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Akses Sekolah ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-school"></i>
                                                </div>
                                            </div>
                                            <select name="school" id="school" class="form-control">
                                                <option value="1" @if ($accessProduct && $accessProduct->school == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$accessProduct || !$accessProduct->school) selected @endif>Tidak
                                                    Ada
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Akses Bank / ATM ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-building-columns"></i>
                                                </div>
                                            </div>
                                            <select name="bank" id="bank" class="form-control">
                                                <option value="1" @if ($accessProduct && $accessProduct->bank == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$accessProduct || !$accessProduct->bank) selected @endif>Tidak
                                                    Ada
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Akses Pasar ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-store"></i>
                                                </div>
                                            </div>
                                            <select name="market" id="market" class="form-control">
                                                <option value="1" @if ($accessProduct && $accessProduct->market == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$accessProduct || !$accessProduct->market) selected @endif>Tidak
                                                    Ada
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Akses Rumah Ibadah ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-place-of-worship"></i>
                                                </div>
                                            </div>
                                            <select name="house_of_worship" id="house_of_worship" class="form-control">
                                                <option value="1" @if ($accessProduct && $accessProduct->house_of_worship == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$accessProduct || !$accessProduct->house_of_worship) selected @endif>Tidak
                                                    Ada
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Akses Bioskop ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-film"></i>
                                                </div>
                                            </div>
                                            <select name="cinema" id="cinema" class="form-control">
                                                <option value="1" @if ($accessProduct && $accessProduct->cinema == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$accessProduct || !$accessProduct->cinema) selected @endif>Tidak
                                                    Ada
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Akses Halte ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-bus"></i>
                                                </div>
                                            </div>
                                            <select name="halte" id="halte" class="form-control">
                                                <option value="1" @if ($accessProduct && $accessProduct->halte == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$accessProduct || !$accessProduct->halte) selected @endif>Tidak
                                                    Ada
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Akses Bandara ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-plane"></i>
                                                </div>
                                            </div>
                                            <select name="airport" id="airport" class="form-control">
                                                <option value="1" @if ($accessProduct && $accessProduct->airport == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$accessProduct || !$accessProduct->airport) selected @endif>Tidak
                                                    Ada
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Akses toll ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-road-bridge"></i>
                                                </div>
                                            </div>
                                            <select name="toll" id="toll" class="form-control">
                                                <option value="1" @if ($accessProduct && $accessProduct->toll == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$accessProduct || !$accessProduct->toll) selected @endif>Tidak
                                                    Ada
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Akses Mall ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-cart-shopping"></i>
                                                </div>
                                            </div>
                                            <select name="mall" id="mall" class="form-control">
                                                <option value="1" @if ($accessProduct &&$accessProduct->mall == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$accessProduct || !$accessProduct->mall) selected @endif>Tidak
                                                    Ada
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Akses Taman ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-tree"></i>
                                                </div>
                                            </div>
                                            <select name="park" id="park" class="form-control">
                                                <option value="1" @if ($accessProduct &&$accessProduct->park == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$accessProduct || !$accessProduct->park) selected @endif>Tidak
                                                    Ada
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Akses Farmasi (apotek, dsb) ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-stethoscope"></i>
                                                </div>
                                            </div>
                                            <select name="pharmacy" id="pharmacy" class="form-control">
                                                <option value="1" @if ($accessProduct && $accessProduct->pharmacy == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$accessProduct || !$accessProduct->pharmacy) selected @endif>Tidak
                                                    Ada
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Akses Restoran ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-utensils"></i>
                                                </div>
                                            </div>
                                            <select name="restaurant" id="restaurant" class="form-control">
                                                <option value="1" @if ($accessProduct && $accessProduct->restaurant == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$accessProduct || !$accessProduct->restaurant) selected @endif>Tidak
                                                    Ada
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Akses Stasiun ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-train"></i>
                                                </div>
                                            </div>
                                            <select name="station" id="station" class="form-control">
                                                <option value="1" @if ($accessProduct && $accessProduct->station == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$accessProduct || !$accessProduct->station) selected @endif>Tidak
                                                    Ada
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Akses SPBU/SPKLU ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-gas-pump"></i>
                                                </div>
                                            </div>
                                            <select name="gas_station" id="gas_station" class="form-control">
                                                <option value="1" @if ($accessProduct && $accessProduct->gas_station == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$accessProduct || !$accessProduct->gas_station) selected @endif>Tidak
                                                    Ada
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    {{-- <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="isPublicFacilities" name="isPublicFacilities">
                                        <label class="form-check-label" for="flexCheckDefault">
                                           <span class="text-danger">Centang untuk memasukkan data update "Akses Fasilitas Umum"</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="deletePublicFacilities" name="deletePublicFacilities">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <span class="text-danger">Hapus data "Akses Fasilitas Umum"</span>
                                        </label>
                                    </div> --}}

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="statePublicFacilities" id="inlineRadio2" value="1">
                                        <label class="form-check-label" for="inlineRadio2">Tambah/Update Data "Akses Fasilitas Umum"</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="statePublicFacilities" id="inlineRadio3" value="2">
                                        <label class="form-check-label" for="inlineRadio3">Hapus Data "Akses Fasilitas Umum"</label>
                                    </div>
                                </div>
                            </div>

                            {{-- fasilitas aset --}}                            
                            <div class="card">
                                <div class="card-header">Fasilitas Asset</div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Perabotan ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-couch"></i>
                                                </div>
                                            </div>
                                            <select name="furnished" id="furnished" class="form-control">
                                                <option value="1" @if ($facilitiesProduct && $facilitiesProduct->furnished == 1) selected @endif>Ada</option>
                                                <option value="0" @if (!$facilitiesProduct || !$facilitiesProduct->furnished) selected @endif>Tidak Ada</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Kolam Renang ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-person-swimming"></i>
                                                </div>
                                            </div>
                                            <select name="swimming_pool" id="swimming_pool" class="form-control">
                                                <option value="1" @if ($facilitiesProduct && $facilitiesProduct->swimming_pool == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$facilitiesProduct || !$facilitiesProduct->swimming_pool) selected @endif>Tidak
                                                    Ada</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Lift ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-elevator"></i>
                                                </div>
                                            </div>
                                            <select name="lift" id="lift" class="form-control">
                                                <option value="1" @if ($facilitiesProduct && $facilitiesProduct->lift == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$facilitiesProduct || !$facilitiesProduct->lift) selected @endif>Tidak
                                                    Ada</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Gym ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-dumbbell"></i>
                                                </div>
                                            </div>
                                            <select name="gym" id="gym" class="form-control">
                                                <option value="1" @if ($facilitiesProduct &&$facilitiesProduct->gym == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$facilitiesProduct || !$facilitiesProduct->gym) selected @endif>Tidak
                                                    Ada</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Parkir/carport ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-square-parking"></i>
                                                </div>
                                            </div>
                                            <select name="carport" id="carport" class="form-control">
                                                <option value="1" @if ($facilitiesProduct &&$facilitiesProduct->carport == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$facilitiesProduct || !$facilitiesProduct->carport) selected @endif>Tidak
                                                    Ada</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Sambungan Telepon ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-phone"></i>
                                                </div>
                                            </div>
                                            <select name="telephone" id="telephone" class="form-control">
                                                <option value="1" @if ($facilitiesProduct && $facilitiesProduct->telephone == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$facilitiesProduct || !$facilitiesProduct->telephone) selected @endif>Tidak
                                                    Ada</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Keamanan ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-user-shield"></i>
                                                </div>
                                            </div>
                                            <select name="security" id="security" class="form-control">
                                                <option value="1" @if ($facilitiesProduct && $facilitiesProduct->security == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$facilitiesProduct || !$facilitiesProduct->security) selected @endif>Tidak
                                                    Ada</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Garasi ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-warehouse"></i>
                                                </div>
                                            </div>
                                            <select name="fasgarage" id="fasgarage" class="form-control">
                                                <option value="1" @if ($facilitiesProduct && $facilitiesProduct->garage == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$facilitiesProduct || !$facilitiesProduct->garage) selected @endif>Tidak
                                                    Ada</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Taman ?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-tree"></i>
                                                </div>
                                            </div>
                                            <select name="faspark" id="faspark" class="form-control">
                                                <option value="1" @if ($facilitiesProduct && $facilitiesProduct->park == 1) selected @endif>Ada
                                                </option>
                                                <option value="0" @if (!$facilitiesProduct || !$facilitiesProduct->park) selected @endif>Tidak
                                                    Ada</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    {{-- <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="isAssetFacilities" name="isAssetFacilities">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <span class="text-danger">Centang untuk memasukkan data update "Fasilitas Aset"</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="deleteAssetFacilities" name="deleteAssetFacilities">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <span class="text-danger">Hapus data "Fasilitas Aset"</span>
                                        </label>
                                    </div> --}}
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="stateAssetFacilities" id="inlineRadio2" value="1">
                                        <label class="form-check-label" for="inlineRadio2">Insert / Update Data "Fasilitas Aset"</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="stateAssetFacilities" id="inlineRadio3" value="2">
                                        <label class="form-check-label" for="inlineRadio3">Hapus Data "Fasilitas Aset"</label>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button class="btn btn-primary mr-1" type="submit">Simpan</button>
                                <a href="{{ route('product.index') }}" class="btn btn-secondary mr-1">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </form>

                @include('pages.admin.product.components.modal-category')
                @include('pages.admin.product.components.modal-tag')
                @include('pages.admin.product.components.modal-photo')
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('admin/library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('admin/library/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('admin/library/codemirror/mode/javascript/javascript.js') }}"></script>
    <script src="{{ asset('admin/library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('admin/library/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        function confirmDelete(deleteUrl) {
            var result = confirm('Apakah anda yakin menghapus data?');

            if (result) {
                window.location.href = deleteUrl;
            }
        }
    </script>
    <script>
        $("#table-1").dataTable({
            responsive: true,
            paging: true,
            pagingType: 'full_numbers',
        });
    </script>
    <script>
        // JavaScript to format the input value with thousand separators
        document.getElementById('formattedPrice').addEventListener('input', function(event) {
            // Remove existing commas and dots
            let inputValue = event.target.value.replace(/[,\.]/g, '');

            // Format the number with commas
            let formattedValue = Number(inputValue).toLocaleString('id-ID'); // 'id-ID' for Indonesian locale

            // Update the input value
            event.target.value = formattedValue;
        });
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Explicitly call getCities() after the document has finished loading
            getCities();
        });

        function getCities() {
            var province_code = document.getElementById('province_code').value;
            var city_code = document.getElementById('city_code');

            city_code.options.length = 0;

            $.ajax({
                url: "{{ route('getCities', '') }}/" + province_code,
                type: "GET",
                success: function(data) {
                    city_code.options.length = 0;

                    $.each(data, function(index, city) {
                        var option = new Option(city.name, city.code);
                        if ("{{ $detailProduct->city_code }}" === city.code) {
                            option.setAttribute("selected", "selected");
                        }
                        city_code.append(option);
                    });
                }
            });
        }
    </script> --}}
@endpush
