@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Create Pekerja</h4>

                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">Pekerja</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                            <div class="col-md-12">


                               
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                        Create New Pekerja
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                        <form class="form-horizontal" action="{{ route('pekerja.store') }}" method="post">
										{{ csrf_field() }}
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Nama</label>

                                                <div class="col-lg-8">
												<input type="text" name="nama" placeholder="Nama" class="form-control" required> 
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Alamat</label>

                                                <div class="col-lg-8">
												<input type="text" name="alamat" placeholder="Alamat" class="form-control" > 
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">No HP</label>

                                                <div class="col-lg-8">
												<input type="text" name="hp_no" placeholder="No HP" class="form-control" required> 
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Status Pekerja</label>
                                              <div class="col-lg-8">
                                                <select name="status_pekerja" id="" class="form-control js-example-basic-single">
                                                <option value="">--Status Pekerja--</option>
                                                <option value="1">Sub Kontrak</option>
                                                <option value="2">Bas Developert</option>
                                                </select>
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
    @section('new-script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.js-example-basic-single').select2();
            
        });
    </script>
    @endsection