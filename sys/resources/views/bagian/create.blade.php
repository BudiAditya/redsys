@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Create Bagian</h4>

                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">Bagian</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                            <div class="col-md-12">
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                        Create New Bagian
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                        <form class="form-horizontal" action="{{ route('bagian.store') }}" method="post">
										{{ csrf_field() }}
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Nama</label>

                                                <div class="col-lg-8">
												<input type="text" name="nama" placeholder="Nama" class="form-control" required> 
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Keterangan</label>

                                                <div class="col-lg-8">
                                                    <input type="text" name="keterangan" class="form-control"/>
												<!-- <textarea class="form-control" name="keterangan" id="" cols="30" rows="10"></textarea> -->
                                                </div>
                                            </div>
                                            

                                                
                                            <div class="form-group row">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-sm btn-primary" type="submit">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <div class="table-responsive">
                                              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                  <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Keterangan</th>
                                                    <th>Action</th>
                                                  </tr>
                                                </thead>
                                                <tfoot>
                                                  <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Keterangan</th>
                                                    <th>Action</th>
                                                  </tr>
                                                </tfoot>
                                                <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                    @foreach($bagians as $items)
                                                   <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $items->nama }}</td>
                                                    <td>{{ $items->keterangan }}</td>
                                                    <td>
                                                    <form action="{{ route('bagian.destroy', $items->id) }}" method="post">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <!--<a href="{{ route('level.show',$items->id) }}">Lihat</a>-->
                                                        <a class="btn btn-sm btn-success" type="submit" href="{{ route('bagian.edit',$items->id) }}">Edit</a>
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