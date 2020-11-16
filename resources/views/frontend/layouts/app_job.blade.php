<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/favicon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title') | {{ config('app.name', 'Laravel Starter') }}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <meta name="description" content="{{ setting('meta_description') }}">
    <meta name="keyword" content="{{ setting('meta_keyword') }}">

    @include('frontend.includes.meta_job')

    <!-- Shortcut Icon -->
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">
    <link rel="icon" type="image/ico" href="{{asset('img/favicon.png')}}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('before-styles')

    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+Bengali+UI&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ mix('css/frontend.css') }}">

    <link rel="stylesheet" href="/css/menu_new.css">
    <link rel="stylesheet" href="/css/editable.css">

    {{-- <link rel="stylesheet" href="/css/editable2.css"> --}}
    {{-- <link rel="stylesheet" href="css/menu-new-2.css"> --}}

    <style>
        @media (max-width: 767px) {

            .divider {
                border-top: 1px solid #F1150D;
                margin-top: 0px;
                margin-bottom: 0px;
                margin-right: 10px;
            }

            ul.navbar-nav li.nav-item>a {
                padding: 15px 0 !important;
            }

            .navbar-light .navbar-nav .nav-link {
                color: #2e2c2d !important;
                font-weight: 500 !important;
                font-size: 15px !important;
            }

            .navbar-toggler {
                position: absolute !important;
                right: 0 !important;
                top: 0 !important;
                background: black !important;
                opacity: 0.7 !important;
            }

            .navbar-light .navbar-toggler {
                border-color: black !important;
                background-color: black !important;
            }

            .navbar-light .navbar-toggler-icon {
                background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255,255,255,1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E") !important;
            }
        }
    </style>



    @stack('after-styles')

</head>

{{-- <body class="{{isset($body_class) ? $body_class : ''}} sidebar-collapse"> --}}

<body>

    {{-- new header --}}
    <header>

        <div id="mobile_head" class="fixed-top pos-f-t">
            <div>
                <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f7f7f7">
                    <!--a class="navbar-brand tw-nav-brand" href="index.html">
                             <img src="images/logo/logo.png" alt="seotime">
                          </a-->
                    <div id="logo_img_div_mobi" class="navbar-brand"
                        style="width: 100%;text-align: center; background-color: #f7f7f7">
                        <a style="padding: 0;" href="/"><img id="logo_img_xxx"
                                src="images/client_images/center_logo_new.webp" alt=""></a>
                    </div>
                    <!-- End of Navbar Brand -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- End of Navbar toggler -->
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav" style="padding-left: 10px">
                            <li class="nav-item active">
                                <a class="nav-link" href="index.html">
                                    Home

                                </a>
                                <hr class="divider" />
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="merchants/index.html">
                                    Buisness Owner
                                </a>
                                <hr class="divider" />
                            </li>
                            <!-- End Dropdown -->
                            <li class="nav-item">
                                <a class="nav-link" href="app_benefits.html">
                                    App Benefits
                                </a>
                                <hr class="divider" />
                            </li>
                            <!-- End Dropdown -->
                            <li class="nav-item">
                                <a class="nav-link" href="categories_we_serve.html">
                                    Categories
                                    <!--span class="tw-indicator"><i class="fa fa-angle-down"></i></span-->
                                </a>
                                <hr class="divider" />
                                <!--ul class="dropdown-menu tw-dropdown-menu" style="background-color: #f7f7f7">
                                <li><a href="marketing.html">Marketing</a></li>
                                <li><a href="strategy.html">Strategy</a></li>
                                <li><a href="design.html">Design</a></li>
                                <li><a href="development.html">Development</a></li>
                             </ul-->
                            </li>
                            <li class="nav-item"><a class="nav-link" href="/careers">Careers</a>
                                <hr class="divider" />
                            </li>
                            <li class="nav-item"><a class="nav-link" href="/blog">Blog</a>
                                <hr class="divider" />
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="about_us.html">
                                    About Us
                                    <!--span class="tw-indicator"><i class="fa fa-angle-down"></i></span-->
                                </a>
                                <hr class="divider" />
                            </li>
                            <!-- End Dropdown -->


                            <li class="nav-item"><a class="nav-link" href="merchants/contact_us.html">Contact Us</a>
                            </li>
                        </ul>
                        <!-- End Navbar Nav -->

                        <!-- End off canvas menu -->
                    </div>
                    <!-- End of navbar collapse -->
                </nav>
                <!-- End of Nav -->
            </div>
            <!-- End of Container -->
        </div>
        <!-- End tw head -->



        <!-- desktop view center logo -->
        <div id="logo_img_div_desk"
            style="margin-top: 10px;text-align: center;z-index: 501;position: fixed; left:47%; ">
            <a style="padding: 0;" href="/"><img id="logo_img_xxx" class="shadowfilter"
                    src="images/client_images/center_logo_new.webp" alt=""></a>
        </div>
        <!-- ----------------------- -->
        <nav style="z-index: 500;" id="newheader2" class="menu">
            <ul class="nav-menu nav-center">
                <li class="menu-item"><a href="index.html"><u>Home</u></a>
                <li class="menu-item"><a href="app_benefits.html"><u>App Benefits</u></a>
                    <ul>

                        <li><a href="find_offers.html">Find Offers</a></li>
                        <li><a href="find_stores.html">Find Stores</a></li>
                        <li><a href="cash_vouchers.html">Cash Vouchers</a></li>
                        <li><a href="home_delivery.html">Home Delivery</a></li>
                        <li><a href="earn_money.html">Earn Money</a></li>
                        <li><a href="spot_deals.html">Spot Deals</a></li>
                        <li><a href="negotiate_price.html">Negotiate Price</a></li>
                        <li><a href="daily_checkin.html">Daily Check-in</a></li>
                        <li><a href="price_request.html">Price Request</a></li>
                        <li><a href="follow.html">Follow</a></li>
                        <li><a href="augmented_reality.html">Augmented Reality</a></li>
                        <li><a href="chat.html">Chat</a></li>



                    </ul>
                </li>

                <li class="menu-item"><a href="categories_we_serve.html"><u>Categories</u></a></li>
                <li class="menu-item"><a href="merchants/index.html"><u>Buisness Owner</u></a>


                <li style="visibility: hidden;" class="menu-item"><a href="#">&nbsp;</a></li>

                <li class="menu-item"><a href="/careers"><u>Careers</u></a></li>
                <li class="menu-item"><a href="/blog"><u>Blog</u></a></li>

                <li class="menu-item"><a href="about_us.html"><u>About Us</u></a>
                <li class="menu-item"><a href="merchants/contact_us.html"><u>Contact Us</u></a></li>


            </ul>
        </nav>



    </header>
    {{-- new header --}}
    <!-- Header Block -->
    <!-- Remove @ mark  include('frontend.includes.header_job') -->
    <!-- / Header Block -->

    <div class="wrapper">

        @yield('content')

        <!-- Footer block -->
        <!-- remove footer -->
        <!-- / Footer block -->
    </div>
</body>

<!-- Scripts -->
@stack('before-scripts')

<script src="{{ mix('js/frontend.js') }}"></script>

@stack('after-scripts')

</html>
