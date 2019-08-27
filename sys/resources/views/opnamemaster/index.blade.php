@extends('layouts.adm') 
@section('content')

<link href="{{ URL::asset('adm/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Opname Master</h1>
<a href="{{ url('opnamemaster/create') }}" class="btn btn-sm btn-primary" >Create</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Opname Master</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Proyek</th>
            <th>Unit</th>
            <th>Customer</th>
            <th>Jumlah RAB</th>
            <th>Nilai Progress</th>
            <th>Sisa</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
         <th>No</th>
            <th>Proyek</th>
            <th>Unit</th>
            <th>Customer</th>
            <th>Jumlah RAB</th>
            <th>Nilai Progress</th>
            <th>Sisa</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
			@foreach($opnamemasters as $key => $opnamemaster)
           <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $opnamemaster->unitrumah->proyek->nama }}</td>
            <td>{{ $opnamemaster->unitrumah->typerumah->type }}</td>
            <td>{{ $opnamemaster->unitrumah->customer->nama }}</td>

            @php
              $jum_RAB = 0;
              foreach($opnamemaster->unitrumah->rabpekerjaanunits as $rabpekerjaanunit):
                if(!$rabpekerjaanunit->is_delete)
                  $jum_RAB += 100 * $rabpekerjaanunit->price;
              endforeach;
              
            @endphp
            <!-- <td>{{$jum_RAB}}</td> -->
            <td>Rp. {{ number_format($jum_RAB, 2, ',', '.') }}</td>

            @php
              $result = 0;
              foreach($opnamemaster->unitrumah->progresopnammes as $progresopnamme):
                if(!$progresopnamme->is_delete)
                  $result += $progresopnamme->persentase*$progresopnamme->price;
              endforeach;
              
            @endphp
            <!-- <td>{{$result}}</td> -->
            <td>Rp. {{ number_format($result, 2, ',', '.') }}</td>

            <!-- <td>{{ $jum_RAB - $result }}</td> -->
            <td>Rp. {{ number_format(($jum_RAB - $result), 2, ',', '.') }}</td>
            <td>
            <form action="{{ route('opnamemaster.destroy', $opnamemaster->unitrumah->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                
                <a class="btn btn-sm btn-success" type="submit" href="{{ route('opnamemaster.edit',$opnamemaster->id) }}">Edit</a>
                <button style="color:white;" class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
            </form>
            </td>
            </tr>
        @endforeach   
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>
  <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
  <div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
    <a class="btn btn-primary" href="{{ url('/logout') }}">Logout</a>
  </div>
</div>
</div>
</div>

@endsection

