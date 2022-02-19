@extends('layouts.main-user')
@section('content')
    <style>
        .background {
            background-image: url("/images/tower-landing.jpg");
            width: 100%;
        }

    </style>
    <section class="banner background">
        <div class="container">
            @if (session('resent'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    Pesan verifikasi sudah dikirimkan. Silakan lihat kotak masuk Anda.

                </div>
            @endif
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="block">
                        <div class="divider mb-3"></div>
                        <span class="text-uppercase letter-spacing" style="color: #e12454"><b>Selamat datang di</b></span>
                        <h1 class="mb-3 mt-2">Sistem Informasi<br> Menara Telekomunikasi<br> Kota Semarang</h1>

                        {{-- <p class="mb-4 pr-5">Tentukan lokasi. Daftar. Selesai.</p> --}}
                        <div class="btn-container ">
                            {{-- <div class="mb-2"> --}}
                            <a href="/user/peta-menara" class="btn btn-main-2 btn-icon btn-round-full mr-2 my-2">
                                Lihat Peta Menara<i class="icofont-simple-right ml-2"></i>
                            </a>
                            {{-- </div>
                            <div> --}}
                            <a href="/user/daftar-menara" class="btn btn-main btn-icon btn-round-full mr-2 my-2">
                                Daftarkan Menara<i class="icofont-simple-right ml-2  "></i>
                            </a>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="feature-block d-lg-flex">
                        <div class="feature-item mb-5 mb-lg-0">
                            <div class="feature-icon mb-4">
                                <i class="icofont-location-pin"></i>
                            </div>
                            <span>Kantor Pelayanan</span>
                            <h4 class="mb-3">Diskominfo Kota Semarang</h4>
                            <p class="mb-4">Jl. Pemuda No.148 Sekayu, Kec. Semarang Tengah, Kota Semarang, Jawa
                                Tengah 50132</p>
                            <a href="https://www.google.com/maps/place/Dinas+Kominfo+Kota+Semarang/@-6.9837516,110.4118455,17z/data=!4m5!3m4!1s0x2e708b4fd277d06b:0x4056bfa9e8303c06!8m2!3d-6.9836393!4d110.413617"
                                target="blank" class="btn btn-main btn-round-full">
                                <i class="icofont-search-map"></i>
                                Lihat lokasi di Maps
                            </a>
                        </div>

                        <div class="feature-item mb-5 mb-lg-0">
                            <div class="feature-icon mb-4">
                                <i class="icofont-ui-clock"></i>
                            </div>
                            <span>Waktu Layanan</span>
                            <h4 class="mb-3">5 Hari Kerja</h4>
                            <ul class="w-hours list-unstyled">
                                <li class="d-flex justify-content-between">Senin - Kamis<span>07:00 - 15:00</span></li>
                                <li class="d-flex justify-content-between">Jumat<span>07:00 - 11:30</span></li>
                                <li class="d-flex justify-content-between">Sabtu - Minggu<span>Tutup</span></li>
                            </ul>
                        </div>

                        <div class="feature-item mb-5 mb-lg-0">
                            <div class="feature-icon mb-4">
                                <i class="icofont-support"></i>
                            </div>
                            <span>Punya Pertanyaan?</span>
                            <h4 class="mb-3">Hubungi Kami</h4>
                            <p>
                                <i class="icofont-email mr-2"></i>simentel@semarangkota.go.id
                                <br>
                                <i class="icofont-ui-call mr-2"></i>(024) 3513366
                            </p>
                            <a href="https://api.whatsapp.com/send?phone=6281222810002" href="https://wa.me/6281222810002"
                                target="blank" class="btn btn-main btn-round-full align-middle">
                                <i class="icofont-brand-whatsapp mr-1"></i>
                                Hubungi via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-sm-4">
                    <div class="about-img">
                        <img src="/images/tower-1.jpg" alt="" class="img-fluid tower-img mx-auto d-block">
                        <img src="/images/microcell-2.jpg" alt="" class="img-fluid mt-4 tower-img mx-auto d-block">
                    </div>
                </div>
                <div class="col-lg-5 col-sm-8">
                    <div class="mt-4 mt-lg-0">
                        <img src="/images/tower-map.png" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="about-content pl-4 mt-4 mt-lg-0">
                        <h2 class="title-color">Persebaran Lokasi Menara & Microcell</h2>
                        <p class="mt-3 mb-4">Temukan lokasi menara utama dan menara microcell di Kota Semarang.
                            Anda juga dapat melihat titik radius yang diperbolehkan untuk pendirian menara.
                        </p>
                        <a href="/user/peta-menara" class="btn btn-main-2 btn-round-full btn-icon my-1">
                            Lihat Peta Menara
                            {{-- <i class="icofont-simple-right ml-3"></i> --}}
                        </a>
                        <a href="/user/peta-microcell" class="btn btn-main-2 btn-round-full btn-icon my-1">
                            Lihat Peta Microcell
                            {{-- <i class="icofont-simple-right ml-3"></i> --}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="cta-section ">
        <div class="container">
            <div class="cta position-relative">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="counter-stat">
                            <i class="icofont-network-tower"></i>
                            <span class="h3 counter" data-count="58">0</span>
                            <p>Menara Utama</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="counter-stat">
                            <i class="icofont-network-tower"></i>
                            <span class="h3 counter" data-count="700">0</span>
                            <p>Menara Microcell</p>
                        </div>
                    </div>
                    {{-- <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="counter-stat">
                            <i class="icofont-flag"></i>
                            <span class="h3 counter" data-count="10">0</span>
                            <p>Provider</p>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

    <section class="section appoinment">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 ">
                    <div class="appoinment-content">
                        <img src="/images/online-form.png" alt="" class="img-fluid mx-auto d-block">
                        {{-- <div class="emergency">
                            <h2 class="text-lg"><i class="icofont-phone-circle text-lg"></i>+23 345 67980</h2>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-6 col-md-10 ">
                    <div class="appoinment-wrap mt-5 mt-lg-0">
                        <h2 class="mb-4 title-color">Pengajuan Izin dan Pendaftaran Menara/Microcell</h2>
                        <p class="mb-2">SI MenTel menjadikan pengajuan izin dan pendaftaran menara/microcell
                            menjadi lebih mudah. Cukup ikuti beberapa langkah berikut.</p>
                        <ol class="mb-4">
                            <li><a href="{{ route('user.login') }}"><b>Login</b></a> sebagai pemohon atau <a
                                    href="{{ route('user.register') }}"><b>buat akun</b></a> terlebih dahulu bila belum
                                memilikinya. Pastikan email yang Anda masukkan sudah sesuai</li>
                            <li>Verifikasi email Anda</li>
                            <li>Pilih tab <a href="{{ route('user.') }}"><b>"Pendaftaran"</b></a>, lalu isi formulir. Anda
                                dapat mengisi detail menara,
                                menentukan koordinat lokasinya, hingga mengunggah dokumen pendukung</li>
                            <li>Klik "Ajukan Izin/Pendaftaran", kami akan segera melakukan tinjauan lokasi dan kelayakan
                            </li>
                            <li>Tunggu verifikasi dari kami. Notifikasi akan kami kirimkan melalui email Anda</li>
                            <li>Surat izin pendirian menara dapat Anda unduh setelah kami verifikasi</li>
                        </ol>
                        {{-- <form id="#" class="appoinment-form" method="post" action="#">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>Choose Department</option>
                                            <option>Software Design</option>
                                            <option>Development cycle</option>
                                            <option>Software Development</option>
                                            <option>Maintenance</option>
                                            <option>Process Query</option>
                                            <option>Cost and Duration</option>
                                            <option>Modal Delivery</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select class="form-control" id="exampleFormControlSelect2">
                                            <option>Select Doctors</option>
                                            <option>Software Design</option>
                                            <option>Development cycle</option>
                                            <option>Software Development</option>
                                            <option>Maintenance</option>
                                            <option>Process Query</option>
                                            <option>Cost and Duration</option>
                                            <option>Modal Delivery</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input name="date" id="date" type="text" class="form-control"
                                            placeholder="dd/mm/yyyy">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input name="time" id="time" type="text" class="form-control" placeholder="Time">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input name="name" id="name" type="text" class="form-control"
                                            placeholder="Full Name">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input name="phone" id="phone" type="Number" class="form-control"
                                            placeholder="Phone Number">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-2 mb-4">
                                <textarea name="message" id="message" class="form-control" rows="6"
                                    placeholder="Your Message"></textarea>
                            </div>

                            
                        </form> --}}
                        <a class="btn btn-main btn-round-full" href="/user/daftar-menara">Daftarkan Menara <i
                                class="icofont-simple-right ml-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section testimonial-2 gray-bg">
        {{-- <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section-title text-center">
                        <h2>We served over 5000+ Patients</h2>
                        <div class="divider mx-auto my-4"></div>
                        <p>Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt
                            molestias nostrum laudantium. Maiores porro cumque quaerat.</p>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 testimonial-wrap-2">
                    <div class="testimonial-block style-2  gray-bg">
                        <i class="icofont-quote-right"></i>

                        <div class="testimonial-thumb">
                            <img src="assets/user/images/team/elon.png" alt="" class="img-fluid">
                        </div>

                        <div class="client-info ">
                            <h4>5000 Dogecoins for SI MenTel</h4>
                            <span>Elon Mas</span>
                            <p>
                                SI MenTel amazed me with great service, so I gave them 5000 Dogecoin to built new system
                                for Tesla communication tower. Oh, dont't forget about SpaceX! We're working together now.
                            </p>
                        </div>
                    </div>

                    <div class="testimonial-block style-2  gray-bg">
                        <div class="testimonial-thumb">
                            <img src="assets/user/images/team/mark.jpg" alt="" class="img-fluid">
                        </div>

                        <div class="client-info">
                            <h4>We are closer to the metaverse</h4>
                            <span>Mark Suckerbergzhjkl</span>
                            <p>
                                Since Meta was still Facebook. I've used SI MenTel for registering the towers. They have
                                best service
                                to support telecommunication. With SI MenTel, we are closer to the metaverse!
                            </p>
                        </div>

                        <i class="icofont-quote-right"></i>
                    </div>

                    <div class="testimonial-block style-2  gray-bg">
                        <div class="testimonial-thumb">
                            <img src="assets/user/images/team/naruto.jpg" alt="" class="img-fluid">
                        </div>

                        <div class="client-info">
                            <h4>Demi perdamaian dunia</h4>
                            <span>Uzumaki Naruto</span>
                            <p>
                                Sejak SI MenTel hadir, jumlah menara telekomunikasi di Desa Konoha meningkat pesat.
                                Hal ini membuat komunikasi kami dengan desa sekitar semakin baik, begitu pun dengan Kota
                                Semarang.
                                SI MenTel sudah mendukung terwujudnya perdamaian keempat desa dan membantu mengakhiri Perang
                                Dunia Ninja
                            </p>
                        </div>
                        <i class="icofont-quote-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
