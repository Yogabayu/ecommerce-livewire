<!-- Footer Section Begin -->
<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ Storage::url('setting/' . $setting->logo) }}" alt="{{ $setting->name_app }}"
                                style="max-width: 120px; max-height: 50px">
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
                        <li><a href="#">Our Sitemap</a></li>
                    </ul>
                    {{-- <ul>
                        <li><a href="#">Who We Are</a></li>
                        <li><a href="#">Our Services</a></li>
                        <li><a href="#">Projects</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Innovation</a></li>
                        <li><a href="#">Testimonials</a></li>
                    </ul> --}}
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h6>Bergabunglah dengan buletin Kami Sekarang</h6>
                    <p>Dapatkan pembaruan Email tentang penawaran terbaru dan spesial kami.</p>
                    <form action="#">
                        <input type="text" placeholder="Enter your mail" id="newslatter">
                        <button type="submit" class="site-btn">Subscribe</button>
                    </form>
                    <div class="footer__widget__social">
                        <a href="{{ $setting->fb }}" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="{{ $setting->ig }}" target="_blank"><i class="fa fa-instagram"></i></a>
                        <a href="https://wa.me/{{ $setting->wa }}" target="_blank"><i class="fa fa-whatsapp"></i></a>
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
                    {{-- <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div> --}}
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->
