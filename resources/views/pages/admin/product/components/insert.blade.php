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
                <form action="{{ route('product.store') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('post')
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
                                        <label>Apakah akan ditampilkan di Layar Utama (hero)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-eye"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" name="is_hero" id="is_hero" required>
                                                <option value="1">Ya</option>
                                                <option value="0">Tidak</option>
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
                                                    <option value="{{ $province->code }}">{{ $province->name }}</option>
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
                                                maxlength="250" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi Panjang</label>
                                        <div class="input-group">
                                            <textarea class="form-control summernote" name="long_desc" id="long_desc" required></textarea>
                                        </div>
                                    </div>
                                    <div x-cloak x-data="{ openLand: false, openQue: true }">
                                        <div x-show="openQue">
                                            <p>Apakah Produk akan ditampilkan di menu map ?</p>
                                            <button @click="openLand = !openLand"
                                                class="btn btn-sm btn-primary my-3 justify-content-start"
                                                type="button">Ya</button>
                                            <button @click="openLand = false"
                                                class="btn btn-sm btn-primary my-3 justify-content-start"
                                                type="button">Tidak</button>
                                        </div>
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
                                                            class="form-control">
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
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
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
                                    <div x-cloak x-data="{ openLand: false, openQue: true }">
                                        <div x-show="openQue">
                                            <p>Apakah Produk berupa Tanah ?</p>
                                            <button @click="openLand = !openLand"
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
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div x-cloak x-data="{ openLand: false, openQue: true }">
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
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div x-cloak x-data="{ openLand: false, openQue: true }">
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
                                                            <i class="fas fa-tag"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="after_sale" id="formattedPrice2"
                                                        class="form-control">
                                                </div>
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
                                                <option value="1" selected>Lelang</option>
                                                <option value="0">Jual Langsung</option>
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
                                        <label>Photo Produk</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            </div>
                                            <input type="file" name="photos[]" class="form-control"
                                                accept="image/jpeg, image/png" multiple required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tags">Tag Produk</label>
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

        // document.getElementById('province_code').addEventListener('change', function() {
        //     var provinceCode = this.value;

        //     // Menggunakan Ajax untuk mendapatkan data kota berdasarkan provinsi
        //     fetch(`/get-cities/${provinceCode}`)
        //         .then(response => response.json())
        //         .then(data => {
        //             // Menghapus semua opsi kota sebelumnya
        //             var citySelect = document.getElementById('city_code');
        //             citySelect.innerHTML = '<option selected>-</option>';

        //             // Menambahkan opsi kota baru berdasarkan data yang diterima
        //             data.forEach(city => {
        //                 var option = document.createElement('option');
        //                 option.value = city.code;
        //                 option.text = city.name;
        //                 citySelect.add(option);
        //             });
        //         });
        // });
    </script>
@endpush
