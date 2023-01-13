<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>SIMenTel</title>
<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
<link rel="icon" href={{ url('assets/admin/img/admin.svg') }} type="image/x-icon" />

<!-- Fonts and icons -->
<script src='../../../assets/admin/js/plugin/webfont/webfont.min.js'></script>
{{-- <link rel="icon" href={{ url('assets/admin/js/plugin/webfont/webfont.min.js') }} type="image/x-icon" /> --}}
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

<!-- CSS Just for demo purpose, don't include it in your project -->
{{-- <link rel="stylesheet" href='assets/admin/css/demo.css'> --}}
