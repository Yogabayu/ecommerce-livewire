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
        <h2 class="mt-5 mb-5">Prosedur Info Lelang Bank Arthaya</h2>
    </div>

    <section class="container my-5">
        <ol class="mx-5">
            <li>
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
            </li>
        </ol>
    </section>
</div>
