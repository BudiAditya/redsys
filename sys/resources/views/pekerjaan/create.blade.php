@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Create Pekerjaan</h4>

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
                                        Create New Pekerjaan
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                        <form class="form-horizontal" action="{{ route('pekerjaan.store') }}" method="post">
										{{ csrf_field() }}
                    
                    <div class="form-group row"><label class="col-lg-2 form-control-label">Kategori</label>
                      <div class="col-lg-4">
                        <select name="kategori_id" id="" class="form-control select_bagian">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoripekerjaans as $kategoripekerjaan)
                            <option value="{{$kategoripekerjaan->id}}">{{$kategoripekerjaan->kategori}}</option>
                        @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 form-control-label">Pekerjaan</label>
                      <div class="col-lg-8">
                        <input type="text" name="pekerjaan" placeholder="Pekerjaan" class="form-control" required> 
                      </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 form-control-label">Satuan</label>
                      <div class="col-lg-8">
                        <input type="text" name="satuan" placeholder="Satuan" class="form-control" required> 
                      </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 form-control-label">Harga</label>
                      <div class="col-lg-8">
                        <input type="text" name="std_harga" placeholder="Standar Harga" class="form-control" required> 
                      </div>
                    </div>                                            
                    <div class="form-group row"><label class="col-lg-2 form-control-label">Keterangan</label>
                      <div class="col-lg-8">
                        <input type="text" name="keterangan" class="form-control" value="" />
												<!-- <textarea class="form-control" name="keterangan" id="" cols="30" rows="10"></textarea> -->
                      </div>
                    </div>
                    
                                            

                                                
                                            <div class="form-group row">
                                                <div class="col-lg-offset-2 col-lg-8">
                                                    <button class="btn btn-sm btn-primary" type="submit">Save</button>
                                                </div>
                                            </div>
                                        </form>
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
    
    