@extends('layouts.admin.app')

@section('title')
    Tambah Asset
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
                    <h1>Asset</h1>
                </div>
            </div>

            <div class="section-body">
                <form action="{{ route('product.store') }}" enctype="multipart/form-data" method="post" id="formInsert">
                    @csrf
                    @method('post')
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
                                                name="name" required>
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
                                                name="short_desc" maxlength="250" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <div class="input-group">
                                            <div style="width: 80%">
                                                <select name="category_id" id="category_id" class="form-control select2"
                                                    required>
                                                    <option selected>-</option>
                                                    @foreach ($categories as $cat)
                                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <a class="btn btn-info btn-sm" title="add category" data-toggle="modal"
                                                        data-target="#AddCategoryModal" data-backdrop="false">
                                                        <i class="fas fa-add"></i> Tambah Kategori
                                                    </a>
                                                </div>
                                            </div>
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
                                                name="price" id="formattedPrice" required>
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
                                            <select class="form-control" name="publish" id="publish" required>
                                                <option value="1">Ya</option>
                                                <option value="0">Tidak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Apakah akan ditampilkan di Layar Utama (hero/highlight)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-eye"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" name="is_hero" id="is_hero" required>
                                                <option value="1">Ya</option>
                                                <option value="0" selected>Tidak</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4>Detail Asset</h4>
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
                                                maxlength="250" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi Lengkap</label>
                                        <div class="input-group">
                                            <textarea class="form-control summernote" name="long_desc" id="long_desc" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Link Gmaps</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-location-crosshairs"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="gmaps" id="gmaps" class="form-control">
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
                                            <select name="type_sales" id="type_sales" class="form-control" required>
                                                <option value="1" selected>Lelang</option>
                                                <option value="2">Dibawah Tangan</option>
                                            </select>
                                        </div>
                                    </div>
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
                                                placeholder="6212345678912" required>
                                        </div>
                                        <span class="text-danger">contoh: 6212345678912</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Photo Asset</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            </div>
                                            <input type="file" name="photos[]" id="photoInput" class="form-control"
                                                accept="image/jpeg, image/png" multiple required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Dokumen Pendukung (jika ada)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-file"></i>
                                                </div>
                                            </div>
                                            <input type="file" name="sup_doc" id="sup_doc" class="form-control"
                                                accept=".pdf">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tags">Tag Asset</label>
                                        <div class="input-group">
                                            <div style="width: 80%">
                                                <select class="form-control select2" multiple="multiple" id="tags"
                                                    name="tags[]" required>
                                                    @foreach ($tags as $tag)
                                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <a class="btn btn-info btn-sm" title="add tag" data-toggle="modal"
                                                        data-target="#AddTagModal" data-backdrop="false">
                                                        <i class="fas fa-add"></i> Tambah Tag
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- informasi lain --}}
                            <div x-cloak x-data="{ openLand: false, openQue: true }">
                                <div x-show="openQue">
                                    <p>Apakah Ingin menambahkan informasi lain ?</p>
                                    <button @click="openLand = !openLand"
                                        class="btn btn-sm btn-primary my-3 justify-content-start"
                                        type="button">Ya</button>
                                    <button @click="openLand = false"
                                        class="btn btn-sm btn-primary my-3 justify-content-start"
                                        type="button">Tidak</button>
                                </div>

                                <div x-show="openLand">
                                    {{-- semua yg berkaitan dengan tanah/bangunan --}}
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Isi Form dibawah jika berupa tanah/bangunan</h4>
                                        </div>
                                        <div class="card-body">
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
                                                        class="form-control" x-model="surface_area">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Luas Bangunan (m&sup2;)</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            {{-- <i class="fas fa-house"></i> --}}
                                                            LB
                                                        </div>
                                                    </div>
                                                    <input type="number" name="building_area" id="building_area"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Jumlah Kamar Tidur</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-bed"></i>
                                                        </div>
                                                    </div>
                                                    <input type="number" name="bedroom" id="bedroom"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Jumlah Kamar mandi</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-bath"></i>
                                                        </div>
                                                    </div>
                                                    <input type="number" name="bathroom_area" id="bathroom_area"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Jumlah Lantai</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            {{-- <i class="fas fa-chart-area"></i> --}}
                                                            JL
                                                        </div>
                                                    </div>
                                                    <input type="number" name="floors" id="floors"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Jumlah Garasi</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-warehouse"></i>
                                                        </div>
                                                    </div>
                                                    <input type="number" name="garage" id="garage"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis Sertifikat</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-certificate"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="certificate" id="certificate"
                                                        class="form-control" placeholder="contoh: SHM">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Daya Listrik</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-bolt"></i>
                                                        </div>
                                                    </div>
                                                    <input type="number" name="electrical_power" id="electrical_power"
                                                        class="form-control">
                                                </div>
                                                <span class="text-danger">satuan Kwh</span>
                                            </div>
                                            <div class="form-group">
                                                <label>Tahun Bangun</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                    <input type="number" name="building_year" id="building_year"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    {{-- semua yg berkaitan dengan kendaraan --}}
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>
                                                Isi Form Dibawah jika berupa kendaraan
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Nomor Rangka</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-gear"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="chassis_number" id="chassis_number"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor Mesin</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-gear"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="machine_number" id="machine_number"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Merk</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-gear"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="brand" id="brand"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Seri</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-gear"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="series" id="series"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Kilometer</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-gear"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="kilometers" id="kilometers"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis CC</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-gear"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="cc" id="cc"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Tipe</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-gear"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="type" id="type"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Warna</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-gear"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="color" id="color"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Transmisi</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-gear"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="transmission" id="transmission"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Tahun (khusus aset kendaraan)</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="vehicle_year" id="vehicle_year"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal STNK</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="date_stnk" id="date_stnk"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- jadwal lelang --}}
                            {{-- <div class="card">
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
                                                required>
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
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- diskon --}}
                            <div x-cloak x-data="{ openLand: false, openQue: true }">
                                <div x-show="openQue">
                                    <p>Apakah Asset sedang diskon ?</p>
                                    <button @click="openLand = !openLand"
                                        class="btn btn-sm btn-primary my-3 justify-content-start"
                                        type="button">Ya</button>
                                    <button @click="openLand = false"
                                        class="btn btn-sm btn-primary my-3 justify-content-start"
                                        type="button">Tidak</button>
                                </div>

                                <div x-show="openLand">
                                    <div class="form-group">
                                        <label>Harga Setelah diskon</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-tag"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="after_sale" id="formattedPrice2"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- jadwal lelang --}}
                            <div x-cloak x-data="{ openSchedule: false, openQue: true }">
                                <div x-show="openQue">
                                    <p>Apakah ingin menyertakan jadwal lelang aset ?</p>
                                    <button @click="openSchedule = !openSchedule"
                                        class="btn btn-sm btn-primary my-3 justify-content-start"
                                        type="button">Ya</button>
                                    <button @click="openSchedule = false"
                                        class="btn btn-sm btn-primary my-3 justify-content-start"
                                        type="button">Tidak</button>
                                </div>

                                <div x-show="openSchedule">
                                    <div class="card">
                                        <div class="card-header">
                                            Jadwal Lelang
                                        </div>
                                        <div class="card-body">
                                            <input type="hidden" name="isScheduled"
                                                x-bind:value="openSchedule ? '1' : '0'">
                                            <div class="form-group">
                                                <label>Tanggal Lelang (WIB)</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                    <input type="datetime-local" name="schedule" id="schedule"
                                                        class="form-control" >
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
                                                    <input type="text" name="kpknl" id="kpknl"
                                                        class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- akses ke fasilitas umum --}}
                            <div x-cloak x-data="{ openLand: false, openQue: true }">
                                <div x-show="openQue">
                                    <p>Apakah ingin menyertakan akses ke fasilitas umum ?</p>
                                    <button @click="openLand = !openLand"
                                        class="btn btn-sm btn-primary my-3 justify-content-start"
                                        type="button">Ya</button>
                                    <button @click="openLand = false"
                                        class="btn btn-sm btn-primary my-3 justify-content-start"
                                        type="button">Tidak</button>
                                </div>

                                <div x-show="openLand">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Akses ke Fasilitas Umum</h4>
                                        </div>
                                        <div class="card-body">
                                            <input type="hidden" name="isPublicFacilities"
                                                x-bind:value="openLand ? '1' : '0'">
                                            {{-- rumah sakit --}}
                                            <div class="form-group">
                                                <label>Akses Rumah Sakit ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-hospital"></i>
                                                        </div>
                                                    </div>
                                                    <select name="hospital" id="hospital" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- sekolah --}}
                                            <div class="form-group">
                                                <label>Akses Sekolah ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-school"></i>
                                                        </div>
                                                    </div>
                                                    <select name="school" id="school" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- bank/atm --}}
                                            <div class="form-group">
                                                <label>Akses Bank / ATM ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-building-columns"></i>
                                                        </div>
                                                    </div>
                                                    <select name="bank" id="bank" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- pasar --}}
                                            <div class="form-group">
                                                <label>Akses Pasar ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-store"></i>
                                                        </div>
                                                    </div>
                                                    <select name="market" id="market" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- rumah ibadah --}}
                                            <div class="form-group">
                                                <label>Akses Rumah Ibadah ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-place-of-worship"></i>
                                                        </div>
                                                    </div>
                                                    <select name="house_of_worship" id="house_of_worship"
                                                        class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- bioskop --}}
                                            <div class="form-group">
                                                <label>Akses Bioskop ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-film"></i>
                                                        </div>
                                                    </div>
                                                    <select name="cinema" id="cinema" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- halte --}}
                                            <div class="form-group">
                                                <label>Akses Halte ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-bus"></i>
                                                        </div>
                                                    </div>
                                                    <select name="halte" id="halte" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- bandara --}}
                                            <div class="form-group">
                                                <label>Akses Bandara ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-plane"></i>
                                                        </div>
                                                    </div>
                                                    <select name="airport" id="airport" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- toll --}}
                                            <div class="form-group">
                                                <label>Akses toll ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-road-bridge"></i>
                                                        </div>
                                                    </div>
                                                    <select name="toll" id="toll" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- mall --}}
                                            <div class="form-group">
                                                <label>Akses Mall ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-cart-shopping"></i>
                                                        </div>
                                                    </div>
                                                    <select name="mall" id="mall" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- taman --}}
                                            <div class="form-group">
                                                <label>Akses Taman ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-tree"></i>
                                                        </div>
                                                    </div>
                                                    <select name="park" id="park" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- farmasi --}}
                                            <div class="form-group">
                                                <label>Akses Farmasi (apotek, dsb) ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-stethoscope"></i>
                                                        </div>
                                                    </div>
                                                    <select name="pharmacy" id="pharmacy" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- restoran --}}
                                            <div class="form-group">
                                                <label>Akses Restoran ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-utensils"></i>
                                                        </div>
                                                    </div>
                                                    <select name="restaurant" id="restaurant" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- stasiun --}}
                                            <div class="form-group">
                                                <label>Akses Stasiun ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-train"></i>
                                                        </div>
                                                    </div>
                                                    <select name="station" id="station" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- spklu/spbu --}}
                                            <div class="form-group">
                                                <label>Akses SPBU/SPKLU ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-gas-pump"></i>
                                                        </div>
                                                    </div>
                                                    <select name="gas_station" id="gas_station" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- others --}}
                                            <div class="form-group">
                                                <label>Keterangan lain terkait fasilitas umum:</label>
                                                <div class="input-group">
                                                    <textarea class="form-control summernote" name="others_fac_pub" id="others_fac_pub" ></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- fasilitas aset --}}
                            <div x-cloak x-data="{ openLand: false, openQue: true }">
                                <div x-show="openQue">
                                    <p>Apakah ingin menyertakan fasilitas asset ?</p>
                                    <button @click="openLand = !openLand"
                                        class="btn btn-sm btn-primary my-3 justify-content-start"
                                        type="button">Ya</button>
                                    <button @click="openLand = false"
                                        class="btn btn-sm btn-primary my-3 justify-content-start"
                                        type="button">Tidak</button>
                                </div>
                                <div x-show="openLand">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Fasilitas Aset</h4>
                                        </div>
                                        <div class="card-body">
                                            <input type="hidden" name="isAssetFacilities"
                                                x-bind:value="openLand ? '1' : '0'">
                                            
                                            {{-- perabotan --}}
                                            <div class="form-group">
                                                <label>Perabotan ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-couch"></i>
                                                        </div>
                                                    </div>
                                                    <select name="furnished" id="furnished" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- kolam renang --}}
                                            {{-- <div class="form-group">
                                                <label>Kolam Renang ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-person-swimming"></i>
                                                        </div>
                                                    </div>
                                                    <select name="swimming_pool" id="swimming_pool" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div> --}}
                                            {{-- Lift --}}
                                            {{-- <div class="form-group">
                                                <label>Lift ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-elevator"></i>
                                                        </div>
                                                    </div>
                                                    <select name="lift" id="lift" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div> --}}
                                            {{-- gym --}}
                                            {{-- <div class="form-group">
                                                <label>Gym ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-dumbbell"></i>
                                                        </div>
                                                    </div>
                                                    <select name="gym" id="gym" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div> --}}
                                            {{-- parkir --}}
                                            <div class="form-group">
                                                <label>Parkir/carport ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-square-parking"></i>
                                                        </div>
                                                    </div>
                                                    <select name="carport" id="carport" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- telepon --}}
                                            <div class="form-group">
                                                <label>Sambungan Telepone ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-phone"></i>
                                                        </div>
                                                    </div>
                                                    <select name="telephone" id="telephone" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- keamanan --}}
                                            <div class="form-group">
                                                <label>Keamanan ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-user-shield"></i>
                                                        </div>
                                                    </div>
                                                    <select name="security" id="security" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- garasi --}}
                                            <div class="form-group">
                                                <label>Garasi ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-warehouse"></i>
                                                        </div>
                                                    </div>
                                                    <select name="fasgarage" id="fasgarage" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- taman --}}
                                            <div class="form-group">
                                                <label>Taman ?</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-tree"></i>
                                                        </div>
                                                    </div>
                                                    <select name="faspark" id="faspark" class="form-control">
                                                        <option value="1" selected>Ada</option>
                                                        <option value="0">Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- others --}}
                                            <div class="form-group">
                                                <label>Keterangan lain terkait fasilitas aset:</label>
                                                <div class="input-group">
                                                    <textarea class="form-control summernote" name="others_fac_aset" id="others_fac_aset" ></textarea>
                                                </div>
                                            </div>
                                        </div>
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
        $("#table-1").dataTable({
            responsive: true,
            paging: true,
            pagingType: 'full_numbers',
        });
    </script>
    <script>
        function confirmDelete(deleteUrl) {
            Swal.fire({
                title: 'Apakah anda yakin menghapus data?',
                text: 'Data yang dihapus tidak dapat dipulihkan',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, lanjutkan !'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user clicks "Yes," submit the form
                    var form = document.createElement('form');
                    form.action = deleteUrl;
                    form.method = 'POST';
                    form.style.display = 'none';

                    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Append CSRF token to the form
                    var csrfInput = document.createElement('input');
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    form.appendChild(csrfInput);

                    // Append a method spoofing input for DELETE request
                    var methodInput = document.createElement('input');
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
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
        document.getElementById('formattedPrice2').addEventListener('input', function(event) {
            // Remove existing commas and dots
            let inputValue = event.target.value.replace(/[,\.]/g, '');

            // Format the number with commas
            let formattedValue = Number(inputValue).toLocaleString('id-ID'); // 'id-ID' for Indonesian locale

            // Update the input value
            event.target.value = formattedValue;
        });
    </script>
    <script>
        document.getElementById('photoInput').addEventListener('change', function(e) {
            var files = e.target.files;
            var minFiles = 5;

            if (files.length < minFiles) {
                alert('Harap unggah minimal 5 file.');
                $(document).off('submit', '#formInsert'); 
                $(document).on('submit', '#formInsert', function(ev) {
                    ev.preventDefault(); 
                });
            } else {
                $(document).off('submit', '#formInsert'); 
                $(document).on('submit', '#formInsert', function(ev) {
                    // You can include any additional logic or processing for the form submission here
                    // For example, you can remove the event handler after successful submission
                    $(document).off('submit', '#formInsert');
                    // Then, you can submit the form
                    $('#formInsert').submit();
                });
            }
        });
    </script>
    {{-- <script>
        function getCities() {
            var province_code = document.getElementById('province_code').value;
            var city_code = document.getElementById('city_code');

            // Empty the city options before fetching new data
            city_code.options.length = 0;

            $.ajax({
                url: "{{ route('getCities', '') }}/" + province_code, // Remove the quotes around province_code
                type: "GET",
                success: function(data) {
                    // Empty the city options after fetching new data
                    city_code.options.length = 0;

                    $.each(data, function(index, city) {
                        // Create option using the correct approach
                        var option = new Option(city.name, city.code);
                        // Append the option to the select element
                        city_code.append(option);
                    });
                }
            });
        }
    </script> --}}
@endpush
