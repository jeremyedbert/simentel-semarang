<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Tidak Ditemukan</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href={{ url('assets/admin/img/admin.svg') }} type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src='../../../assets/admin/js/plugin/webfont/webfont.min.js'></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Open+Sans:300,400,600,700"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"],
                urls: ['../../../assets/admin/css/fonts.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href={{ url('assets/admin/css/bootstrap.min.css') }}>
    <link rel="stylesheet" href={{ url('assets/admin/css/azzara.min.css') }}>
    <style>
      .page-not-found{
        background-image: url('/assets/admin/img/tower-landing.jpg')
      }
    </style>
</head>

<body class="page-not-found">
    <div class="wrapper not-found">
        <h1>404</h1>
        <div class="desc"><span>Waduh!</span><br/>Halaman tidak ditemukan :)</div>
        <a href="{{ url()->previous() }}" class="btn btn-primary btn-back-home mt-4">
            <span class="btn-label mr-2">
                <i class="flaticon-left-arrow"></i>
            </span>
            Kembali
        </a>
    </div>
    {{-- <script src="../assets/js/core/jquery.3.2.1.min.js"></script> --}}
    {{-- <script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script> --}}
    {{-- <script src="../assets/js/core/popper.min.js"></script> --}}
    {{-- <script src="../assets/js/core/bootstrap.min.js"></script> --}}

    <script src={{ url('assets/admin/js/core/jquery.3.2.1.min.js') }}></script>
    <script src={{ url('assets/admin/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}></script>
    <script src={{ url('assets/admin/js/core/popper.min.js') }}></script>
    <script src={{ url('assets/admin/js/core/bootstrap.min.js') }}></script>
</body>

</html>
