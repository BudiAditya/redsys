@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Edit TypeRumah</h4>

                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">TypeRumah</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                            <div class="col-md-12">


                                
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                        Edit Data TypeRumah
                                        <div class="float-right">
                                        </div>
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                       
										@foreach($data as $datas)
										<form class="form-horizontal" action="{{ route('typerumah.update', $datas->id) }}" method="post">
										{{ csrf_field() }}
										{{ method_field('PUT') }}
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Type</label>

                                            <div class="col-lg-8">
                                            <input type="text" name="type" placeholder="Type" class="form-control" value="{{$datas->type}}" required> 
                                            </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Luas Tanah</label>

                                            <div class="col-lg-8">
                                            <input type="number" name="luas_tanah" placeholder="Luas Tanah" class="form-control" value="{{$datas->luas_tanah}}"> 
                                            </div>
                                            </div>

                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Luas Bangunan</label>

                                            <div class="col-lg-8">
                                            <input type="number" name="luas_bangunan" placeholder="Luas Bangunan" class="form-control" value="{{$datas->luas_bangunan}}"> 
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