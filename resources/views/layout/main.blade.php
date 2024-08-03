<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <link rel="icon" href="{{ asset('/') }}assets/images/fevicon.png" type="image/gif" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>TokoQu | {{ $title }}</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}assets/css/boootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- range slider -->

    <!-- font awesome style -->
    <link href="{{ asset('/') }}assets/css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('/') }}assets/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('/') }}assets/css/responsive.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

</head>

<body class="sub_page">

    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <div class="header_bottom">
                <div class="container-fluid">
                    <div class="top_nav_container mx-3">
                        <div class="contact_nav">
                            <a class="navbar-brand" href="/">
                                <span>TokoQu</span>
                            </a>
                        </div>
                        <div class="user_option_box ms-auto">
                            <a href="" class="account-link">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>{{ Auth::guard('user')->check() ? Auth::guard('user')->user()->name : 'My Account' }}</span>
                            </a>
                            <a href="{{ url('/keranjang') }}" class="cart-link me-3">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span>Cart</span>
                                {{-- <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    99+ </span> --}}
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- end header section -->
    </div>


    <!-- product section -->

    <section class="product_section layout_padding">
        @yield('content')
    </section>

    <!-- end product section -->

    <!-- footer section -->
    <footer class="footer_section">
        <div class="container">
            <p>
                &copy; <span id="displayYear"></span> All Rights Reserved By
                TokoQu
            </p>
        </div>
    </footer>
    <!-- footer section -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- jQery -->
    {{-- <script src="{{ asset('/') }}assets/js/jquery-3.4.1.min.js"></script> --}}
    <!-- bootstrap js -->
    <script src="{{ asset('/') }}assets/js/boootstrap.js"></script>
    <!-- custom js -->
    <script src="{{ asset('/') }}assets/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('myscript')

</body>

</html>
