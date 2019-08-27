@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Create Proyek</h4>

                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">Proyek</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                            <div class="col-md-12">


                                
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                        Create New Proyek
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                        <form class="form-horizontal" action="{{ route('proyek.store') }}" method="post">
										{{ csrf_field() }}
                    <div class="form-group row"><label class="col-lg-2 form-control-label">Entity</label>
                      <div class="col-lg-8">
                        <input type="text" name="entity_id" placeholder="Enitity ID" class="form-control" value="1" required> 
                      </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 form-control-label">Kode</label>
                      <div class="col-lg-8">
                        <input type="text" name="kode" placeholder="Kode" class="form-control" required> 
                      </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 form-control-label">Nama</label>
                      <div class="col-lg-8">
                        <input type="text" name="nama" placeholder="Nama" class="form-control" required> 
                      </div>
                    </div>                                            
                    <div class="form-group row"><label class="col-lg-2 form-control-label">Lokasi</label>
                      <div class="col-lg-8">
                        <input type="text" name="lokasi" placeholder="Lokasi" class="form-control" > 
                      </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 form-control-label">Owner</label>
                      <div class="col-lg-8">
                        <input type="text" name="owner" placeholder="Owner" class="form-control" required> 
                      </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 form-control-label">Anggaran</label>
                      <div class="col-lg-8">
                        <input type="text" name="anggaran" placeholder="Anggaran" class="form-control" required> 
                      </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 form-control-label">Tgl Mulai</label>
                      <div class="col-lg-8">
                        <input type="date" name="tgl_mulai" placeholder="Tanggal Mulai" class="form-control" > 
                      </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 form-control-label">Tgl Selesai</label>
                      <div class="col-lg-8">
                        <input type="date" name="tgl_selesai" placeholder="Tanggal Selesai" class="form-control" > 
                      </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 form-control-label">Status</label>
                      <div class="col-lg-8">
                         <select name="status" class="form-control">
                         <option value="1">Aktif</option>
                         <option value="2">Selesai</option>
                         </select>
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