@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Edit RAB Pekerjaan Type</h4>

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
                                        Edit Data RAB Pekerjaan Type
                                        <div class="float-right">
                                        </div>
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                        <!-- action="{{ route('rabpekerjaantype.update', $rabpekerjaantype->id) }}" method="post" -->
										<form class="form-horizontal" id="form_pekerjaan_type" >
										{{ csrf_field() }}
										{{ method_field('PUT') }}
                                            <input type="hidden" name="id_type" id="id_type" value="{{$rabpekerjaantype->typerumah->id}}">
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Type</label>
                                                <div class="col-lg-8">
                                                <select id="type_id" disabled name="type_id" class="form-control select2">
                                                    <option value="" selected="" disabled="">--Pilih Salah Satu--</option>
                                                    @foreach($typerumahs as $typerumah)
                                                        @if($rabpekerjaantype->typerumah->id==$typerumah->id)
                                                            <option value="{{$typerumah->id}}" selected="">{{$typerumah->type}}</option>
                                                        @else
                                                            <option value="{{$typerumah->id}}">{{$typerumah->type}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div>
                                            <button type="button" id="btn_add_pekerjaan">Add Pekerjaan</button>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" width="100%" cellspacing="0">
                                                    <thead>
                                                        <th>Pekerjaan</th>
                                                        <th>Price</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody id="rab_table_type_edit">
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
                                                    <button class="btn btn-sm btn-primary" type="button" id="buttonSaveEdit">Save</button>
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

            $('#buttonSaveEdit').click(function(){
                $('#error-messages').html('');
                var id = $('#id_type').val();
                $.ajax({
                    url: '{{url("/rabpekerjaantype")}}/'+id,
                    type: 'PUT',
                    data: $('#form_pekerjaan_type').serializeArray(),

                    success: function(response){
                        if(response.success==0){
                            for(var key in response.errors){
                                $('#error-messages').html(response.errors[key][0]);
                            }
                        }else
                            window.location.href = '{{url("/rabpekerjaantype")}}';
                    },
                    error: function(response_error){
                        console.log(response_error);
                    }
                });
            });

            var idx_out=0;

            function loadEdit(){
                var id = $('#id_type').val();
                $("#rab_table_type_edit").html('');
                $.ajax({
                    url: '{{url("/rabpekerjaantype")}}/'+id+'/editing',
                    type: 'GET',
                    success: function(response){
                        console.log(response);
                        var html = "";
                        $.each(response.data,function(idx,value){
                            
                            html += "<tr>";
                            html += '<td><select name="rabpekerjaans['+idx_out+'][pekerjaan_id]" style="width:100%;" class="form-control select2">';

                        @foreach($pekerjaans as $pekerjaan)
                            if(value.pekerjaan_id == {{$pekerjaan->id}})
                                html += '<option value="{{$pekerjaan->id}}" selected>{{$pekerjaan->pekerjaan}}</option>';
                            else
                                html += '<option value="{{$pekerjaan->id}}">{{$pekerjaan->pekerjaan}}</option>';
                        @endforeach
                            html += '</select></td>'
                            
                            html += '<td><input type="number" name="rabpekerjaans['+idx_out+'][price]" placeholder="Price" class="form-control" value='+value.price+' required></td>';
                            html += '<td><button type="button" class="btn-delete-row">Delete</button></td>';
                            html += "</tr>";
                            idx_out++;
                        });
                        $('#rab_table_type_edit').append(html);
                        $('.select2').select2();
                    },
                });
                
            }
            $(document).on('click','.btn-delete-row',function(){
                $(this).parent().parent().remove();
            });
            loadEdit();

            $('#btn_add_pekerjaan').click(function(){
                $('#error-messages').html('');
                setNewRow();

            });
            function setNewRow(){
                
                var html = "";
                html += "<tr>";
                html += '<td><select name="rabpekerjaans['+idx_out+'][pekerjaan_id]" style="width:100%;" class="form-control select2">';

            @foreach($pekerjaans as $pekerjaan)
                html += '<option value="{{$pekerjaan->id}}">{{$pekerjaan->pekerjaan}}</option>';
            @endforeach
                html += '</select></td>'
                
                html += '<td><input type="number" name="rabpekerjaans['+idx_out+'][price]" placeholder="Price" class="form-control" required></td>';
                html += '<td><button type="button" class="btn-delete-row">Delete</button></td>';
                html += "</tr>";
                idx_out++;
            ;
                $('#rab_table_type_edit').append(html);
                $('.select2').select2();
            }
        });
    </script>
    @endsection