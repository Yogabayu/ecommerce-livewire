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

    <div class="text-center">
        <h2 class="mt-5 mb-5">Prosedur Lelang Bank Arthaya</h2>
    </div>

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
            {{-- <li>
                Cari aset sesuai lokasi, harga dan preferensi keinginanmu. Dapat dengan melakukan cari berdasarkan
                lokasi atau nama aset.
            </li>
            <li>
                Pilih aset yang diinginkan, akan muncul detail aset berupa foto, deskripsi, informasi kelengkapan, akses
                dan fasilitas, lokasi yang dapat diklik ke Google Maps, nomor HP petugas Bank Arthaya dan kalkulator
                KPR.
            </li>
            <li>
                Untuk mengetahui lokasi dan kondisi aset dapat menghubungi lebih lanjut petugas Bank Arthaya yang
                mengelola aset tersebut, dimana
                nomor Whatsapp dapat secara langsung diklik di halaman aset.
            </li>
            <li>
                Lelang adalah penjualan aset yang terbuka untuk umum dengan penawaran harga secara tertulis dan atau
                lisan yang semakin
                meningkat atau menurun untuk mencapai harga tertinggi yang didahului dengan Pengumuman Lelang. Aset yang
                diinformasikan
                dengan status dilelang adalah aset yang transaksi jual belinya dilakukan dengan mekanisme lelang sesuai
                ketentuan di
                link berikut: <a class="onHover" href="https://portal.lelang.go.id/page/syarat-dan-ketentuan" target="_blank"
                    rel="noopener noreferrer">https://portal.lelang.go.id/page/syarat-dan-ketentuan</a>
            </li>
            <li>
                Apabila pada detail aset lelang sudah terdapat link lelang online, maka calon pembeli dapat melanjutkan
                ke mekanisme
                lelang online di lelang.go.id dengan terlebih dahulu sudah melakukan registrasi dan aktivasi sesuai
                syarat dan
                ketentuan.
            </li>
            <li>
                Pastikan dokumen aset tersebut sudah sesuai dan valid.
            </li>
            <li>
                Melakukan pelunasan dan melengkapi berkas sesuai ketentuan.
            </li> --}}
        </ol>

        {{-- <table class="table table-bordered">
            <tbody>
                <tr>
                    Cara penawaran lelang
                </tr>
                <tr>
                    Tanpa kehadiran peserta lelang (Closed Bidding) yang dapat diakses pada alamat <a class="onHover" href="https://lelang.go.id" target="_blank" rel="noopener noreferrer">www.lelang.go.id</a>
                </tr>
            </tbody>
        </table> --}}

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
