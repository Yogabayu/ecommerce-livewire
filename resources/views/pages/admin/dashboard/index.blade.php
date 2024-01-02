@extends('layouts.admin.app')
@section('title')
    Dashboard
@endsection
@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('admin/library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/library/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/library/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/library/flag-icon-css/css/flag-icon.min.css') }}">
@endpush
@section('main')
    <div class="main-content">
        <section class="section">
            @if (auth()->user()->role_id == 1)
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Admin</h4>
                                </div>
                                <div class="card-body">
                                    {{ $totalAdmin }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total SPV</h4>
                                </div>
                                <div class="card-body">
                                    {{ $totalSpv }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="far fa-address-book"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Roles</h4>
                                </div>
                                <div class="card-body">
                                    {{ $totalRoles }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Produk</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalProduct }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-secondary">
                            <i class="fa-solid fa-arrow-pointer"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Klik Semua Produk</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalClickProduct }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-share-from-square"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Share Semua Produk</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalShareProduct }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Produk Paling Banyak di lihat</h4>
                            <div class="card-header-action">
                                <a href="{{ route('product.index') }}" class="btn btn-danger">Lihat Selengkapnya <i
                                        class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive table-invoice">
                                <table class="table-striped table">
                                    <tr>
                                        <th>Jumlah Dilihat</th>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($mostViewedProducts as $mv)
                                        <tr>
                                            <td>{{ $mv->seeing_count }}</td>
                                            <td class="font-weight-600">{{ $mv->name }}</td>
                                            <td>Rp{{ $mv->price }}</td>
                                            <td>
                                                <a href="{{ route('product.show', $mv->id) }}"
                                                    class="btn btn-primary">Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-4">
                    <div class="card card-hero">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="far fa-question-circle"></i>
                            </div>
                            <h4>14</h4>
                            <div class="card-description">Customers need help</div>
                        </div>
                        <div class="card-body p-0">
                            <div class="tickets-list">
                                <a href="#" class="ticket-item">
                                    <div class="ticket-title">
                                        <h4>My order hasn't arrived yet</h4>
                                    </div>
                                    <div class="ticket-info">
                                        <div>Laila Tazkiah</div>
                                        <div class="bullet"></div>
                                        <div class="text-primary">1 min ago</div>
                                    </div>
                                </a>
                                <a href="#" class="ticket-item">
                                    <div class="ticket-title">
                                        <h4>Please cancel my order</h4>
                                    </div>
                                    <div class="ticket-info">
                                        <div>Rizal Fakhri</div>
                                        <div class="bullet"></div>
                                        <div>2 hours ago</div>
                                    </div>
                                </a>
                                <a href="#" class="ticket-item">
                                    <div class="ticket-title">
                                        <h4>Do you see my mother?</h4>
                                    </div>
                                    <div class="ticket-info">
                                        <div>Syahdan Ubaidillah</div>
                                        <div class="bullet"></div>
                                        <div>6 hours ago</div>
                                    </div>
                                </a>
                                <a href="features-tickets.html" class="ticket-item ticket-more">
                                    View All <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('admin/library/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('admin/library/chart.js/dist/Chart.js') }}"></script>
    <script src="{{ asset('admin/library/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('admin/library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('admin/library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>


    <!-- Page Specific JS File -->
    <script src="{{ asset('admin/js/page/index.js') }}"></script>
@endpush
