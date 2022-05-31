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
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
</head>

<body id="top" onload="initialize();">

    <header>
        @include('partials.user-navbar')
    </header>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- File Pond -->
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <!-- Slider Start -->
    @yield('content')
    <!-- footer Start -->
    @include('partials.user-footer')
    <!-- 
      
    Essential Scripts
    =====================================-->
    <script src="{{ url('assets/user/plugins/jquery/jquery.js') }}"></script>
    <script src="{{ url('assets/user/plugins/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/user/plugins/slick-carousel/slick/slick.min.js') }}"></script>
    <script src="{{ url('assets/user/plugins/shuffle/shuffle.min.js') }}"></script>

    <!-- Google Map -->
    {{-- <script src="assets/user/plugins/google-map/gmap.js"></script> --}}

    <script src="{{ url('assets/user/js/script.js') }}"></script>    

</body>

</html>
