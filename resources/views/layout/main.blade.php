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
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}assets/css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- range slider -->

    <!-- font awesome style -->
    <link href="{{ asset('/') }}assets/css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('/') }}assets/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('/') }}assets/css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">

    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <div class="header_bottom">
                <div class="container-fluid">
                    <div class="top_nav_container">
                        <div class="contact_nav">
                            <a class="navbar-brand" href="index.html">
                                <span>TokoQu</span>
                            </a>
                        </div>
                        <div class="user_option_box ms-auto">
                            <a href="" class="account-link">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>{{ Auth::guard('user')->check() ? Auth::guard('user')->user()->name : 'My Account' }}</span>
                            </a>
                            <a href="" class="cart-link">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span>Cart</span>
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

    <!-- jQery -->
    <script src="{{ asset('/') }}assets/js/jquery-3.4.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('/') }}assets/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="{{ asset('/') }}assets/js/custom.js"></script>

    @stack('myscript')

</body>

</html>
