<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Kooldoc Airconditioning</title>

        <!-- Fonts and icons -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200|Open+Sans+Condensed:700" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <!-- CSS Files -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/now-ui-kit.css?v=1.3.1') }}" rel="stylesheet" />
        <!-- Custom css file -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
        <!--  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
        <script src='https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.css' rel='stylesheet' />
        <!-- jQuery UI CDN link -->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

        <link rel="shortcut icon" href="{{ asset('assets/img/kooldoc-icon.png') }}" />
    </head>
    <body class="@yield('body-class')">
        <div class="loader">
            <div class="jimu-primary-loading"></div>
        </div>

        <nav class="@yield('nav-class')">
            <div class="container">
                <div class="navbar-translate">
                    <a class="navbar-brand" href="/" rel="tooltip" title="Kooldoc improves lives." data-placement="bottom">Kooldoc</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#example-navbar-profile" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="example-navbar-profile">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                            <a class="nav-link" href="/">
                                <i class="now-ui-icons business_globe"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li id="navbar_book" class="nav-item dropdown {{ request()->is('mobile-app') ? 'active' : '' }}">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown">
                                <i class="now-ui-icons location_bookmark"></i>
                                <p>Book</p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/.#book"><i class="now-ui-icons business_globe"></i>Web</a>
                                <div class="divider"></div>
                                <a class="dropdown-item {{ request()->is('mobile-app') ? 'active' : '' }}" href="/mobile-app"><i class="now-ui-icons tech_mobile"></i>Mobile</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown {{ request()->is('mission-vision', 'company-product-history') ? 'active' : '' }}">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown">
                                <i class="now-ui-icons business_bank"></i>
                                <p>Company</p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/.#about"><i class="now-ui-icons travel_info"></i>About</a>
                                <div class="divider"></div>
                                <a class="dropdown-item" href="/.#team"><i class="now-ui-icons business_badge"></i><p>Team</p>
                                </a>
                                <div class="divider"></div>
                                <a class="dropdown-item {{ request()->is('mission-vision') ? 'active' : '' }}" href="/mission-vision"><i class="now-ui-icons business_chart-bar-32"></i>Mission & Vision</a>
                                <div class="divider"></div>
                                <a class="dropdown-item {{ request()->is('company-product-history') ? 'active' : '' }}" href="/company-product-history"><i class="now-ui-icons education_paper"></i>Company Product & History</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown {{ request()->is('key-products-services', 'pricing-quotation', 'ac-info', 'future-plan') ? 'active' : '' }}">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown">
                                <i class="now-ui-icons business_briefcase-24"></i>
                                <p>Business</p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item {{ request()->is('ac-info') ? 'active' : '' }}" href="/ac-info"><i class="now-ui-icons business_bulb-63"></i>AC Information</a>
                                <div class="divider"></div>
                                <a class="dropdown-item {{ request()->is('pricing-quotation') ? 'active' : '' }}" href="/pricing-quotation"><i class="now-ui-icons shopping_credit-card"></i>Pricing Quotation</a>
                                <div class="divider"></div>
                                <a class="dropdown-item" href="/.#services"><i class="now-ui-icons ui-2_settings-90"></i>Services</a>
                                <div class="divider"></div>
                                <a class="dropdown-item {{ request()->is('key-products') ? 'active' : '' }}" href="/key-products"><i class="now-ui-icons objects_key-25"></i>Key Products</a>
                                <div class="divider"></div>
                                <a class="dropdown-item {{ request()->is('future-plan') ? 'active' : '' }}" href="/future-plan"><i class="now-ui-icons files_box"></i>Future Plan</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/.#contact-us">
                                <i class="now-ui-icons ui-1_bell-53"></i>
                                <p>Contact Us</p>
                            </a>
                        </li>
                        <li id="navbar_login" class="nav-item {{ request()->is('login') ? 'active' : '' }}">
                            <a class="nav-link" href="/login">
                                <i class="now-ui-icons users_circle-08"></i>
                                <p>Login</p>
                            </a>
                        </li>
                        <li id="navbar_register" class="nav-item {{ request()->is('register') ? 'active' : '' }}">
                            <a class="nav-link" href="/register">
                                <i class="now-ui-icons ui-1_simple-add"></i>
                                <p>Register</p>
                            </a>
                        </li>
                        <li id="navbar_full_name_display" class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown">
                                <i class="now-ui-icons users_circle-08"></i>
                                <p><span id="navbar_full_name"></span></p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a id="super_admin_profile" class="dropdown-item" href="/super-admin-profile"><i class="now-ui-icons emoticons_satisfied"></i>Profile</a>
                                <div class="divider"></div>
                                <a id="admin_profile" class="dropdown-item" href="/admin-profile"><i class="now-ui-icons emoticons_satisfied"></i>Profile</a>
                                <div class="divider"></div>
                                <a id="technician_profile" class="dropdown-item" href="/technician-profile"><i class="now-ui-icons emoticons_satisfied"></i>Profile</a>
                                <div class="divider"></div>
                                <a id="customer_profile" class="dropdown-item" href="/customer-profile"><i class="now-ui-icons emoticons_satisfied"></i>Profile</a>
                                <div class="divider"></div>
                                <a id="logout_btn" href="#" class="dropdown-item"><i class="now-ui-icons media-1_button-power"></i>Logout</a>
                            </div>
                        </li>
                        <li id="navbar_image_display" class="nav-item dropdown nav-item-image">
                            <a href="#" class="nav-link dropdown-toggle mr-3" id="navbarDropdownMenuLink" data-toggle="dropdown">
                                <div class="">
                                    <img id="navbar_image" alt="Profile">
                                </div>
                            </a>
                        </li>
                        <li id="highlight_book" class="nav-item">
                            <a class="nav-link btn btn-light" href="/book-service">
                                <p>BOOK NOW</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        @yield('content')

        <div id="fb-root"></div>

        <div id="fb-customer-chat" class="fb-customerchat">
        </div>

        <!-- Core JS Files -->
        <script src="{{ asset('assets/js/core/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/core/popper.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
        <!-- Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
        <script src="{{ asset('assets/js/plugins/bootstrap-switch.js') }}"></script>
        <!-- Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
        <script src="{{ asset('assets/js/plugins/nouislider.min.js') }}" type="text/javascript"></script>
        <!-- Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
        <script src="{{ asset('assets/js/plugins/moment.min.js') }}"></script>
        <!-- Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs -->
        <script src="{{ asset('assets/js/plugins/bootstrap-tagsinput.js') }}"></script>
        <!-- Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
        <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js') }}" type="text/javascript"></script>
        <!-- Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
        <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
        <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
        <script src="{{ asset('assets/js/now-ui-kit.js') }}" type="text/javascript"></script>
        <!-- Custom javascript file -->
        <script src="{{ asset('admin/js/auth.js') }}"></script>
        <!--  -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <!-- jQuery UI CDN link -->
        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

        <script>
            var chatbox = document.getElementById('fb-customer-chat');
            chatbox.setAttribute("page_id", "107351034605928");
            chatbox.setAttribute("attribution", "biz_inbox");
        </script>
    
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    xfbml            : true,
                    version          : 'v16.0'
                });
            };
    
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>

        <script>
            window.addEventListener('load', function() {
                document.querySelector('.loader').remove();
            });
        </script>
    </body>
</html>
