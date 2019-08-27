@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Edit User</h4>

                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">User</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                            <div class="col-md-12">


                                
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                        Edit User
                                        <div class="float-right">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info btn-rounded btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action <span class="caret"></span></button>
                                                <div class="dropdown-menu panel-dropdown" role="menu">
                                                    <a  class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>

                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                        <form class="form-horizontal" action="{{ route('user.update', $data->id) }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="PATCH">
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Level</label>

                                                <div class="col-lg-10">
                                                <select name="level_id" id="level_id" class="form-control{{ $errors->has('level_id') ? ' is-invalid' : '' }}">
                                                    <option>Select Level</option>

                                                    @foreach($level as $level)
                                                      <option value="{{ $level->id }}"> {{ $level->level }}</option>
                                                    @endforeach
                                                  </select>

                                                  @if ($errors->has('level_id'))
                                                      <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $errors->first('level_id') }}</strong>
                                                      </span>
                                                  @endif
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Nama</label>

                                                <div class="col-lg-10">
                                                <input type="text" name="name" placeholder="Nama" value="{{ $data->name }}" class="form-control" required> 
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Email</label>

                                                <div class="col-lg-10">
                                                <input type="email" name="email" value="{{ $data->email }}" placeholder="Email" class="form-control" required> 
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Password</label>

                                                <div class="col-lg-10">
                                                <input type="password" name="password" class="form-control" required> 
                                                </div>
                                            </div>
											
											
											 <div class="form-group row"><label class="col-lg-2 form-control-label">NIP</label>

                                                <div class="col-lg-10">
                                                <input type="text" name="nip" placeholder="NIP" value="{{ $data->nip }}" class="form-control" required> 
                                                </div>
                                            </div>
											
											 <div class="form-group row"><label class="col-lg-2 form-control-label">Jabatan</label>

                                                <div class="col-lg-10">
                                                <input type="text" name="jabatan" placeholder="Jabatan" value="{{ $data->jabatan }}" class="form-control" required> 
                                                </div>
                                            </div>
											
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">NIK</label>

                                                <div class="col-lg-10">
                                                <input type="text" name="nik" placeholder="NIK" value="{{ $data->nik }}" class="form-control" required> 
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">No HP</label>

                                                <div class="col-lg-10">
                                                <input type="text" name="no_hp" placeholder="No HP" value="{{ $data->no_hp }}" class="form-control" required> 
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Jenis Kelamin</label>

                                                <div class="col-lg-10">
                                                <select name="jenis_kelamin" class="form-control select">
                                                    <option value="1">Laki-laki</option>
                                                    <option value="2">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Status</label>

                                                <div class="col-lg-10">
                                                <select name="status_aktif" class="form-control select">
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