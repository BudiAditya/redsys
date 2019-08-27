@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Edit Pekerjaan</h4>

                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">Pekerjaan</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                            <div class="col-md-12">


                                
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                        Edit Data Pekerjaan
                                        <div class="float-right">
                                        </div>
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                       
										@foreach($data as $datas)
										<form class="form-horizontal" action="{{ route('pekerjaan.update', $datas->id) }}" method="post">
										{{ csrf_field() }}
										{{ method_field('PUT') }}
                    
                    <div class="form-group row"><label class="col-lg-2 form-control-label">Kode</label>
                      <div class="col-lg-4">
                        <select name="kategori_id" id="" class="form-control js-example-basic-single">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoripekerjaans as $kategoripekerjaan)
                            @if($kategoripekerjaan->id == $datas->kategori_pekerjaan->id)
                                <option value="{{$kategoripekerjaan->id}}" selected="">{{$kategoripekerjaan->kategori}}</option>
                            @else
                                <option value="{{$kategoripekerjaan->id}}" >{{$kategoripekerjaan->kategori}}</option>
                            @endif
                        @endforeach
                        
                        </select>
                      </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 form-control-label">Pekerjaan</label>
                      <div class="col-lg-8">
                        <input type="text" name="pekerjaan" placeholder="Nama Barang" class="form-control" value="{{$datas->pekerjaan}}" required> 
                      </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 form-control-label">Satuan</label>
                      <div class="col-lg-8">
                        <input type="text" name="satuan" placeholder="Satuan" class="form-control" value="{{$datas->satuan}}"required> 
                      </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 form-control-label">Standar Harga</label>
                      <div class="col-lg-8">
                        <input type="text" name="std_harga" placeholder="Standar Harga" class="form-control" value="{{$datas->std_harga}}" required> 
                      </div>
                    </div>                                            
                    <div class="form-group row"><label class="col-lg-2 form-control-label">Keterangan</label>
                      <div class="col-lg-8">
                         <input type="text" name="keterangan" class="form-control" value="{{$datas->keterangan}}" />
												<!-- <textarea class="form-control" name="keterangan" id="" cols="30" rows="10">{{$datas->keterangan}}</textarea> -->
                      </div>
                    </div>
                                            <div class="form-group row">
                                                <div class="col-lg-offset-2 col-lg-8">
                                                    <button class="btn btn-sm btn-primary" type="submit">Save</button>
                                                </div>
                                            </div>
                                        </form>
										@endforeach
                                    
                                </div>
                            </div>


                    <div class="clearfix"></div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTAINER -->
        </div>
        <!-- /wrapper -->


        <!-- SCROLL TO TOP -->
        <a href="#" id="toTop"></a> 
	@endsection
    @section('new-script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.js-example-basic-single').select2();
            
        });
    </script>
    @endsection