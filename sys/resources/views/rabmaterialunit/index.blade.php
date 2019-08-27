@extends('layouts.adm') 
@section('content')

<link href="{{ URL::asset('adm/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Rab Material Unit</h1>
<a href="{{ url('rabmaterialunit/create') }}" class="btn btn-sm btn-primary" >Create</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Rab Material Unit</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Proyek</th>
            <th>Alamat</th>
            <th>Customer</th>
            <th>Total RAB Material</th>
            <th>Pemakaian</th>
            <th>Sisa</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>No</th>
            <th>Nama Proyek</th>
            <th>Alamat</th>
            <th>Customer</th>
            <th>Total RAB Material</th>
            <th>Pemakaian</th>
            <th>Sisa</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
          @php
            $num = 1;
          @endphp
			@foreach($rabmaterialunits as $key => $rabmaterialunit)
           <tr>
            <td>{{ $num++ }}</td>
            @if($rabmaterialunit->unitrumah->proyek!=null)
              <td>{{ $rabmaterialunit->unitrumah->proyek->nama }}</td>
            @else
              <td>-</td>
            @endif
            <td>{{ $rabmaterialunit->unitrumah->alamat }}</td>
            <td>{{ $rabmaterialunit->unitrumah->customer->nama }}</td>

            @php
              $result = 0;
              foreach($rabmaterialunit->unitrumah->rabmaterialunits as $unitmaterial):
                if(!$unitmaterial->is_delete)
                  $result += $unitmaterial->qty* $unitmaterial->price;
              endforeach

            @endphp
            <td>Rp. {{ number_format($result, 2, ',', '.') }}</td>

            @php
              $pemakaian = 0;
              foreach($rabmaterialunit->unitrumah->pakaimaterials as $key => $unitmaterial):
                if(!$unitmaterial->is_delete)
                  $pemakaian += $unitmaterial->qty* $unitmaterial->price;
              endforeach;
            

            @endphp
            <td>Rp. {{ number_format($pemakaian, 2, ',', '.') }}</td>
            <td>Rp. {{ number_format(($result-$pemakaian), 2, ',', '.') }}</td>
            <td>
              
           <form action="{{ route('rabmaterialunit.permanentdelete', $rabmaterialunit->unitrumah->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                
                <a class="btn btn-sm btn-success" type="submit" href="{{ route('rabmaterialunit.edit',$rabmaterialunit->id) }}">Edit</a>

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

