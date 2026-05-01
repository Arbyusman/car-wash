<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ setting()?->name }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <!-- Favicon -->
    <title>{{ config('app.name', $setting->name ?? 'N/A') | config('app.name' ?? 'N/A') }}</title>


    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />

    {!! includeFavicon() !!}

    <!--begin::Fonts-->
    {!! includeFonts() !!}
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    @foreach (getGlobalAssets('css') as $path)
        {!! sprintf('<link rel="stylesheet" href="%s">', asset($path)) !!}
    @endforeach
    <!--end::Global Stylesheets Bundle-->

    <!--begin::Vendor Stylesheets(used by this page)-->
    @foreach (getVendors('css') as $path)
        {!! sprintf('<link rel="stylesheet" href="%s">', asset($path)) !!}
    @endforeach
    <!--end::Vendor Stylesheets-->

    <!--begin::Custom Stylesheets(optional)-->
    @foreach (getCustomCss() as $path)
        {!! sprintf('<link rel="stylesheet" href="%s">', asset($path)) !!}
    @endforeach
    <!--end::Custom Stylesheets-->
    @stack('styles')

    <link href="{{ asset('assets/landing-page/lib/flaticon/font/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/landing-page/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/landing-page/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/landing-page/css/style.css') }}" rel="stylesheet">

</head>

<body>
    <!-- Top Bar Start -->
    <div class="top-bar py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-12">
                    <div class="logo">
                        @php
                            $name = setting()?->name;
                            $words = explode(' ', trim($name), 2);
                            $firstWord = $words[0] ?? '';
                            $remainingWords = $words[1] ?? '';
                        @endphp
                        <a href="/">
                            <h1>{{ $firstWord }}<span> {{ $remainingWords }}</span></h1>
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 d-none d-lg-block">
                    <div class="row">
                        <div class="col-4">
                            <div class="top-bar-item">
                                <div class="top-bar-icon">
                                    <i class="far fa-clock"></i>
                                </div>
                                <div class="top-bar-text">
                                    <h3>Opening Hour</h3>
                                    <p>{{ setting()?->opening_hour }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="top-bar-item">
                                <div class="top-bar-icon">
                                    <i class="fa fa-phone-alt"></i>
                                </div>
                                <div class="top-bar-text">
                                    <h3>Call Us</h3>
                                    <p>{{ setting()?->phone }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="top-bar-item">
                                <div class="top-bar-icon">
                                    <i class="far fa-envelope"></i>
                                </div>
                                <div class="top-bar-text">
                                    <h3>Email Us</h3>
                                    <p>{{ setting()?->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top Bar End -->

    <!-- Nav Bar Start -->
    <div class="nav-bar py-4">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
                <a href="#" class="navbar-brand">MENU</a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto">
                        <a href="/" class="nav-item nav-link active">Home</a>
                        <a href="#about" class="nav-item nav-link">About</a>
                        <a href="#service" class="nav-item nav-link">Service</a>
                        <a href="#price" class="nav-item nav-link">Price</a>
                        <a href="#location" class="nav-item nav-link">Washing Points</a>
                        <a href="#testimonial" class="nav-item nav-link">Testimonial</a>
                    </div>
                    <div class="ml-auto">
                        <a class="btn btn-custom" href="/login">{{ !Auth()->user() ? 'Login' : 'Dashboard' }}</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Nav Bar End -->


    <!-- Carousel Start -->
    {{-- <div class="carousel" id="about">
        <div class="container-fluid">
            <div class="owl-carousel">
                <div class="carousel-item">
                    <div class="carousel-img">
                        <img src="{{ asset('assets/landing-page/imgcarousel-1.jpg') }}" alt="Image">
                    </div>
                    <div class="carousel-text">
                        <h3>Washing & Detailing</h3>
                        <h1>Keep your Car Newer</h1>
                        <p>
                            Lorem ipsum dolor sit amet elit. Phasellus ut mollis mauris. Vivamus egestas eleifend dui ac
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-img">
                        <img src="{{ asset('assets/landing-page/imgcarousel-2.jpg') }}" alt="Image">
                    </div>
                    <div class="carousel-text">
                        <h3>Washing & Detailing</h3>
                        <h1>Quality service for you</h1>
                        <p>
                            Morbi sagittis turpis id suscipit feugiat. Suspendisse eu augue urna. Morbi sagittis orci
                            sodales
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-img">
                        <img src="{{ asset('assets/landing-page/imgcarousel-3.jpg') }}" alt="Image">
                    </div>
                    <div class="carousel-text">
                        <h3>Washing & Detailing</h3>
                        <h1>Exterior & Interior Washing</h1>
                        <p>
                            Sed ultrices, est eget feugiat accumsan, dui nibh egestas tortor, ut rhoncus nibh ligula
                            euismod quam
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="about" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-img">
                        <img src="{{ asset('storage/images/' . $aboutUs?->image) }}" alt="Image">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-header text-left">
                        <p>About Us</p>
                        <h2>{{ $aboutUs?->title }}</h2>
                    </div>
                    <div class="about-content">
                        {!! $aboutUs?->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Service Start -->
    <div class="service" id="service">
        <div class="container">
            <div class="section-header text-center">
                <p>What We Do?</p>
                <h2>Premium Washing Services</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <h3>Exterior Washing</h3>
                        <ul>
                            <li>pencucian body kendaraan</li>
                            <li>sabun salju</li>
                            <li>pembersihan beli dan ban</li>
                            <li>pembilasan dengan air bertekanan</li>
                            <li>pengeringan</li>
                            <li>semir ban</li>
                            <li>pembersihan kaca luar</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <h3>Interior Washing</h3>
                        <ul>
                            <li>pembersihan kabin(vacum)</li>
                            <li>pembersihan dasbord</li>
                            <li>pembersihan jok</li>
                            <li>pembersihan kaca bagian dalam</li>
                            <li>pengharum ruang mobil</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <h3>Vacuum Cleaning</h3>
                        <ul>
                            <li>pembersihan debu</li>
                            <li>sisa sisa makanan</li>
                            <li>kotoran kecil disela kursi</li>
                            <li>kotoran pada karpet</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <h3>Seats Washing</h3>
                        <ul>
                            <li>penyedotan debu awal</li>
                            <li>penyemprotan cairan pembersih</li>
                            <li>pengikatan lembut untuk angkat noda</li>
                            <li>penyedotan kotoran</li>
                            <li>pengeringan jok</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <h3>Window Wiping</h3>
                        <ul>
                            <li>penyemprotan cairan pembersih</li>
                            <li>pembersihan kaca depan, samping, belakang dan spion</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <h3>Wet Cleaning</h3>
                        <ul>
                            <li>penyemprotan cairan pembersih menyeluruh pada kotoran yang menempel</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Price Start -->
    <div class="price" id="price">
        <div class="container">
            <div class="section-header text-center">
                <p>Washing Plan</p>
                <h2>Choose Your Plan</h2>
            </div>
            <div class="owl-carousel price-carousel">
                @foreach ($vehicles as $index => $vehicle)
                    <div class="price-item">
                        <div class="price-header">
                            <h2>{{ $vehicle?->name }}</h2>
                            <h3><strong>{{ toRupiah($vehicle->cost) }}</strong></h3>
                        </div>
                        <div class="price-body">
                            <ul>
                                <li><i class="far fa-check-circle"></i>Seats Washing</li>
                                <li><i class="far fa-check-circle"></i>Vacuum Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Interior Wet Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Window Wiping</li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Price End -->



    <!-- Location Start -->
    <div class="location" id="location">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex flex-column justify-content-center">
                    <div class="section-header text-left">
                        <p>Washing Points</p>
                        <h2>Car Washing Points</h2>
                    </div>
                    <div class="row flex-row justify-content-center">
                        <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                            <div class="d-flex flex-column">
                                @foreach ($washingPoints as $washingPoint)
                                    <div class="location-item d-flex align-items-center">
                                        <i class="fa fa-map-marker-alt"></i>
                                        <div class="location-text">
                                            <h3>Car Washing Point</h3>
                                            <p>{{ $washingPoint?->address }}
                                            </p>
                                            <p><strong>Call:</strong>{{ $washingPoint?->phone }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="map-responsive">
                                {!! setting()?->embed_map !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Location End -->




    <!-- Testimonial Start -->
    <div id="testimonial" class="testimonial">
        <div class="container">
            <div class="section-header text-center">
                <p>Testimonial</p>
                <h2>What our clients say</h2>
            </div>
            <div class="owl-carousel testimonials-carousel">
                @foreach ($testimonis as $testimoni)
                    <div class="testimonial-item">
                        <div class="testimonial-text">
                            <h3>{{ $testimoni?->name }}</h3>
                            <h4>{{ hideEmail($testimoni?->email) }}</h4>
                            <p>
                                {{ $testimoni?->description }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="container d-flex justify-content-center">
            <div class="col-md-8 mt-8">
                <h1 class="text-center my-3">Write Your Testimonial</h1>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action={{ route('testimonis.store') }} method="POST">
                    @method('POST')
                    @csrf
                    <div class="form-group my-2">
                        <input type="text" class="form-control" name="name" placeholder="Name"
                            required="required" />
                    </div>
                    <div class="form-group my-2">
                        <input type="email" class="form-control" name="email" placeholder="Email"
                            required="required" />
                    </div>
                    <div class="form-group my-2">
                        <textarea rows="5" class="form-control" name="description" placeholder="Description" required="required"></textarea>
                    </div>
                    <div class="d-flex justify-content-center my-4">
                        <button class="btn btn-custom" type="submit">Send Testimoni</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    <!-- Footer Start -->
    <div class="footer">
        <div class="container">
            <div class="d-md-flex justify-content-between">
                <div class="col-md-8">
                    <div class="footer-contact">
                        <h2>Get In Touch</h2>
                        <p><i class="fa fa-map-marker-alt"></i>{{ setting()?->address }}</p>
                        <p><i class="fa fa-phone-alt"></i>{{ setting()?->phone }}</p>
                        <p><i class="fa fa-envelope"></i>{{ setting()?->email }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-link">
                        <h2>Popular Links</h2>
                        <a href="/" class="nav-item nav-link active">Home</a>
                        <a href="#about" class="nav-item nav-link">About</a>
                        <a href="#service" class="nav-item nav-link">Service</a>
                        <a href="#price" class="nav-item nav-link">Price</a>
                        <a href="#location" class="nav-item nav-link">Washing Points</a>
                        <a href="#testimonial" class="nav-item nav-link">Testimonial</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="container copyright">
            <p>&copy; <a href="/">{{ setting()?->name ?? setting()?->short_name }}</a>
                <br>
                All Right Reserved
            </p>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to top button -->
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- Pre Loader -->
    <div id="loader" class="show">
        <div class="loader"></div>
    </div>

    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    @foreach (getGlobalAssets() as $path)
        {!! sprintf('<script src="%s"></script>', asset($path)) !!}
    @endforeach
    <!--end::Global Javascript Bundle-->

    <!--begin::Vendors Javascript(used by this page)-->
    @foreach (getVendors('js') as $path)
        {!! sprintf('<script src="%s"></script>', asset($path)) !!}
    @endforeach
    <!--end::Vendors Javascript-->

    <!--begin::Custom Javascript(optional)-->
    @foreach (getCustomJs() as $path)
        {!! sprintf('<script src="%s"></script>', asset($path)) !!}
    @endforeach
    <!--end::Custom Javascript-->
    <!--end::Javascript-->

    <!-- JavaScript Libraries -->
    <script src="{{ asset('assets/landing-page/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/lib/counterup/counterup.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/landing-page/js/main.js') }}"></script>
</body>

</html>
