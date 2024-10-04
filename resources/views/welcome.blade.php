<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <title>Made One</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="favicon.ico">

    <!--Google Font link-->
    <link
        href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('made/assets/css/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('made/assets/css/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('made/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('made/assets/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('made/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('made/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('made/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('made/assets/css/bootsnav.css') }}">

    <!-- xsslider slider css -->


    <!--<link rel="stylesheet" href="{{ asset('made/assets/css/xsslider.css') }}">-->




    <!--For Plugins external css-->
    <!--<link rel="stylesheet" href="{{ asset('made/assets/css/plugins.css') }}" />-->

    <!--Theme custom css -->
    <link rel="stylesheet" href="{{ asset('made/assets/css/style.css') }}">
    <!--<link rel="stylesheet" href="{{ asset('made/assets/css/colors/maron.css') }}">-->

    <!--Theme Responsive css-->
    <link rel="stylesheet" href="{{ asset('made/assets/css/responsive.css') }}" />

    <script src="{{ asset('made/assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
</head>

<body data-spy="scroll" data-target=".navbar-collapse">

    <div class="culmn">
        <!--Home page style-->


        @include('landing-page.layouts.header')

        @yield('content')

        @include('landing-page.layouts.footer')

    </div>

    <!-- JS includes -->

    <script src="{{ asset('made/assets/js/vendor/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ asset('made/assets/js/vendor/bootstrap.min.js') }}"></script>

    <script src="{{ asset('made/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('made/assets/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('made/assets/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('made/assets/css/slick/slick.js') }}"></script>
    <script src="{{ asset('made/assets/css/slick/slick.min.js') }}"></script>
    <script src="{{ asset('made/assets/js/jquery.collapse.js') }}"></script>
    <script src="{{ asset('made/assets/js/bootsnav.js') }}"></script>

    <script src="{{ asset('made/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('made/assets/js/main.js') }}"></script>

    <script>
        document.querySelectorAll('.navbar-nav > li > a').forEach(item => {
            item.addEventListener('click', function(e) {
                const dropdown = this.nextElementSibling;
                if (dropdown && dropdown.classList.contains('dropdown')) {
                    e.preventDefault(); // Mencegah tautan default
                    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                }
            });
        });

        // Menyembunyikan dropdown ketika mengklik di luar
        window.addEventListener('click', function(e) {
            if (!e.target.matches('.navbar-nav > li > a')) {
                document.querySelectorAll('.dropdown').forEach(dropdown => {
                    dropdown.style.display = 'none';
                });
            }
        });
    </script>

</body>

</html>
