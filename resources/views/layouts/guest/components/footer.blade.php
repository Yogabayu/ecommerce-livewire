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
                        <li>Address: {{ $setting->address }}</li>
                        <li>Phone: +{{ $setting->main_tlp }}</li>
                        <li>Email: {{ $setting->email }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6>Useful Links</h6>
                    <ul>
                        <li><a href="{{ route('aboutus') }}">About Us</a></li>
                        <li><a href="https://bankarthaya.com/" target="_blank">About Bank Arthaya</a></li>
                        <li><a href="{{ route('privacypolicy') }}">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h6>Bergabunglah dengan buletin Kami Sekarang</h6>
                    <div class="footer__widget__social">
                        <a href="{{ $setting->fb }}" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="{{ $setting->ig }}" target="_blank"><i class="fa fa-instagram"></i></a>
                        <a href="https://wa.me/{{ $setting->wa }}" target="_blank"><i class="fa fa-whatsapp"></i></a>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h6>Bank Arthaya terdaftar dan diawasi oleh:</h6>
                            <a href="http://www.ojk.go.id" target="_blank" rel="noopener noreferrer"><img
                                    src="https://bankarthaya.com/wp-content/uploads/2022/06/OJK.png" alt="ojk"
                                    class="footer-logo"></a>

                        </div>
                        <div class="col">
                            <h6>Tautan ke link mitra:</h6>
                            <a href="http://lelang.go.id" target="_blank" rel="noopener noreferrer"><img
                                    src="{{ asset('guest/img/lelang_djkn.jpeg') }}" alt="lelang"
                                    class="footer-logo"></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text">
                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright Bank Arthaya &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved
                        </p>
                    </div>
                    <div class="footer__copyright__payment"><img src="{{ asset('guest/img/footer.png') }}"
                            alt="footer"></div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->
