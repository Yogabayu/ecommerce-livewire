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
                                    <h4>Produk Secara Umum</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama Produk</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-inbox"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" value="{{ $product->name }}"
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
                                            <input type="text" class="form-control" value="{{ $product->short_desc }}"
                                                name="short_desc" required>
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
                                                        <option value="{{ $cat->id }}"
                                                            @if ($cat->id == $product->category_id) selected @endif>
                                                            {{ $cat->name }}</option>
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
                                            <input type="text" class="form-control" value="{{ $product->price }}"
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
                                            <select class="form-control" name="is_hero" id="is_hero" required>
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
                                        <label data-toggle="tooltip" title="Letak Provinsi dari produk">Provinsi</label>
                                        <div class="input-group">
                                            <select name="province_code" id="province_code" class="form-control select2"
                                                onchange="getCities()" required>
                                                <option selected>-</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->code }}"
                                                        @if ($province->code == $detailProduct->province_code) selected @endif>
                                                        {{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label data-toggle="tooltip" title="Letak Kota dari produk">Kota</label>
                                        <div class="input-group">
                                            <select name="city_code" id="city_code" class="form-control select2"
                                                required>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Lengkap</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-location-dot"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="address" id="address" class="form-control"
                                                value="{{ $detailProduct->address }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi Panjang</label>
                                        <div class="input-group">
                                            <textarea class="form-control summernote" name="long_desc" id="long_desc" required>{!! $detailProduct->long_desc !!}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div x-cloak x-data="{ openQue: {{ $detailProduct->lat || $detailProduct->long ? 'true' : 'false' }}, openQue2: false }">
                                        <div x-show="false">
                                            <p>Apakah Ingin ditampilkan dipeta ?</p>
                                            <button @click="openQue = !openQue"
                                                class="btn btn-sm btn-primary my-3 justify-content-start"
                                                type="button">Ya</button>
                                            <button @click="openQue = false"
                                                class="btn btn-sm btn-primary my-3 justify-content-start"
                                                type="button">Tidak</button>
                                        </div>
                                        <div x-show="openQue" class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Latitude</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-map-location-dot"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text" name="lat" id="lat"
                                                            class="form-control" value="{{ $detailProduct->lat }}">
                                                    </div>
                                                    <span class="text-danger">jika tidak ingin ditampilkan di peta beri
                                                        nilai
                                                        0</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Longitude</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-map-location-dot"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text" name="long" id="long"
                                                            class="form-control" value="{{ $detailProduct->long }}">
                                                    </div>
                                                    <span class="text-danger">jika tidak ingin ditampilkan di peta beri
                                                        nilai
                                                        0</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="form-group">
                                        <label>Link Gmaps</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-location-crosshairs"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="gmaps" id="gmaps" class="form-control"
                                                value="{{ $detailProduct->gmaps }}">
                                        </div>
                                        <span class="text-danger">jika tidak ada silahkan di beri nilai 0</span>
                                    </div>
                                    <div x-cloak x-data="{ openLand: {{ $detailProduct->surface_area ? 'true' : 'false' }}, openQue: false }">
                                        <div x-show="openQue">
                                            <p>Apakah Produk berupa Tanah ?</p>
                                            <button @click="openLand = true"
                                                class="btn btn-sm btn-primary my-3 justify-content-start"
                                                type="button">Ya</button>
                                            <button @click="openLand = false"
                                                class="btn btn-sm btn-primary my-3 justify-content-start"
                                                type="button">Tidak</button>
                                        </div>

                                        <div x-show="openLand">
                                            <div class="form-group">
                                                <label>Luas Tanah (m&sup2;)</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-chart-area"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="surface_area" id="surface_area"
                                                        class="form-control" value="{{ $detailProduct->surface_area }}">
                                                </div>
                                                <span class="text-danger">jika tidak ada silahkan di beri nilai 0</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div x-cloak x-data="{ openLand: {{ $detailProduct->building_area ? 'true' : 'false' }}, openQue: false }">
                                        <div x-show="openQue">
                                            <p>Apakah Produk berupa Rumah ?</p>
                                            <button @click="openLand = !openLand"
                                                class="btn btn-sm btn-primary my-3 justify-content-start"
                                                type="button">Ya</button>
                                            <button @click="openLand = false"
                                                class="btn btn-sm btn-primary my-3 justify-content-start"
                                                type="button">Tidak</button>
                                        </div>

                                        <div x-show="openLand">
                                            <div class="form-group">
                                                <label>Luas Rumah (m&sup2;)</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-chart-area"></i>
                                                        </div>
                                                    </div>
                                                    <!-- Gunakan x-model untuk mengikat nilai input -->
                                                    <input
                                                        x-model="openLand ? '{{ $detailProduct->building_area }}' : '0'"
                                                        type="text" name="building_area" id="building_area"
                                                        class="form-control">
                                                </div>
                                                <span class="text-danger">jika tidak ada silahkan di beri nilai 0</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div x-cloak x-data="{ openLand: {{ $detailProduct->after_sale ? 'true' : 'false' }}, openQue: false }">
                                        <div x-show="openQue">
                                            <p>Apakah Produk sedang diskon ?</p>
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
                                                            <i class="fas fa-chart-area"></i>
                                                        </div>
                                                    </div>
                                                    <!-- Gunakan x-model untuk mengikat nilai input -->
                                                    <input x-model="openLand ? '{{ $detailProduct->after_sale }}' : '0'"
                                                        type="text" name="after_sale" id="after_sale"
                                                        class="form-control">
                                                </div>
                                                <span class="text-danger">jika tidak ada silahkan di beri nilai 0</span>
                                            </div>
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
                                        <label>Jenis Penjualan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-question"></i>
                                                </div>
                                            </div>
                                            <select name="type_sales" id="type_sales" class="form-control" required>
                                                <option value="1" @if ($detailProduct->type_sales == 1) selected @endif>
                                                    Lelang
                                                </option>
                                                <option value="0" @if ($detailProduct->type_sales == 0) selected @endif>
                                                    Jual
                                                    Langsung</option>
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
                                                value="{{ $detailProduct->no_pic }}" required>
                                        </div>
                                        <span class="text-danger">contoh: 6212345678912</span>
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
                                    <div class="form-group">
                                        <label for="tags">Tag Produk</label>
                                        <div class="input-group">
                                            <div style="width: 80%">
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
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Simpan</button>
                                    <a href="{{ route('product.index') }}" class="btn btn-secondary mr-1">
                                        Kembali
                                    </a>
                                </div>
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
    <script>
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
    </script>
@endpush
