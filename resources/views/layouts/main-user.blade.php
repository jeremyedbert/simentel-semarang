<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<!-- 
THEME: Novena- Health Care and Medical template
VERSION: 1.0.0
AUTHOR: Themefisher

HOMEPAGE: https://themefisher.com/products/novena-medical-template/
DEMO: https://demo.themefisher.com/novena/
GITHUB: https://github.com/themefisher/Novena-Health-Care-Medical-Template

WEBSITE: https://themefisher.com
TWITTER: https://twitter.com/themefisher
FACEBOOK: https://www.facebook.com/themefisher
-->

<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.user-header')
</head>

<body id="top">

    <header>
        @include('partials.user-navbar')
    </header>


    <!-- Slider Start -->
    @yield('content')
    <!-- footer Start -->
    @include('partials.user-footer')
    <!-- 
    Essential Scripts
    =====================================-->
    <script src="assets/user/plugins/jquery/jquery.js"></script>
    <script src="assets/user/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/user/plugins/slick-carousel/slick/slick.min.js"></script>
    <script src="assets/user/plugins/shuffle/shuffle.min.js"></script>

    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkeLMlsiwzp6b3Gnaxd86lvakimwGA6UA"></script>
    <script src="assets/user/plugins/google-map/gmap.js"></script>

    <script src="assets/user/js/script.js"></script>

</body>

</html>
