@push('style')
    <style>
        .header h1 {
            font-family: 'Raleway', sans-serif;
        }

        .rowTop {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }

        .col-lg-6,
        .col-md-6,
        .col-sm-6 {
            flex-basis: 48%;
            /* Sesuaikan dengan preferensi Anda */
        }

        img {
            max-width: 70%;
            max-height: 70%;
        }
    </style>
@endpush

<div>
    <div class="blog-details spad">
        <div class="container">
            <div class="header">
                <h3>Selamat datang</h3>
                <h4>di Website Lelang Bank Arthaya Indotama Pusaka</h4>
            </div>
            <div class="rowTop">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <p>
                        Website Lelang Bank Arthaya Indotama Pusaka bertujuan untuk menyampaikan informasi terkait
                        data lelang Bank Arthaya Indotama Pusaka yang akan dijual melalui mekanisme lelang maupun
                        penjualan langsung.
                        Lelang Bank Arthaya Indotama Pusaka yang ditampilkan pada website ini berupa properti, alat
                        berat,
                        kendaraan, kapal laut, dan lain-lain yang tersebar di seluruh penjuru Indonesia.
                    </p>
                    <p>
                        Website ini diharapkan dapat menjadi sarana bagi masyarakat dan investor dalam pemenuhan
                        kebutuhan
                        terkait informasi properti, alat berat, kendaraan, kapal laut, dan lain-lain yang dimiliki Bank
                        Arthaya
                        Indotama Pusaka dan menjadi jembatan yang menghubungkan antara calon pembeli dengan pemilik
                        agunan.
                    </p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <img src="{{ asset('guest/img/lelang.png') }}" alt="Lelang Image">
                </div>
            </div>
        </div>
    </div>
</div>
