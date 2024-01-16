@push('style')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="{{ asset('admin/library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/library/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/library/codemirror/theme/duotone-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/library/select2/dist/css/select2.min.css') }}"> --}}


    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

<div>
    <livewire:HeadComponent />
    <!-- Breadcrumb Section Begin -->
    <section wire:ignore class="breadcrumb-section set-bg"
        style="background-image: url('{{ asset('guest/img/background-footer.webp') }}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ $setting->name_app }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>Jadwal Lelang</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="margin-top:3%; margin-bottom:3%">
        <div class="container" style="box-shadow: 3px 1px 3px 3px #cccccc; padding: 2rem; border-radius: 0.5rem">
            <h4 class="font-weight: 700">Jadwal Lelang</h4>
            <div class="my-3 ">
                <form wire:submit.prevent='filter'>
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-2 col-12">
                            <div class="form-group mx-3 d-flex justify-content-center">
                                <select class="form-select" aria-label="kategori" wire:model.live="getCat">
                                    <option selected disabled>Pilih Kategori</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-2 col-lg-3 col-12">
                            <div class="form-group mx-3 d-flex justify-content-center">
                                <input type="month" id="monthInput" name="monthInput" class="form-control"
                                    placeholder="Pilih Bulan" wire:model="getMonth">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-2 col-lg-3 col-12">
                            <div class="form-group mx-3 d-flex justify-content-center">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            KPKNL
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" wire:model="getKpknl">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-2 col-lg-3 col-12">
                            <div class="form-group mx-3 d-flex justify-content-center">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                                viewBox="0 0 512 512">
                                                <path
                                                    d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="nama aset"
                                        wire:model="getName">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-2 col-lg-1 col-12 text-lg-end">
                            <div class="form-group mx-3 d-flex justify-content-center">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="my-3">
                @if ($datas->isEmpty())
                    <div class="col-12 text-center">
                        <p>***Produck tidak ditemukan***</p>
                        <p>***Coba Cari dengan kata kunci lain***</p>
                    </div>
                @else
                    @foreach ($datas as $d)
                        <a href="{{ route('detailproduct', ['slug' => $d->slug]) }}" style="color:#000000">
                            <div class="row my-2">
                                <div class="col-sm-12 col-md-2 col-lg-2 col-12"
                                    style="background-image: url('{{ asset('storage/public/photos/' . $d->photo) }}');background-size: cover; background-position: center; border-radius:0.5rem;">
                                </div>
                                <div class="col-sm-12 col-md-7 col-lg-7 col-12 ">
                                    <h4>{{ $d->name }}</h4>

                                    <div class="row d-flex justify-content-center align-items-center text-center my-2">
                                        <div class="col">
                                            <div class="col font-weight-bold">Tempat Pelaksanaan lelang</div>
                                            <div class="col">KPKNL {{ $d->kpknl }}</div>
                                        </div>
                                        <div class="col">
                                            <div class="col font-weight-bold">Jadwal</div>
                                            <div class="col">
                                                {{ \Carbon\Carbon::parse($d->schedule)->format('d/m/Y') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col-sm-12 col-md-3 col-lg-3 col-12 d-flex justify-content-center align-items-center text-center">
                                    KPKNL {{ $d->kpknl }}
                                </div>
                            </div>
                        </a>
                    @endforeach
                    {{ $datas->links() }}
                @endif

            </div>
        </div>
    </section>
</div>

@push('script')
    {{-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('admin/library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('admin/library/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('admin/library/codemirror/mode/javascript/javascript.js') }}"></script>
    <script src="{{ asset('admin/library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('admin/library/select2/dist/js/select2.full.min.js') }}"></script> --}}
    <script>
        // Get the current date
        var currentDate = new Date();

        // Get the current year and month in the "YYYY-MM" format
        var currentYear = currentDate.getFullYear();
        var currentMonth = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Adjust month format

        // Set the default value for the input
        document.getElementById('monthInput').value = `${currentYear}-${currentMonth}`;
    </script>
@endpush
