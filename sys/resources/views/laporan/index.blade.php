@extends('layouts.adm') 
@section('content')

<link href="{{ URL::asset('adm/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">

<!-- Begin Page Content -->
<div class="container-fluid">
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Laporan</h1>
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Laporan</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        
        <div class="mb-2">
          <form action="" class="search">
            <div class="row">
              <div class="col-sm-3">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                  </div>
                  <input type="text" placeholder="Tanggal Minimum" name="date_min" value="{{ request()->date_min }}" class="form-control datepicker" autocomplete="off">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                  </div>
                  <input type="text" placeholder="Tanggal Maksimum" name="date_max" value="{{ request()->date_max }}" class="form-control datepicker" autocomplete="off">
                </div>
              </div>
            </div>
          </form>
        </div>
        <table class="table table-bordered" id="laporan-datatable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Pemilik</th>
              <th>Nomor Polisi</th>
              <th>Jenis / Model</th>
              <th>Merek</th>
              <th>Tanggal</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Nama Pemilik</th>
              <th>Nomor Polisi</th>
              <th>Jenis / Model</th>
              <th>Merek</th>
              <th>Tanggal</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach ($data as $key => $row)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>
                {{ $row->pemilik }} <br>
                <span class="badge badge-{{ $row->type === 'Surat Jalan' ? 'success' : 'info' }}">{{ $row->type }}</span>
              </td>
              <td>{{ $row->no_pol }}</td>
              <td>{{ $row->Kendaraan->name }}</td>
              <td>{{ $row->Merek->name }}</td>
              <td>{{ $row->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
</div>
<!-- /.container-fluid -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
  $(document).ready(() => {
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd'
    })

    $('.datepicker').change(() => {
      $('form.search').submit()
    })

    $('#laporan-datatable').DataTable()
  })
</script>
@endsection

