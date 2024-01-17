@push('style')
    <style>
        .onHover:hover {
            color: blue
        }

        .onHover:visited {
            color: blue
        }
    </style>
@endpush

<div>
    <livewire:HeadComponent />

    {{-- <div class="text-center">
        <h2 class="mt-5 mb-5"></h2>
    </div> --}}

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('guest/img/background-footer.webp') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Prosedur Lelang</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>Prosedur Lelang Bank Arthaya</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <section class="container my-3">
        <ol class="mx-5">
            <li>
                Memiliki akun yang telah terverifikasi pada website <a class="onHover" href="https://lelang.go.id" target="_blank"
                    rel="noopener noreferrer">www.lelang.go.id</a>
            </li>
            <li>
                Nominal jaminan lelang disetorkan ke rekening <i>Virtual Account</i> (VA) sesuai yang dipersyaratkan harus sudah efektif di terima Kantor Pelayanan Kekayaan Negara dan Lelang (KPKNL) sesuai asset  paling lambat 1 (satu) hari sebelum pelaksanaan lelang.
            </li>
            <li>
                Segala biaya yang timbul sebagai akibat mekanisme perbankan menjadi beban peserta lelang.
            </li>
            <li>
                Objek lelang dijual dalam kondisi apa adanya dengan segala konsekuensi atas obyek lelang.
            </li>
            <li>
                Peserta lelang dianggap telah mengetahui/memahami letak dan kondisi obyek lelang sehingga apabila terjadi gugatan, tuntutan, pembatalan/penundaan, lelang terhadap obyek tersebut, pihak - pihak yang berkepentingan/peminat lelang tidak diperkenakan, melakukan tuntutan dalam bentuk apapun kepada Kantor Pelayanan Kekayaan Negara dan Lelang (KPKNL) sesuai aset dan PT Bank Bank Perkreditan Rakyat (BPR) Arthaya Indotama Pusaka.
            </li>
        </ol>

        <table class="table table-bordered my-3">
            <tbody>
                <tr>
                    <td>Cara penawaran lelang</td>
                    <td>Tanpa kehadiran peserta lelang (Closed Bidding) yang dapat diakses pada alamat <a class="onHover" href="https://lelang.go.id" target="_blank" rel="noopener noreferrer">www.lelang.go.id</a></td>
                </tr>
                <tr>
                    <td>Batas akhir penawaran lelang</td>
                    <td>Silahkan lihat di detail masing - masing aset</td>
                </tr>
                <tr>
                    <td>Penetapan pemenang lelang</td>
                    <td>Setelah batas akhir penawaran</td>
                </tr>
                <tr>
                    <td>Pelunasan lelang</td>
                    <td>5 (lima) hari kerja setelah pelaksanaan lelang</td>
                </tr>
                <tr>
                    <td>Bea lelang pembeli</td>
                    <td>2% (dua persen) dari harga lelang</td>
                </tr>
                <tr>
                    <td>Tempat pelaksanaan lelang</td>
                    <td>Silahkan lihat di detail masing - masing aset</td>
                </tr>
                <tr>
                    <td>Informasi lebih lanjut</td>
                    <td>PT Bank Perkreditan Rakyat (BPR) Arthaya Indotama Pusaka (0351) 383224, 082248145140 (Pramuda), 081216155391 (Restu)</td>
                </tr>
            </tbody>
        </table>
    </section>
</div>
@push('script')
<script src="{{ asset('guest/js/main.js') }}"></script>
@endpush