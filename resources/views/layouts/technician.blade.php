<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Kooldoc Airconditioning</title>

        <script src="{{ asset('admin/js/jquery-3.6.3.min.js') }}"></script>

        <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/vendors/base/vendor.bundle.base.css') }}">
        
        <link rel="stylesheet" href="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">

        <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css"/>

        <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.0.0/css/fixedColumns.bootstrap4.css">
        
        <link rel="shortcut icon" href="{{ asset('assets/img/kooldoc-icon.png') }}" />
    </head>
    <body>
        <div class="loader">
            <div class="jimu-primary-loading"></div>
        </div>
        <div class="container-scroller">
            @include('layouts.inc.technician.navbar')
            <div class="container-fluid page-body-wrapper">
                @include('layouts.inc.technician.sidebar')
                <div class="main-panel">
                    <div class="custom-content-wrapper">
                        @yield('content')
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright &copy; 2023 Kooldoc. All rights reserved.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><a href="/terms-conditions" target="_blank">Terms & Conditions</a> | <a href="/privacy-policy" target="_blank">Privacy Policy</a></span>
                </div>
            </footer>
        </div>

        <div id="fb-root"></div>

        <div id="fb-customer-chat" class="fb-customerchat">
        </div>

        <script src="{{ asset('admin/vendors/base/vendor.bundle.base.js') }}"></script>

        <script src="{{ asset('admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>

        <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
        <script src="{{ asset('admin/js/hoverable-collapse.js') }}"></script>
        <script src="{{ asset('admin/js/template.js') }}"></script>

        <script src="{{ asset('admin/js/data-table.js') }}"></script>
        <script src="{{ asset('admin/js/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('admin/js/dataTables.bootstrap4.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

        <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/4.0.0/js/dataTables.fixedColumns.js"></script>

        <script src="{{ asset('admin/js/auth.js') }}"></script>
        <script src="{{ asset('admin/js/technician.js') }}"></script>

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