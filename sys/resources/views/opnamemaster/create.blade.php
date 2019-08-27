@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Create Opname Master</h4>

                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">Opname Master</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                            <div class="col-md-12">


                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                        Create New Opname Master
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                        <!-- action="{{ route('opnamemaster.store') }}" method="post" -->
                                        <form id="form_progress" class="form-horizontal" >
										{{ csrf_field() }}

                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Tanggal</label>
                                                <div class="col-lg-8">
                                                <input type="date" name="tanggal" placeholder="Tanggal" class="form-control" required> 
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Unit</label>
                                                <div class="col-lg-8">
                                                <select name="unit_id" id="unit_change" class="form-control select2">
                                                    <option value="" selected="" disabled="">--Pilih Salah Satu--</option>
                                                    @foreach($unitrumahs as $rumah)
                                                        <option value="{{$rumah->id}}">{{$rumah->proyek->nama}} - {{$rumah->id}}</option>
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" width="100%" cellspacing="0">
                                                    <thead>
                                                        <th>Pekerjaan</th>
                                                        <th>Persentase</th>
                                                        <th>Price</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody id="table_pekerjaan">
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
                                                    <button class="btn btn-sm btn-primary" type="button" id="btnSaveProgress">Save</button>
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
            $('#btnSaveProgress').click(function(){
                $('#error-messages').html('');
                $.ajax({
                    url: '{{url("/opnamemaster")}}',
                    type: 'POST',
                    data: $('#form_progress').serializeArray(),

                    success: function(response){
                        if(response.success==0){
                            for(var key in response.errors){
                                $('#error-messages').html(response.errors[key][0]);
                            }
                        }else
                            window.location.href = '{{url("/opnamemaster")}}';
                    },
                    error: function(response_error){
                        console.log(response_error);
                    }
                });
            });


            $('#unit_change').change(function(){
                $('#error-messages').html('');
                var id= $(this).val();
                $("#table_pekerjaan").html('');
                $.ajax({
                    url: '{{url("/opnamemaster")}}/'+id,
                    type: 'GET',
                    success: function(response){
                        console.log(response);
                        var html = "";
                        
                        $.each(response.data,function(idx,value){
                            
                            html += "<tr>";
                            html += '<td><select name="rabopnames['+idx_out+'][pekerjaan_id]" style="width:100%;" class="form-control select2">';

                        @foreach($pekerjaans as $pekerjaan)
                            if(value.pekerjaan_id == {{$pekerjaan->id}})
                                html += '<option value="{{$pekerjaan->id}}" selected>{{$pekerjaan->pekerjaan}}</option>';
                            else
                                html += '<option value="{{$pekerjaan->id}}">{{$pekerjaan->pekerjaan}}</option>';
                        @endforeach
                            html += '</select></td>'
                            
                            html += '<td><input type="text" name="rabopnames['+idx_out+'][persentase]" placeholder="Persentase" class="form-control"></td>';
                            html += '<td><input type="text" name="rabopnames['+idx_out+'][price]" placeholder="Price" class="form-control" value='+value.price+'></td>';
                            html += '<td><button type="button" class="btn-delete-row">Delete</button></td>';
                            html += "</tr>";
                            idx_out++;
                        });
                        $('#table_pekerjaan').append(html);
                        $('.select2').select2();
                    },
                });
            })
            $(document).on('click','.btn-delete-row',function(){
                $(this).parent().parent().remove();
            });
        });
    </script>
    @endsection