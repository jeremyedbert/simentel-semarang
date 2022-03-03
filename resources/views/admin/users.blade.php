@extends('layouts.main-admin')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h1 style="color: black" class="pb-3"><b>Daftar Pengguna</b></h1>
                </div>

                <div class="row">
                  <div class="col-md-12">
                      <div class="card">
                          <div class="card-body">
                              <div class="table-responsive">
                                  <table id="basic-datatables" class="display table table-striped table-hover">
                                      <thead>
                                          <tr>
                                              <th>Nama</th>
                                              <th>Pemilik</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($data as $d)
                                              <tr>
                                                  <td>{{ $d->name }}</td>
                                                  <td>
                                                      <a href="/admin/pendaftaran/edit"
                                                          class="btn btn-info btn-xs my-1 mx-1"><span><i
                                                                  class="fas fa-eye"></i></span> Detail &
                                                          Edit</a>
                                                  </td>
                                              </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

            </div>
        </div>
    </div>
    <script>
      $(document).ready(function() {
          $('#basic-datatables').DataTable();
      })
  </script>
@endsection
