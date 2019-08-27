@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Edit RAB Pekerjaan Unit</h4>

                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">RAB Pekerjaan Unit</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                            <div class="col-md-12">


                                
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                        Edit Data RAB Pekerjaan Unit
                                        <div class="float-right">
                                        </div>
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                        <!-- action="{{ route('rabpekerjaanunit.update', $rabpekerjaanunit->unitrumah->id) }}" method="post" -->
										<form id="form_rab_kerja_unit" class="form-horizontal" >
										{{ csrf_field() }}
										{{ method_field('PUT') }}
                                            <input type="hidden" name="unit_id" id="unit_id" value="{{$rabpekerjaanunit->unitrumah->id}}">
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Unit</label>
                                                <div class="col-lg-8">
                                                <!-- <input type="number" value="{{$rabpekerjaanunit->unit_id}}" name="unit_id" placeholder="Unit" class="form-control" required>  -->
                                                <select name="unit_id" style="width: 100%;" id="unit_change" class="form-control select2" disabled="">
                                                    <option value="" selected="" disabled="">--Pilih Salah Satu--</option>
                                                    @foreach($unitrumahs as $rumah)
                                                        @if($rumah->id == $rabpekerjaanunit->unitrumah->id)
                                                            @if($rumah->proyek!=null)
                                                                <option value="{{$rumah->id}}" selected="">{{$rumah->proyek->nama}} - {{$rumah->id}}</option>
                                                            @else
                                                                <option value="{{$rumah->id}}" selected=""> - {{$rumah->id}}</option>
                                                            @endif
                                                        @else
                                                            @if($rumah->proyek!=null)
                                                                <option value="{{$rumah->id}}">{{$rumah->proyek->nama}} - {{$rumah->id}}</option>
                                                            @else
                                                                <option value="{{$rumah->id}}"> - {{$rumah->id}}</option>
                                                            @endif
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
                                                        <!-- <th>Qty</th> -->
                                                        <th>Price</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody id="rab_table_unit_edit">
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
                                                    <button class="btn btn-sm btn-primary" type="button" id="btnSaveEditPekerjaUnit">Save</button>
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
             $('#btnSaveEditPekerjaUnit').click(function(){
                $('#error-messages').html('');
                var id =$('#unit_id').val();
                $.ajax({
                    url: '{{url("/rabpekerjaanunit")}}/'+id,
                    type: 'PUT',
                    data: $('#form_rab_kerja_unit').serializeArray(),

                    success: function(response){
                        if(response.success==0){
                            for(var key in response.errors){
                                $('#error-messages').html(response.errors[key][0]);
                            }
                        }else
                            window.location.href = '{{url("/rabpekerjaanunit")}}';
                    },
                    error: function(response_error){
                        console.log(response_error);
                    }
                });
            });
            var idx_out=0;

            function loadEdit(){
                var id = $('#unit_change').val();
                console.log(id);
                $("#rab_table_unit_edit").html('');
                $.ajax({
                    url: '{{url("/rabpekerjaanunit")}}/'+id+'/editing',
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
                            
                            // html += '<td><input type="text" name="rabpekerjaans['+idx_out+'][qty]" placeholder="Qty" class="form-control" value='+value.qty+'></td>';
                            html += '<td><input type="number" name="rabpekerjaans['+idx_out+'][price]" placeholder="Price" class="form-control" value='+value.price+' required></td>';
                            html += '<td><button type="button" class="btn-delete-row">Delete</button></td>';
                            html += "</tr>";
                            idx_out++;
                        });
                        $('#rab_table_unit_edit').append(html);
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
                
                // html += '<td><input type="text" name="rabpekerjaans['+idx_out+'][qty]" placeholder="Qty" class="form-control"></td>';
                html += '<td><input type="number" name="rabpekerjaans['+idx_out+'][price]" placeholder="Price" class="form-control" required></td>';
                html += '<td><button type="button" class="btn-delete-row">Delete</button></td>';
                html += "</tr>";
                idx_out++;
            ;
                $('#rab_table_unit_edit').append(html);
                $('.select2').select2();
            }
        });
    </script>
    @endsection