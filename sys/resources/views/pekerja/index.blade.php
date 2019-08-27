@extends('layouts.adm') 
@section('content')

<link href="{{ URL::asset('adm/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Pekerja</h1>
<a href="{{ url('pekerja/create') }}" class="btn btn-sm btn-primary" >Create</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Pekerja</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
        @php
			$no = 1;
		@endphp
			@foreach($data as $items)
           <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $items->nama }}</td>
            <td>{{ $items->alamat }}</td>
            <td>{{ $items->hp_no }}</td>
            @if($items->status==1)
              <td>Sub Kontrak</td>
            @else
              <td>Bas Developert</td>
            @endif
            <td>{{ $items->keterangan }}</td>
            <td>
            <form action="{{ route('pekerja.destroy', $items->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <!--<a href="{{ route('level.show',$items->id) }}">Lihat</a>-->
                <a class="btn btn-sm btn-success" type="submit" href="{{ route('pekerja.edit',$items->id) }}">Edit</a>
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

