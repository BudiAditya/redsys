@extends('layouts.adm') 
@section('content')

<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Edit Settings</h4>

                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">Settings</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                            <div class="col-md-12">


                                <div class="col-md-12">
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                        Edit Settings
                                        <div class="float-right">
                                            
                                        </div>
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                       
										@foreach($setting as $item)
										<form class="form-horizontal" action="{{ URL::asset('setting/submit') }}/{{ $item->id }}" method="post" enctype="multipart/form-data">
										@csrf
										
											<div class="form-group row"><label class="col-lg-2 form-control-label">Name</label>
                                                <div class="col-lg-10">
													<input type="text" name="name" placeholder="Name" value="{{ $item->name }}" class="form-control" required> 
												</div>
											</div>
											
											<div class="form-group row"><label class="col-lg-2 form-control-label">Description</label>
                                                <div class="col-lg-10">
													<textarea style="height: 100px" name="description" class="form-control" required>{{ $item->description }}</textarea>
												</div>
											</div>
											
											<div class="form-group row"><label class="col-lg-2 form-control-label">Logo</label>
                                                <div class="col-lg-10">
													<input type="file" name="logo" class="form-control" >
												</div>
											</div>
											
											<div class="form-group row"><label class="col-lg-2 form-control-label">Company</label>
                                                <div class="col-lg-10">
													<input type="text" name="company" placeholder="Company" value="{{ $item->company }}" class="form-control" required> 
												</div>
											</div>
											
											<div class="form-group row"><label class="col-lg-2 form-control-label">Address</label>
                                                <div class="col-lg-10">
													<input type="text" name="address" placeholder="Address" value="{{ $item->address }}" class="form-control" required> 
												</div>
											</div>
											
											<div class="form-group row"><label class="col-lg-2 form-control-label">Phone</label>
                                                <div class="col-lg-10">
													<input type="text" name="phone" placeholder="Phone" value="{{ $item->phone }}" class="form-control" required> 
												</div>
											</div>
											
											<div class="form-group row"><label class="col-lg-2 form-control-label">Email</label>
                                                <div class="col-lg-10">
													<input type="text" name="email" placeholder="Email" value="{{ $item->email }}" class="form-control" required> 
												</div>
											</div>
											
                                            <div class="form-group row">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-sm btn-primary" type="submit">Update</button>
                                                </div>
                                            </div>
                                        </form>
										@endforeach
                                    </div>
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