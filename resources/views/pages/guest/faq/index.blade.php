@push('style')
    <style>
        .text-secondary {
            color: #3d5d6f;
        }

        .h4,
        h4 {
            font-size: 1.2rem;
        }

        h2 {
            color: #333;
        }

        .fa,
        .fas {
            font-family: 'FontAwesome';
            font-weight: 400;
            font-size: 1.2rem;
            font-style: normal;
        }

        .right-0 {
            right: 0;
        }

        .top-0 {
            top: 0;
        }

        .h-100 {
            height: 100%;
        }

        a.text-secondary:focus,
        a.text-secondary:hover {
            text-decoration: none;
            color: #22343e;
        }

        #accordion .fa-plus {
            transition: -webkit-transform 0.25s ease-in-out;
            transition: transform 0.25s ease-in-out;
            transition: transform 0.25s ease-in-out, -webkit-transform 0.25s ease-in-out;
        }

        #accordion a[aria-expanded=true] .fa-plus {
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    </style>
@endpush
<div>
    <!-- Hero Section Begin -->
    <livewire:HeadComponent />
    <!-- Hero Section End -->
    {{-- <div class="text-center">
        <h2 class="mt-5 mb-5">FAQ</h2>
    </div> --}}
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('guest/img/background-footer.webp') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>FAQ</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>Frequently Asked Questions</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <section class="container my-5" id="maincontent">
        <section id="accordion">
            @foreach ($faqs as $faq)
                <a class="py-3 d-block h-100 w-100 position-relative z-index-1 pr-1 text-secondary border-top"
                    aria-controls="q{{ $faq->id }}" aria-expanded="false" data-toggle="collapse"
                    href="#q{{ $faq->id }}" role="button">
                    <div class="position-relative">
                        <h2 class="h4 m-0 pr-3">
                            {{ $faq->question }}
                        </h2>
                        <div class="position-absolute top-0 right-0 h-100 d-flex align-items-center">
                            <i class="fa fa-plus"></i>
                        </div>
                    </div>
                </a>
                <div class="collapse" id="q{{ $faq->id }}" style="">
                    <div class="card card-body border-0 p-0">
                        <p>{!! $faq->answer !!}</p>
                    </div>
                </div>
            @endforeach
        </section>
    </section>
</div>
@push('script')
    {{-- <script src="{{ asset('guest/js/main.js') }}"></script> --}}
@endpush
