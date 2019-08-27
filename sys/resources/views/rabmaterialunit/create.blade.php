@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Create RAB Material Unit</h4>

                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">RAB Material Unit</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                            <div class="col-md-12">


                                
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                        Create New RAB Material Unit
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                        <!-- action="{{ route('rabmaterialunit.store') }}" method="post" -->
                                        <form id="form_new_rab" class="form-horizontal" >
										{{ csrf_field() }}
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Pilih Unit</label>
                                                <div class="col-lg-8">
                                                <select name="unit_id" id="unit_change" class="form-control select2">
                                                    <option value="" selected="" disabled="">--Pilih Salah Satu--</option>
                                                        @foreach($unitrumahs as $rumah)
                                                            @if($rumah->proyek!=null)
                                                                <option value="{{$rumah->id}}">{{$rumah->proyek->nama}} -  {{$rumah->alamat}} - {{$rumah->typerumah->type}}</option>
                                                            @else
                                                                <option value="{{$rumah->id}}">{{$rumah->alamat}} - {{$rumah->typerumah->type}}</option>
                                                            @endif
                                                        @endforeach
                                                </select>
                                                </div>
                                            </div>
                                            <button type="button" id="btn_add_material">Add Material</button>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" width="100%" cellspacing="0">
                                                    <thead>
                                                        <th>Material</th>
                                                        <th>Qty</th>
                                                        <th>Price</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody id="rab_table_unit">
                                                        <!-- <tr>
                                                            <th>Material</th>
                                                            <th>Qty</th>
                                                            <th>Price</th>
                                                            <th>Action</th>
                                                        </tr> -->
                                                    </tbody>
                                                </table>
                                                <span id="error-messages" style="color:red;"></span>
                                            </div>
                                                
                                            <div class="form-group row">
                                                <div class="col-lg-offset-2 col-lg-8">
                                                    <button id="btnSaveMaterialUnit" class="btn btn-sm btn-primary" type="button">Save</button>
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
            var idx_out=0;
            $('#btnSaveMaterialUnit').click(function(){
                $('#error-messages').html('');
                $.ajax({
                    url: '{{url("/rabmaterialunit")}}',
                    type: 'POST',
                    data: $('#form_new_rab').serializeArray(),

                    success: function(response){
                        if(response.success==0){
                            for(var key in response.errors){
                                $('#error-messages').html(response.errors[key][0]);
                            }
                        }else
                            window.location.href = '{{url("/rabmaterialunit")}}';
                    },
                    error: function(response_error){
                        console.log(response_error);
                    }
                });
            });


            $('#unit_change').change(function(){
                $('#error-messages').html('');
                var id= $(this).val();
                $("#rab_table_unit").html('');
                $.ajax({
                    url: '{{url("/rabmaterialunit")}}/'+id,
                    type: 'GET',
                    success: function(response){
                        console.log(response);
                        var html = "";
                        
                        $.each(response.data,function(idx,value){
                            
                            html += "<tr>";
                            html += '<td><select name="rabmaterials['+idx_out+'][material_id]" style="width:100%;" class="form-control select2">';

                        @foreach($materials as $material)
                            if(value.material_id == {{$material->id}})
                                html += '<option value="{{$material->id}}" selected>{{$material->nama_brg}}</option>';
                            else
                                html += '<option value="{{$material->id}}">{{$material->nama_brg}}</option>';
                        @endforeach
                            html += '</select></td>'
                            
                            html += '<td><input type="text" name="rabmaterials['+idx_out+'][qty]" placeholder="Qty" class="form-control" value='+value.qty+'></td>';
                            html += '<td><input type="number" name="rabmaterials['+idx_out+'][price]" placeholder="Price" class="form-control" value='+value.price+' required></td>';
                            html += '<td><button type="button" class="btn-delete-row">Delete</button></td>';
                            html += "</tr>";
                            idx_out++;
                        });
                        $('#rab_table_unit').append(html);
                        $('.select2').select2();
                    },
                });
            })
            $(document).on('click','.btn-delete-row',function(){
                $(this).parent().parent().remove();
            });

            $('#btn_add_material').click(function(){
                $('#error-messages').html('');
                setNewRow();

            });
            function setNewRow(){
                
                var html = "";
                html += "<tr>";
                html += '<td><select name="rabmaterials['+idx_out+'][material_id]" style="width:100%;" class="form-control select2">';

            @foreach($materials as $material)
                html += '<option value="{{$material->id}}">{{$material->nama_brg}}</option>';
            @endforeach
                html += '</select></td>'
                
                html += '<td><input type="text" name="rabmaterials['+idx_out+'][qty]" placeholder="Qty" class="form-control"></td>';
                html += '<td><input type="number" name="rabmaterials['+idx_out+'][price]" placeholder="Price" class="form-control" required></td>';
                html += '<td><button type="button" class="btn-delete-row">Delete</button></td>';
                html += "</tr>";
                idx_out++;
            ;
                $('#rab_table_unit').append(html);
                $('.select2').select2();
            }
        });
    </script>
    @endsection