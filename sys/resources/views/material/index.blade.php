@extends('layouts.adm') 
@section('content')

<link href="{{ URL::asset('adm/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Material</h1>
<a href="{{ url('material/create') }}" class="btn btn-sm btn-primary" >Create</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Material</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Kategori</th>
            <th>Supplier</th>
            <th>Nama</th>
            <!-- <th>Ukuran</th> -->
            <th>Satuan</th>
            <th>Harga</th>
            <th>Keterangan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Kategori</th>
            <th>Supplier</th>
            <th>Nama</th>
            <!-- <th>Ukuran</th> -->
            <th>Satuan</th>
            <th>Harga</th>
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
            <td>{{ $items->kode }}</td>
            <td>{{ $items->kategori_material->kategori }}</td>
            @if($items->supplier!=null)
              <td>{{ $items->supplier->nama}}</td>
            @else
              <td>-</td>
            @endif
            <td>{{ $items->nama_brg }}</td>
            <!-- <td>{{ $items->ukuran }}</td> -->
            <td>{{ $items->satuan }}</td>
            <td>Rp. {{ number_format($items->harga, 2, ',', '.') }}</td>
            <td>{{ $items->keterangan }}</td>
            <td>
            <form action="{{ route('material.destroy', $items->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <!--<a href="{{ route('level.show',$items->id) }}">Lihat</a>-->
                <a class="btn btn-sm btn-success" type="submit" href="{{ route('material.edit',$items->id) }}">Edit</a>
                <button type="button" class="btn btn-sm btn-primary btn-view-pic" pic-num="{{$items->material_pic}}" data-toggle="modal" data-target="#exampleModal">
                View Pic
              </button>
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

<!-- Modal Image -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: center;">
        <img id="show_pic" style="width: 100%; height: auto; " src="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('.btn-view-pic').click(function(){
      $('#show_pic').attr('src',"{{ URL::to('/') }}/images/"+$(this).attr('pic-num'));
    });
  })
</script>
@endsection

