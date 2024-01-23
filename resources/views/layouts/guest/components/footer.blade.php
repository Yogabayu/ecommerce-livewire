<!-- Footer Section Begin -->
<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('storage/public/setting/' . $setting->logo) }}"
                                alt="{{ $setting->name_app }}" style="max-width: 120px; max-height: 50px">
                        </a>
                    </div>
                    <ul>
                        <li>Alamat: {{ $setting->address }}</li>
                        <li>Phone: +{{ $setting->main_tlp }}</li>
                        <li>Email: {{ $setting->email }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6>Tautan Lain</h6>
                    <ul>
                        <li><a href="{{ route('aboutus') }}">Tentang Kami</a></li>
                        <li><a href="https://bankarthaya.com/" target="_blank">Tentang Bank Arthaya</a></li>
                        <li><a href="{{ route('privacypolicy') }}">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h6>Lebih dekat dengan Kami Sekarang</h6>
                    <div class="footer__widget__social">
                        <a href="{{ $setting->fb }}" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="{{ $setting->ig }}" target="_blank"><i class="fa fa-instagram"></i></a>
                        <a href="https://wa.me/{{ $setting->wa }}" target="_blank"><i class="fa fa-whatsapp"></i></a>
                    </div>
                    <hr>
                    <h6>Tautan ke link mitra:</h6>
                    <a href="http://lelang.go.id" target="_blank" rel="noopener noreferrer"><img
                            src="{{ asset('guest/img/lelang_djkn.jpeg') }}" alt="lelang" class="footer-logo"></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text">
                        <p>
                            Copyright Bank Arthaya &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->
