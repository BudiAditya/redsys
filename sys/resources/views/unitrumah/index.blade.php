@extends('layouts.adm') 
@section('content')

<link href="{{ URL::asset('adm/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Unit Rumah</h1>
<a href="{{ url('unitrumah/create') }}" class="btn btn-sm btn-primary" >Create</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Unit Rumah</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Type</th>
            <th>Proyek</th>
            <th>Alamat</th>
            <th>Luas Bangunan</th>
            <th>Luas Tanah</th>
            <th>Status Pekerjaan</th>
            <th>Status Pembelian</th>
            <th>Status Progress</th>
            <th>Customer</th>
            <th>Mulai Bangun</th>
            <th>Selesai Bangun</th>
            <th>Tanggal Serah Terima Kunci</th>
            <th>Pekerja</th>
            <th>Arsitek</th>
            <th>Pengawas</th>
            <th>Marketing</th>
            <th>Keterangan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>No</th>
            <th>Type</th>
            <th>Proyek</th>
            <th>Alamat</th>
            <th>Luas Bangunan</th>
            <th>Luas Tanah</th>
            <th>Status Pekerjaan</th>
            <th>Status Pembelian</th>
            <th>Status Progress</th>
            <th>Customer</th>
            <th>Mulai Bangun</th>
            <th>Selesai Bangun</th>
            <th>Tanggal Serah Terima Kunci</th>
            <th>Pekerja</th>
            <th>Arsitek</th>
            <th>Pengawas</th>
            <th>Marketing</th>
            <th>Keterangan</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
            @php
                $num =1;
            @endphp
			@foreach($unitrumahs as $key => $unitrumah)
           <tr>
            <td>{{ $num++ }}</td>
            <td>{{ $unitrumah->typerumah->type }}</td>

            @if($unitrumah->proyek!=null)
                <td>{{ $unitrumah->proyek->nama }}</td>
            @else
                <td>-</td>
            @endif
            <td>{{ $unitrumah->alamat }}</td>
            <td>{{ $unitrumah->luas_bangunan }}</td>
            <td>{{ $unitrumah->luas_tanah }}</td>
            @if($unitrumah->status_pekerjaan==0)
                <td>Standar</td>
            @else
                <td>Perluasan/Penambahan</td>
            @endif

            @if($unitrumah->status_beli==1)
                <td>Akad Fix</td>
            @else
                <td>Booking</td>
            @endif

            @if($unitrumah->status_progress==0)
                <td>Progress</td>
            @else
                <td>Selesai</td>
            @endif
            <td>{{ $unitrumah->customer->nama }}</td>
            <td>{{ $unitrumah->mulai_bangun }}</td>
            <td>{{ $unitrumah->selesai_bangun }}</td>
            <td>{{ $unitrumah->tst_kunci }}</td>
            <td>{{ $unitrumah->pekerja->nama }}</td>

            @if($unitrumah->arsitek!=null)
                <td>{{ $unitrumah->arsitek->nama }}</td>
            @else
                <td>-</td>
            @endif

            @if($unitrumah->arsitek!=null)
                <td>{{ $unitrumah->arsitek->nama }}</td>
            @else
                <td>-</td>
            @endif

            @if($unitrumah->marketing!=null)
                <td>{{ $unitrumah->marketing->nama }}</td>
            @else
                <td>-</td>
            @endif
            <td>{{ $unitrumah->keterangan }}</td>
            <td>
            <form action="{{ route('unitrumah.destroy', $unitrumah->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                
                <a class="btn btn-sm btn-success" type="submit" href="{{ route('unitrumah.edit',$unitrumah->id) }}">Edit</a>
                <button style="color:white;" class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data? Menghapus Unit akan menghapus Data RAB Material Unit')">Delete</button>
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

