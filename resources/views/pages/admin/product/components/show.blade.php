@extends('layouts.admin.app')

@section('title')
    Tambah Produk
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
                                        <input type="text" class="form-control" placeholder="Masukkan nama produk"
                                            name="name" value="{{ $product->name }}" readonly>
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
                                            name="short_desc" value="{{ $product->short_desc }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <div class="input-group">
                                        <select name="category_id" id="category_id" class="form-control" disabled>
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
                                        <input type="text" class="form-control" placeholder="harga produk" name="price"
                                            id="formattedPrice" value="{{ $product->price }}" readonly>
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
                                        <select class="form-control" name="publish" id="publish" disabled>
                                            <option value="1" @if ($product->publish == 1) selected @endif>Ya
                                            </option>
                                            <option value="0" @if ($product->publish == 0) selected @endif>Tidak
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
                                        <select class="form-control" name="is_hero" id="is_hero" disabled>
                                            <option value="1" @if ($product->is_hero == 1) selected @endif>Ya
                                            </option>
                                            <option value="0" @if ($product->is_hero == 0) selected @endif>Tidak
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
                                        <input type="text"
                                            class="form-control"value="{{ $detailProduct->name_province }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label data-toggle="tooltip" title="Letak Kota dari produk">Kota</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"value="{{ $detailProduct->name_city }}"
                                            readonly>
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
                                            value="{{ $detailProduct->address }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Panjang</label>
                                    <div class="input-group">
                                        <textarea class="form-control summernote" name="long_desc" id="long_desc" readonly>{!! $detailProduct->long_desc !!}</textarea>
                                    </div>
                                </div>
                                <div x-cloak x-data="{ openLand: {{ $detailProduct->lat || $detailProduct->long ? 'true' : 'false' }} }">
                                    <div x-show="openLand" class="row">
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
                                                        class="form-control" value="{{ $detailProduct->lat }}" readonly>
                                                </div>
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
                                                        class="form-control" value="{{ $detailProduct->long }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Link Gmaps</label>
                                    <div class="input-group">
                                        <div style="width: 75%">
                                            <input type="text" name="gmaps" id="gmaps" class="form-control"
                                                value="{{ $detailProduct->gmaps }}" readonly>
                                        </div>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <a href="{{ $detailProduct->gmaps }}" target="_blank"
                                                    rel="noopener noreferrer" class="btn btn-sm btn-primary">cek link</a>
                                            </div>
                                        </div>
                                    </div>
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
                                                    class="form-control" value="{{ $detailProduct->surface_area }}"
                                                    readonly>
                                            </div>
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
                                                <input type="text" name="building_area" id="building_area"
                                                    class="form-control" value="{{ $detailProduct->surface_area }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div x-cloak x-data="{ openLand: {{ $detailProduct->after_sale ? 'true' : 'false' }}, openQue: false }">
                                    <div x-show="openQue">
                                        <p>Apakah Produk sedang diskon ?</p>
                                        <button @click="openLand = true"
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
                                                <input type="text" name="after_sale" id="after_sale"
                                                    class="form-control" value="{{ $detailProduct->after_sale }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Dokumen Pendukung (jika ada)</label>
                                    <div class="input-group">
                                        <iframe src="{{ Storage::url('sup_doc/' . $detailProduct->sup_doc) }}"
                                            frameborder="1" width="100%" height="300px"></iframe>
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
                                        <select name="type_sales" id="type_sales" class="form-control" disabled>
                                            <option value="1" @if ($detailProduct->type_sales == 1) selected @endif>Lelang
                                            </option>
                                            <option value="0" @if ($detailProduct->type_sales == 0) selected @endif>Jual
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
                                            value="{{ $detailProduct->no_pic }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Photo Produk</label>
                                    <div class="row">
                                        @foreach ($productPhotos as $pp)
                                            <div class="col-6 col-md-3 mb-3">
                                                <img src="{{ Storage::url('photos/' . $pp->photo) }}"
                                                    alt="{{ $pp->photo }}" class="img-fluid">

                                                @if ($pp->is_primary == 1)
                                                    <p class="text-center mt-2">Gambar Utama</p>
                                                @endif

                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tags">Tag Produk</label>
                                    <div class="input-group">
                                        <select class="form-control select2" multiple="multiple" id="tags"
                                            name="tags[]" disabled>
                                            @foreach ($productTags as $tag)
                                                <option selected>{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary mr-1">
                                    Edit
                                </a>
                                <a href="{{ route('product.index') }}" class="btn btn-secondary mr-1">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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
        $('.summernote').summernote('disable');
    </script>
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
    </script>
    <script>
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
    </script>
@endpush
