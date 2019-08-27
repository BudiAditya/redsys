@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Edit Karyawan</h4>

                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">Karyawan</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                            <div class="col-md-12">

                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                        Edit Data Karyawan
                                        <div class="float-right">
                                        </div>
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                       
										@foreach($data as $datas)
										<form class="form-horizontal" action="{{ route('karyawan.update', $datas->id) }}" method="post">
										{{ csrf_field() }}
										{{ method_field('PUT') }}
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Nama</label>

                                                <div class="col-lg-8">
												                            <input type="text" name="nama" placeholder="Nama" value="{{ $datas->nama }}" class="form-control"> 
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Alamat</label>

                                                <div class="col-lg-8">
												                            <input type="text" name="alamat" placeholder="Alamat" value="{{ $datas->alamat }}" class="form-control"> 
                                                </div>
                                            </div>
                                            <!-- <div class="form-group row"><label class="col-lg-2 form-control-label">Bagian</label>

                                                <div class="col-lg-8">
												                            <input type="text" name="bagian" placeholder="Bagian" value="{{ $datas->bagian }}" class="form-control"> 
                                                </div>
                                            </div> -->

                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Bagian</label>
                                              <div class="col-lg-8">
                                                <select name="bagian_id" id="" class="form-control js-example-basic-single">
                                                <option value="">-- Pilih Bagian --</option>
                                                @foreach($bagians as $bagian)
                                                    @if($bagian->id == $datas->bagian->id)
                                                    <option value="{{$bagian->id}}" selected="">{{$bagian->nama}}</option>
                                                    @else
                                                    <option value="{{$bagian->id}}">{{$bagian->nama}}</option>
                                                    @endif
                                                @endforeach
                                                </select>
                                              </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">No HP</label>

                                                <div class="col-lg-8">
												                            <input type="text" name="no_hp" placeholder="No HP" value="{{ $datas->hp_no }}" class="form-control"> 
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Keterangan</label>

                                                <div class="col-lg-8">
                                                    <input type="text" name="keterangan" class="form-control" value="{{$datas->keterangan}}" />
												                            <!-- <textarea class="form-control" name="keterangan" id="" cols="30" rows="10"></textarea> -->
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