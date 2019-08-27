@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Create RAB Pekerjaan Type</h4>

                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">RAB Pekerjaan Type</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                            <div class="col-md-12">


                                
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                        Create New RAB Pekerjaan Type
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                        <form class="form-horizontal" action="{{ route('rabpekerjaantype.store') }}" method="post">
										{{ csrf_field() }}
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Type</label>
                                                <div class="col-lg-8">
                                                <!-- <input type="number" name="type_id" placeholder="Type" class="form-control" required>  -->
                                                <select id="type_id" name="type_id" class="form-control select2">
                                                    <option value="" selected="" disabled="">--Pilih Salah Satu--</option>
                                                    @foreach($typerumahs as $typerumah)
                                                        <option value="{{$typerumah->id}}">{{$typerumah->type}}</option>
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Pekerjaan</label>
                                                <div class="col-lg-8">
                                                <!-- <input type="number" name="pekerjaan_id" placeholder="Pekerjaan" class="form-control" required>  -->
                                                <select id="pekerjaan_id" name="pekerjaan_id"  class="form-control select2">
                                                    <option value="" selected="" disabled="">--Pilih Salah Satu--</option>
                                                    
                                                </select>

                                                </div>
                                            </div>
                                            
                                            <!-- <div class="form-group row"><label class="col-lg-2 form-control-label">Qty</label>

                                                <div class="col-lg-8">
												<input type="text" name="qty" placeholder="Qty" class="form-control"> 
                                                </div>
                                            </div> -->
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Price</label>
                                                <div class="col-lg-8">
                                                <input type="number" name="price" placeholder="Price" class="form-control" required> 
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
            $('.select2').select2();
            $('#type_id').change(function(){
                var id= $(this).val();
                var options= [];
                $.ajax({
                    url: '{{url("/getrabpekerjaantype")}}/'+id,
                    type: 'GET',
                    success: function(response){
                        $.each($.parseJSON(response), function (key, val) { 
                            options.push({
                                text: val.pekerjaan,
                                id: val.id
                            });
                            console.log(options);
                        });
                        $('#pekerjaan_id').empty().select2({
                            data:options
                        })
                    },
                });
            });
        });
    </script>
    @endsection