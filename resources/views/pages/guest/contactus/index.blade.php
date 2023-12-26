<div>
    <!-- Hero Section Begin -->
    <livewire:headcomponent />
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('guest/img/sales.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Contact Us</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>Contact Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>Phone</h4>
                        <p>+{{ $setting->main_telp }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Address</h4>
                        <p>{{ $setting->address }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p>{{ $setting->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Begin -->
    <div class="map">
        <iframe src="https://www.google.com/maps/d/embed?mid=1Z3gv4jHUKvWYdGYrGcyLhNf4sIeqg94&ehbc=2E312F"
            height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        {{-- <div class="map-inside">
            <i class="icon_pin"></i>
            <div class="inside-widget">
                <h4>New York</h4>
                <ul>
                    <li>Phone: +12-345-6789</li>
                    <li>Add: 16 Creek Ave. Farmingdale, NY</li>
                </ul>
            </div>
        </div> --}}
    </div>
    <!-- Map End -->
</div>
