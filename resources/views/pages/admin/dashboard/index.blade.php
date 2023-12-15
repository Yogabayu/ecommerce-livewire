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
