@push('style')
<style>
    .note {
        font-size: 12px;
        /* Ukuran font */
        color: #666;
        /* Warna teks */
        text-align: justify;
        /* Posisi teks (jika diinginkan) */
        margin-bottom: 10px;
        /* Jarak bawah dari elemen berikutnya */
    }

    .discount {
        font-size: 30px;
        color: #dd2222;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .normal-price {
        display: inline-block;
        font-weight: 400;
        text-decoration: line-through;
        margin-left: 10px;
    }

    .tag {
        height: 45px;
        width: 45px;
        background: #dd2222;
        border-radius: 50%;
        font-size: 14px;
        color: #ffffff;
        line-height: 45px;
        text-align: center;
        position: absolute;
        left: 15px;
        top: 15px;
    }
</style>
@endpush
<div>
    <livewire:headcomponent />
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="filter_item">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="filter__sort">
                                    <span>Urutkan </span>
                                    <button class="btn btn-sm {{ $state == 0 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(0)'>Default</button>
                                    <button class="btn btn-sm {{ $state == 1 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(1)'>Terbaru</button>
                                    <button class="btn btn-sm {{ $state == 2 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(2)'>
                                        Terlama</button>
                                    <button class="btn btn-sm {{ $state == 3 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(3)'>
                                        A-Z</button>
                                    <button class="btn btn-sm {{ $state == 4 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(4)'>
                                        Z-A</button>
                                    <button class="btn btn-sm {{ $state == 5 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(5)'>
                                        Termahal</button>
                                    <button class="btn btn-sm {{ $state == 6 ? 'btn-primary' : 'btn-secondary' }}"
                                        wire:click='updateSortState(6)'>
                                        Termurah</button>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="filter__found">
                                    <h6>Terkait: <span>{{ $inputText }}</span></h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="filter__found">
                                    <h6><span>{{ $countProduct }}</span> Produk ditemukan</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 1rem">
                        @if ($results->isEmpty())
                            <div class="col-12 text-center">
                                <p>***Produck tidak ditemukan***</p>
                                <p>***Coba Cari dengan kata kunci lain***</p>
                            </div>
                        @else
                            @foreach ($results as $sp)
                                <div class="col-lg-4 col-md-6 col-sm-6" wire:key='{{ $sp->id }}'>
                                    <div class="product__item">
                                        <div class="product__item__pic">
                                            <img class="imgSpecial" src="{{ url('storage/photos/' . $sp->photo) }}"
                                                alt="{{ $setting->name_app }}" srcset="">
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-eye"></i>
                                                        {{ $sp->seeing_count }}</a></li>
                                                <li><a href="#"><i class="fa fa-share"></i>
                                                        {{ $sp->share_count }}</a></li>
                                                <li><a href="{{ route('detailproduct', ['slug' => $sp->slug]) }}"><i
                                                            class="fa fa-info"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6><a href="#">{{ $sp->name }}</a></h6>
                                            <h5>Rp.{{ $sp->price }}</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="product__pagination">
                        {{ $results->links() }}
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($relatedProducts as $rp)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic" >
                            <img class="imgSpecial" src="{{ Storage::url('photos/' . $rp->photo) }}" srcset="">
                            @if ($rp->after_sale)
                            <div class="tag">Sale</div>
                            @endif
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-eye"></i> {{ $rp->seeing_count }}</a></li>
                                <li><a href="#"><i class="fa fa-share"></i> {{ $rp->share_count }}</a></li>
                                <li><a href="{{ route('detailproduct', ['slug' => $rp->slug]) }}"><i
                                            class="fa fa-info"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="{{ route('detailproduct', ['slug' => $rp->slug]) }}">{{ $rp->name }}</a>
                            </h6>
                            <h5>Rp.{{ $rp->price }}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
</div>
