@extends('layouts.main-user')
@section('content')
 
  <section>
    <div class="d-flex row">
      <div class="col-lg-5">
        <h2 class="title-color mb-4 ml-lg-4">Login sebagai Pemohon</h2>
        <form id="#" class="appoinment-form ml-lg-3" method="post" action="#">
          <div class="col">
              <div class="form-group">
                  <p>Email<span style="color: #e12454"><b> * </b></span></p>
                  <input name="operator" type="email" class="form-control" placeholder="">
              </div>
              <div class="form-group">
                  <p>Password<span style="color: #e12454"><b> * </b></span></p>
                  <input name="pemilik" type="password" class="form-control" placeholder="">
              </div>
              
              <a class="btn btn-main btn-round" href="#">Submit</a>
          </div>
        </form>
      </div>
      <div class="col-lg-7 img-login img-fluid">
        <img src="/images/tower-landing.jpg" alt="" class="img-fluid mx-auto d-block">
      </div>
    </div>
  </section>  
  
@endsection