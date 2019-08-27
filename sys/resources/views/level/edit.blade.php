@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Edit Level</h4>

                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">Level</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                            <div class="col-md-12">


                                
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                        Edit Jenis Level
                                        <div class="float-right">
                                        </div>
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                       
										@foreach($data as $datas)
										<form class="form-horizontal" action="{{ route('level.update', $datas->id) }}" method="post">
										{{ csrf_field() }}
										{{ method_field('PUT') }}
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Level</label>

                                                <div class="col-lg-10">
												<input type="text" name="name" placeholder="Name" value="{{ $datas->name }}" class="form-control"> 
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Status</label>

                                                <div class="col-lg-10">
												<select name="status_aktif" class="form-control select">
												@foreach($data as $tarik)
												<option value="{{ $tarik->status_aktif }}">
												@if ($tarik->status_aktif == 1)
													Aktif
												 @elseif ($tarik->status_aktif == 2)
													Tidak Aktif
												 @else
													Not Available
												 @endif
												</option>
												<option value="{{ $tarik->status_aktif }}">-- Pilih --</option>
												@endforeach
													<option value="1">Aktif</option>
													<option value="0">Tidak Aktif</option>
												</select>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-offset-2 col-lg-10">
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