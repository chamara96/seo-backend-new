<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/favicon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title') | {{ config('app.name', 'Laravel Starter') }}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <meta name="description" content="{{ setting('meta_description') }}">
    <meta name="keyword" content="{{ setting('meta_keyword') }}">

    @include('frontend.includes.meta')

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
    <link rel="stylesheet" href="/css/blog.css">
    <link rel="stylesheet" href="/css/editable.css">

    {{-- <link rel="stylesheet" href="css/menu-new-2.css"> --}}
    {{-- <link rel="stylesheet" href="/css/editable2.css"> --}}

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

        @if ($current_view=='user')
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
                                <a class="nav-link" href="/index.html">
                                    Home

                                </a>
                                <hr class="divider"/>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="merchants/index.html">
                                    Buisness Owner
                                </a>
                                <hr class="divider"/>
                            </li>
                            <!-- End Dropdown -->
                            <li class="nav-item">
                                <a class="nav-link" href="app_benefits.html">
                                    App Benefits
                                </a>
                                <hr class="divider"/>
                            </li>
                            <!-- End Dropdown -->
                            <li class="nav-item">
                                <a class="nav-link" href="categories_we_serve.html">
                                    Categories
                                    <!--span class="tw-indicator"><i class="fa fa-angle-down"></i></span-->
                                </a>
                                <hr class="divider"/>
                                <!--ul class="dropdown-menu tw-dropdown-menu" style="background-color: #f7f7f7">
                                <li><a href="marketing.html">Marketing</a></li>
                                <li><a href="strategy.html">Strategy</a></li>
                                <li><a href="design.html">Design</a></li>
                                <li><a href="development.html">Development</a></li>
                             </ul-->
                            </li>
                            <li class="nav-item"><a class="nav-link"
                                    href="/careers">Careers</a><hr class="divider"/></li>
                            <li class="nav-item"><a class="nav-link"
                                    href="/blog">Blog</a><hr class="divider"/></li>

                            <li class="nav-item">
                                <a class="nav-link" href="about_us.html">
                                    About Us
                                    <!--span class="tw-indicator"><i class="fa fa-angle-down"></i></span-->
                                </a>
                                <hr class="divider"/>
                            </li>
                            <!-- End Dropdown -->


                            <li class="nav-item"><a class="nav-link" href="merchants/contact_us.html">Contact Us</a></li>
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
        @else
        <div id="mobile_head" class="fixed-top pos-f-t">
            <div>
                <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f7f7f7">
                    <!--a class="navbar-brand tw-nav-brand" href="index.html">
                             <img src="images/logo/logo.png" alt="seotime">
                          </a-->
                    <div id="logo_img_div_mobi" class="navbar-brand"
                        style="width: 100%;text-align: center; background-color: #f7f7f7">
                        <a style="padding: 0;" href="/merchants/"><img id="logo_img_xxx"
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
                                <a class="nav-link" href="/merchants/index.html">
                                    Home

                                </a>
                                <hr class="divider"/>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/index.html">
                                    User App
                                </a>
                                <hr class="divider"/>
                            </li>
                            <!-- End Dropdown -->
                            <li class="nav-item">
                                <a class="nav-link" href="/merchants/spot_offers_360degree_digital_marketing_benefits.html">
                                    Benefits
                                </a>
                                <hr class="divider"/>
                            </li>
                            <!-- End Dropdown -->
                            <li class="nav-item">
                                <a class="nav-link" href="/merchants/our_services.html">
                                    Services
                                    <!--span class="tw-indicator"><i class="fa fa-angle-down"></i></span-->
                                </a>
                                <hr class="divider"/>
                                <!--ul class="dropdown-menu tw-dropdown-menu" style="background-color: #f7f7f7">
                                <li><a href="marketing.html">Marketing</a></li>
                                <li><a href="strategy.html">Strategy</a></li>
                                <li><a href="design.html">Design</a></li>
                                <li><a href="development.html">Development</a></li>
                             </ul-->
                            </li>
                            <li class="nav-item"><a class="nav-link"
                                    href="/merchants/tech_we_use.html">Technology</a><hr class="divider"/></li>
                            <li class="nav-item"><a class="nav-link"
                                    href="/merchant/blog">Blog</a><hr class="divider"/></li>

                            <li class="nav-item">
                                <a class="nav-link" href="/merchants/about.html">
                                    About Us
                                    <!--span class="tw-indicator"><i class="fa fa-angle-down"></i></span-->
                                </a>
                                <hr class="divider"/>
                            </li>
                            <!-- End Dropdown -->


                            <li class="nav-item"><a class="nav-link" href="/merchants/contact_us.html">Contact Us</a></li>
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
        @endif

        {{-- <div id="mobile_head" class="fixed-top pos-f-t">
            <div class="collapse" id="navbarToggleExternalContent">
                <div class="bg-dark p-4">
                    <h5 class="text-white h4">SEO</h5>
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <td><a href="index.html">Home</a></td>
                                <td><a href="#tw-about">About Us</a></td>
                            </tr>
                            <tr>
                                <td><a href="../merchant/index.html">Buisness Owner</a></td>
                                <td><a href="#tw-blog">Career</a></td>
                            </tr>
                            <tr>
                                <td><a href="#tw-features">Features</a></td>
                                <td><a href="#tw-contact">Contact Us</a></td>
                            </tr>
                            <!--tr>
                           <td><a href="#work-process">Industries</a></td>
                           <td><a href="#tw-footer">Contact Us</a></td>
                        </tr-->
                        </tbody>
                    </table>
                    <!-- <span class="text-muted">Toggleable via the navbar brand.</span> -->
                </div>
            </div>
            <nav class=" navbar-dark bg-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
        </div> --}}

        <!-- mobile view center logo -->
        <div id="logo_img_div_mobi" style="text-align: center;z-index: 105;position: fixed;  left: 40%;">
            <a style="padding: 0;" href="/"><img id="logo_img_xxx" class="shadowfilter" src="/css/center_logo_new.png" alt=""></a>
        </div>
        <!-- ------------------------ -->

        <!-- desktop view center logo -->
        <div id="logo_img_div_desk" style="text-align: center;z-index: 105;position: fixed; left: 47%;">
            <a style="padding: 0;" href="/"><img id="logo_img_xxx" class="shadowfilter" src="/css/center_logo_new.png" alt=""></a>
        </div>
        <!-- ----------------------- -->

        {{-- @if ($current_view=='user')

        @endif --}}

        @if ($current_view=='user')
        <nav style="z-index: 500;" id="newheader2" class="menu">
            <ul class="nav-menu nav-center">
                <li class="menu-item"><a href="/index.html"><u>Home</u></a>
                <li class="menu-item"><a href="app_benefits.html"><u>App Benefits</u></a>
                        <ul>

                            <li><a href="/find_offers.html">Find Offers</a></li>
                            <li><a href="/find_stores.html">Find Stores</a></li>
                            <li><a href="/cash_vouchers.html">Cash Vouchers</a></li>
                            <li><a href="/home_delivery.html">Home Delivery</a></li>
                            <li><a href="/earn_money.html">Earn Money</a></li>
                            <li><a href="/spot_deals.html">Spot Deals</a></li>
                            <li><a href="/negotiate_price.html">Negotiate Price</a></li>
                            <li><a href="/daily_checkin.html">Daily Check-in</a></li>
                            <li><a href="/price_request.html">Price Request</a></li>
                            <li><a href="/follow.html">Follow</a></li>
                            <li><a href="/augmented_reality.html">Augmented Reality</a></li>
                            <li><a href="/chat.html">Chat</a></li>



                        </ul>
                </li>

                <li class="menu-item"><a href="/categories_we_serve.html"><u>Categories</u></a></li>
                <li class="menu-item"><a href="/merchants/index.html"><u>Buisness Owner</u></a>


                <li style="visibility: hidden;" class="menu-item"><a href="#">&nbsp;</a></li>

                <li class="menu-item"><a href="/careers"><u>Careers</u></a></li>
                <li class="menu-item"><a href="/blog"><u>Blog</u></a></li>

                <li class="menu-item"><a href="/about_us.html"><u>About Us</u></a>
                <li class="menu-item"><a href="/merchants/contact_us.html"><u>Contact Us</u></a></li>


            </ul>
        </nav>

        @else
        <nav style="z-index: 100;" id="newheader2" class="menu">
            <ul class="nav-menu nav-center">
               <li class="menu-item"><a href="/merchants/index.html"><u>Home</u></a>
               <li class="menu-item" id="sec-9"><a href="spot_offers_360degree_digital_marketing_benefits.html"><u>Benefits</u></a>
                  <ul>
                     <li><a href="/merchants/targeted_ads.html">Targeted Ads</a></li>
                     <li><a href="/merchants/cheap_advertising.html">Cheap Advertising</a>
                     <li><a href="/merchants/high_return.html">High Return</a>
                     <li><a href="/merchants/improve_conversion.html">Improve conversion</a></li>
                        <li><a href="/merchants/measure_roi.html">Measure ROI</a>
                        <li><a href="/merchants/data_analytics_spot.html">Data Analytics</a>
                           <li><a href="/merchants/peak_hours.html">Peak Hours</a></li>
                           <li><a href="/merchants/target_customers.html">Target Customers</a>
                           <li><a href="/merchants/update_ads.html">Update Ads</a>
                              <li><a href="/merchants/brand_development.html">Brand Development</a></li>
                     <li><a href="/merchants/easy_to_share.html">Easy to share</a>
                     <li><a href="/merchants/customer_journey.html">Customer’s Journey</a>
                  </ul>


               <li class="menu-item" id="sec-02"><a href="/merchants/our_services.html"><u>Services</u></a>
                  <ul>

                     <li><a href="/merchants/marketing.html">Marketing</a>
                        <ul>
                           <li><a href="/merchants/spot_offer.html">Spot Offers Super App</a>
                              <ul>
                                 <li><a href="/merchants/promote_offers.html">Promote Offers</a>
                                 <li><a href="/merchants/get_discovered.html">Get Discovered</a></li>
                                 <li><a href="/merchants/get_leads.html">Get Leads</a></li>
                                 <li><a href="/merchants/home_delivery.html">Home Delivery</a></li>
                                 <li><a href="/merchants/clear_old_stock.html">Clear Stock</a></li>
                                 <li><a href="/merchants/get_followers.html">Get Followers</a></li>
                                 <li><a href="/merchants/loyalty_offers.html">Loyalty Offers</a></li>
                                 <li><a href="/merchants/data_analytics_spot.html">Data Analytics</a></li>
                                 <li><a href="/merchants/approve_leads.html">Approve Leads</a></li>
                                 <li><a href="/merchants/better_branding.html">Better Branding</a></li>
                                 <li><a href="/merchants/one_click_chat.html">Chat</a></li>
                                 <li><a href="/merchants/social_media.html">Social Media</a></li>
                              </ul>
                           </li>
                           <li><a href="/merchants/lead_generation.html">Lead Generation</a></li>
                           <li><a href="/merchants/sm_marketing.html">Social Media</a></li>
                           <li><a href="/merchants/sms_marketing.html">SMS Marketing</a></li>
                           <li><a href="/merchants/seo.html">SEO</a></li>
                           <li><a href="/merchants/web_analytics.html">Web Analytics</a></li>
                           <li><a href="/merchants/gmbt.html">GMBT</a></li>
                           <li><a href="/merchants/growth_hacking.html">Growth Hacking</a></li>




                        </ul>
                     </li>
                     <li><a href="/merchants/strategy.html">Strategy</a>
                        <ul>
                           <li><a href="/merchants/omni_channel.html">Omni Channel</a></li>
                           <li><a href="/merchants/digital_strategy.html">Digital Strategy</a></li>
                           <li><a href="/merchants/brand_strategy.html">Brand Strategy</a></li>
                           <li><a href="/merchants/market_research.html">Market Research</a></li>
                        </ul>
                     </li>
                     <li><a href="/merchants/design.html">Design</a>
                        <ul>
                           <li><a href="/merchants/branding.html">Branding</a></li>
                           <li><a href="/merchants/logo_designing.html">Logo Designing</a></li>
                           <li><a href="/merchants/photo_video.html">Photography / Videography </a></li>
                           <li><a href="/merchants/brocher_designing.html">Brocher Designing</a></li>
                        </ul>
                     </li>
                     <li><a href="/merchants/development.html">Development</a>
                        <ul>
                           <li><a href="/merchants/website_development.html">Website Development</a></li>
                           <li><a href="/merchants/ar_vr.html">AR & VR</a></li>
                           <li><a href="/merchants/app_development.html">App Development</a></li>
                        </ul>
                     </li>
                  </ul>
               </li>
               <li class="menu-item"><a href="/index.html"><u>User App</u></a>
               <li style="visibility: hidden;" class="menu-item"><a href="#">&nbsp;</a></li>
               <li class="menu-item" id="sec-04"><a href="/merchants/tech_we_use.html"><u>Technology</u></a>
                  <ul>
                     <li><a href="/merchants/geo_location.html">Geolocation</a></li>
                     <li><a href="/merchants/augmented_reality.html">Augmented Reality</a>
                     <li><a href="/merchants/beacon_technology.html">Beacon Technology</a>
                  </ul>
               </li>
               <li class="menu-item" id="sec-07"><a href="/merchant/blog"><u>Blog</u></a></li>
               <li class="menu-item" id="sec-09"><a href="/merchants/about.html"><u>About Us</u></a></li>
               <li class="menu-item" id="sec-08"><a href="/merchants/contact_us.html"><u>Contact Us</u></a></li>


            </ul>
         </nav>
        @endif


    </header>
    {{-- new header --}}

    <!-- Header Block -->
    <!-- remove @ markinclude('frontend.includes.header_blog') -->
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
