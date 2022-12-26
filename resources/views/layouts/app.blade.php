<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Shoda 3 plus">
    <meta name="keywords" content="Shoda 3 plus">
    <meta name="author" content="Itthipat">
    <link rel="icon" href="{{ asset('assets/logo/logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/logo/logo.png') }}" type="image/x-icon">
    <title>@yield('title', 'Home') - Shoda 3 Plus</title>

    <!--Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;600&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/font-awesome.css') }}">

    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick-theme.css') }}">

    <!-- Animate icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify-icons.css') }}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('css/app-user.css') }}">
    @stack('style')
</head>

<body class="theme-color-19" style="margin-top: 80px;">
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    <!--modal popup start-->
    @if(isset($popup) && $popup)
        <div class="modal fade bd-example-modal-lg" id="popupModal" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="modal-bg">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="offer-content">
                                            <img src="{{ asset($popup->bg->first()['url'] ?? '') }}" class="d-block img-fluid blur-up lazyload mx-auto">

                                            <button type="button" class="btn btn-solid btn-sm mt-3 text-center d-block mx-auto" data-bs-dismiss="modal">ปิด</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!--modal popup end-->


    <!-- tap to top -->
    <div class="tap-top top-cls">
        <div>
            <i class="fa fa-angle-double-up"></i>
        </div>
    </div>
    <!-- tap to top end -->

    <!-- latest jquery-->
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>

    <!-- fly cart ui jquery-->
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>

    <!-- exitintent jquery-->
    <script src="{{ asset('assets/js/jquery.exitintent.js') }}"></script>
    <script src="{{ asset('assets/js/exit.js') }}"></script>

    <!-- slick js-->
    <script src="{{ asset('assets/js/slick.js') }}"></script>

    <!-- menu js-->
    <script src="{{ asset('assets/js/menu.js') }}"></script>

    <!-- lazyload js-->
    <script src="{{ asset('assets/js/lazysizes.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Bootstrap Notification js-->
    <script src="{{ asset('assets/js/bootstrap-notify.min.js') }}"></script>

    <!-- Fly cart js-->
    <script src="{{ asset('assets/js/fly-cart.js') }}"></script>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ mix('js/app-user.js') }}"></script>

    <script>
        const popupKey = '{{ $popup->key ?? '' }}'
        if ((popupKey !== '') && (popupKey !== getCookie('popup_key'))) {
            $(window).on('load', function () {
                setTimeout(function () {
                    $('#popupModal').modal('show')
                }, 3000)
            })
            $('#popupModal').on('hide.bs.modal', function (e) {
                setCookie('popup_key', popupKey, 7)
            })
        }

        function openSearch() {
            document.getElementById("search-overlay").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("search-overlay").style.display = "none";
        }
    </script>
    @stack('script')
</body>

</html>
