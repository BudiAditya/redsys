@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Create RAB Material Type</h4>

                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">RAB Material Type</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                            <div class="col-md-12">


                                
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                        Create New RAB Material Type
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                        <form class="form-horizontal" action="{{ route('rabmaterialtype.store') }}" method="post">
										{{ csrf_field() }}
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Type</label>
                                                <div class="col-lg-8">
                                                <select id="type_id" name="type_id" placeholder="Type Rumah" class="form-control js-example-basic-single">
                                                    <option value=""  selected="">--Pilih Salah Satu--</option>
                                                    @foreach($typerumahs as $typerumah)
                                                        <option value="{{$typerumah->id}}">{{$typerumah->type}}</option>
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Material</label>
                                                <div class="col-lg-8">
                                                <select id="material_id" name="material_id" placeholder="Material" class="form-control js-example-basic-single">
                                                    <option value="" disabled="" selected="">--Pilih Salah Satu--</option>
                                                    
                                                </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Qty</label>

                                                <div class="col-lg-8">
												<input type="text" name="qty" placeholder="Qty" class="form-control"> 
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Price</label>
                                                <div class="col-lg-8">
                                                <input id="price_material" type="number" name="price" placeholder="Price" class="form-control" required> 
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
            $('#type_id').change(function(){
                var id= $(this).val();
                var options= [];
                $.ajax({
                    url: '{{url("/getrabmaterialtype")}}/'+id,
                    type: 'GET',
                    success: function(response){
                        console.log(response);
                        $.each($.parseJSON(response), function (key, val) { 
                            options.push({
                                text: val.nama_brg,
                                id: val.id
                            });
                            console.log(options);
                        });
                        $('#material_id').empty().select2({
                            data:options
                        })

                        var id_mat = $('#material_id').val();
                        $.ajax({
                            url: '{{url("/material")}}/'+id_mat,
                            type: 'GET',
                            success: function(response){
                                $('#price_material').val(response.data.harga);
                            },
                        });
                    },
                });
            });

            $('#material_id').change(function(){
                var id= $(this).val();
                var options= [];
                $.ajax({
                    url: '{{url("/material")}}/'+id,
                    type: 'GET',
                    success: function(response){
                        console.log(response);
                        $('#price_material').val(response.data.harga);
                    },
                });
            });

            
        });
    </script>
    @endsection