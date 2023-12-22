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

        .contact-link:hover {
            color: #350f72;
            ;
        }
    </style>
@endpush

<div>
    <div class="blog-details spad">
        <div class="container">
            <div class="header">
                <h3>
                    Privasi dan Kebijakan</h3>
            </div>
            <div class="rowTop">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p>
                        Selamat datang di Website Lelang Bank Arthaya Indotama Pusaka. Kami berkomitmen untuk melindungi
                        privasi informasi pribadi Anda. Kebijakan privasi ini menjelaskan bagaimana kami mengumpulkan,
                        menggunakan, dan melindungi informasi pribadi yang Anda berikan saat menggunakan situs web kami.
                    </p>
                    <h4>Informasi yang Kami Kumpulkan</h4>
                    <p>
                        Kami <b>tidak</b> mengumpulkan informasi pribadi seperti nama, alamat, nomor telepon, dan alamat
                        email
                        saat Anda mendaftar atau berinteraksi dengan layanan kami. Selain itu, informasi non-pribadi
                        seperti alamat IP, jenis browser, dan data penggunaan situs web juga <b>tidak</b> kami
                        kumpulkan.
                    </p>
                    <h4>Penggunaan Informasi</h4>
                    <p>
                        Informasi yang kami kumpulkan digunakan untuk menyediakan layanan, memahami kebutuhan pengguna,
                        memproses transaksi, dan memperbaiki kualitas layanan kami. Kami tidak akan membagikan informasi
                        pribadi Anda kepada pihak ketiga tanpa izin Anda, kecuali jika diperlukan oleh hukum atau untuk
                        melindungi keamanan pengguna dan layanan kami.
                    </p>
                    <h4>Keamanan</h4>
                    <p>
                        Kami mengambil langkah-langkah keamanan yang sesuai untuk melindungi informasi pribadi Anda dari
                        akses yang tidak sah, pengungkapan, perubahan, dan penghancuran. Meskipun demikian, perlu
                        diingat bahwa tidak ada metode pengiriman data melalui internet atau metode penyimpanan
                        elektronik yang 100% aman.
                    </p>
                    <h4>Cookie</h4>
                    <p>
                        Situs web kami dapat menggunakan cookie untuk mempersonalisasi pengalaman pengguna. Cookie
                        adalah file kecil yang disimpan di komputer pengguna untuk melacak informasi tentang penggunaan
                        situs web. Pengguna dapat menonaktifkan cookie melalui pengaturan browser mereka, namun ini
                        dapat memengaruhi fungsionalitas situs.
                    </p>
                    <h4>Perubahan pada Kebijakan Privasi</h4>
                    <p>
                        Kebijakan privasi ini dapat diubah atau diperbarui dari waktu ke waktu. Perubahan akan
                        diberitahukan melalui situs web kami. Pengguna disarankan untuk memeriksa kebijakan privasi ini
                        secara berkala.
                    </p>
                    <p>
                        Dengan menggunakan situs web kami, Anda menyetujui kebijakan privasi ini. Jika Anda memiliki
                        pertanyaan atau kekhawatiran tentang pengumpulan atau penggunaan informasi pribadi Anda, silakan
                        hubungi kami melalui <a class="contact-link" href="http://wa.me/{{ $setting->main_tlp }}"
                            target="_blank" rel="noopener noreferrer">kontak kami</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
