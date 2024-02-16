@push('style')
    <style>
        .hover-bg:hover {
            color: #96d424;
            font-weight: 900;
        }

        .prod_count {
            margin-top: 0.7rem;
            display: inline-block;
            min-width: 10px;
            padding: 3px 7px;
            font-size: 12px;
            font-weight: bold;
            line-height: 1;
            color: #ffffff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            background-color: #350f72;
            border-radius: 10px;
        }
    </style>
@endpush
<div>
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Semua Kategori.</span>
                        </div>
                        <ul>
                            @foreach ($categories as $cat)
                                <li wire:key='{{ $cat->name }}' class="hover-bg">
                                    <div class="row" style="display: flex; justify-content: space-between;margin-right:2rem">
                                        <a href="{{ route('search', ['category' => $cat->name]) }}">{{ $cat->name }}</a>
                                        @if ($cat->prod_count)
                                        <p class="prod_count">{{ $cat->prod_count }}</p>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <livewire:SearchBoxComponent />
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+ {{ $setting->main_tlp }}</h5>
                                <span>Always Supporting You</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
