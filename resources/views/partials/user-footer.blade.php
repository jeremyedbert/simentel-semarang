<footer class="footer gray-bg pt-5">
  <style>
    .logo-diskominfo{
      border-right: solid 2px #223a66;
    }
    
    @media (max-width: 576px) {
      .logo-diskominfo{
        border-right: 0;
      }
    }
  </style>
  <div class="container">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <a href="https://diskominfo.semarangkota.go.id/" target="blank">
            <img src="{{ url('images/logo-diskominfo.png') }}" class="mr-2 pr-3 logo-diskominfo" width="200px" alt="">
          </a>
          <a href="{{ route('home') }}">
            <img src="{{ url('images/logosimentelblue.svg') }}" class="mr-4 mt-3 mt-md-0" width="200px" alt="">
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="widget mb-5 mb-lg-0">
              <h4 class="text-capitalize mb-3">Informasi Kontak</h4>
              <div class="divider mb-4"></div>

              <ul class="list-unstyled footer-menu lh-35">
                  <li class="d-flex">
                    <span><i class="icofont-institution mr-2"></i></span> 
                    <span> Jl. Pemuda No.148 Sekayu,<br> Kec. Semarang Tengah, Kota Semarang,<br>
                       Jawa Tengah 50132</span> 
                  </li>
                  <li class="d-flex">
                    <span><i class="icofont-clock-time mr-2"></i></span>
                    <span>Senin - Jumat, 07.00 - 15.00</span> 
                  </li>
                  <li class="d-flex">
                    <span><i class="icofont-email mr-2"></i></span>
                    <span>simentel@semarangkota.go.id</span> 
                  </li>
                  <li class="d-flex">
                    <span><i class="icofont-ui-call mr-2"></i></span>
                    <span>(024) 3513366</span> 
                  </li>
                  <li class="d-flex">
                    <span><i class="icofont-brand-whatsapp mr-2"></i></span>
                    <span>+62812 2281 0002</span> 
                  </li>
              </ul>
          </div>
      </div>

          <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="widget mb-5 mb-lg-0">
                  <h4 class="text-capitalize mb-3">Navigasi</h4>
                  <div class="divider mb-4"></div>

                  <ul class="list-unstyled footer-menu lh-35">
                      <li><a href="{{ route('home') }}">Beranda </a></li>
                      <li><a href="/user/daftar-menara">Pendaftaran</a></li>
                      <li><a href="/user/peta-menara">Peta Menara Makro</a></li>
                      <li><a href="/user/peta-microcell">Peta Microcell</a></li>
                      @auth
                        <li><a href="/user/cekstatus">Cek Status Permohonan</a></li>
                        <li><a href="/user/edit">Edit Profil</a></li>
                      @else
                        <li><a href="{{ route('user.login') }}">Login sebagai Pemohon</a></li>
                      @endauth
                  </ul>
              </div>
          </div>

          <div class="col-lg-4 col-md-12 col-sm-12">
              <div class="widget mb-5 mb-lg-0">
                  <h4 class="text-capitalize mb-3">Peta Lokasi</h4>
                  <div class="divider mb-4"></div>

                  <div class=" mb-4">
                      <div class="icon d-flex align-items-center">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2176680560888!2d110.4114584147208!3d-6.983619694954946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b4fd277d06b%3A0x4056bfa9e8303c06!2sDinas%20Kominfo%20Kota%20Semarang!5e0!3m2!1sid!2sid!4v1579572986664!5m2!1sid!2sid" 
                          width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="">
                        </iframe>
                      </div>    
                  </div>
              </div>
          </div>
      </div>

      <div class="footer-btm py-4 mt-3">
          <div class="row align-items-center justify-content-center">
            <div class="col-lg-12 copyright text-center">
                Copyright &copy; 2022, Sistem Informasi Menara Telekomunikasi, Dinas Kominfo Kota Semarang
            </div>   
          </div>

          <div class="row">
              <div class="col-lg-4">
                  <a class="backtop scroll-top-to" href="#top">
                      <i class="icofont-long-arrow-up"></i>
                  </a>
              </div>
          </div>
      </div>
  </div>
</footer>