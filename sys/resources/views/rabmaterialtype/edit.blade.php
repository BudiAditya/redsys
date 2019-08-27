@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Edit RAB Material Type</h4>

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
                                        Edit Data RAB Material Type
                                        <div class="float-right">
                                        </div>
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                        <!-- action="{{ route('rabmaterialtype.update', $rabmaterialtype->id) }}" method="post" -->
										<form class="form-horizontal" id="form_material_type">
										{{ csrf_field() }}
										{{ method_field('PUT') }}
                                            <input type="hidden" name="id_type" id="id_type" value="{{$rabmaterialtype->typerumah->id}}">
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Type</label>
                                                <div class="col-lg-8">
                                                    <select id="type_id" disabled="" name="type_id" placeholder="Type Rumah" class="form-control select2">
                                                        
                                                        @foreach($typerumahs as $typerumah)
                                                            @if($typerumah->id==$rabmaterialtype->typerumah->id)
                                                                <option value="{{$typerumah->id}}" selected="">{{$typerumah->type}}</option>
                                                            @else
                                                                <option value="{{$typerumah->id}}">{{$typerumah->type}}</option>
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
                                                        <th>Total Price</th>
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
                                            <br/>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Total Akumulasi</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" disabled id="total_akumulasi">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-offset-2 col-lg-8">
                                                    <button id="buttonSaveEdit" class="btn btn-sm btn-primary" type="button">Save</button>
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
                var id = $('#type_id').val();
                $.ajax({
                    url: '{{url("/rabmaterialtype")}}/'+id,
                    type: 'PUT',
                    data: $('#form_material_type').serializeArray(),

                    success: function(response){
                        if(response.success==0){
                            for(var key in response.errors){
                                $('#error-messages').html(response.errors[key][0]);
                            }
                        }else
                            window.location.href = '{{url("/rabmaterialtype")}}';
                    },
                    error: function(response_error){
                        console.log(response_error);
                    }
                });
            });

            var idx_out=0;

            function loadEdit(){
                var id = $('#type_id').val();
                $("#rab_table_type_edit").html('');
                $.ajax({
                    url: '{{url("/rabmaterialtype")}}/'+id+'/editing',
                    type: 'GET',
                    success: function(response){
                        console.log(response);
                        var html = "";
                        $.each(response.data,function(idx,value){
                            
                            html += "<tr>";
                            html += '<td><select name="rabmaterials['+idx_out+'][material_id]" style="width:100%;" class="form-control select2 change_material" id-dest="'+idx_out+'">';

                        @foreach($materials as $material)
                            if(value.material_id == {{$material->id}})
                                html += '<option value="{{$material->id}}" selected>{{$material->nama_brg}}</option>';
                            else
                                html += '<option value="{{$material->id}}">{{$material->nama_brg}}</option>';
                        @endforeach
                            html += '</select></td>'
                            
                            html += '<td><input type="text" name="rabmaterials['+idx_out+'][qty]" placeholder="Qty" class="form-control qty_change" id-dest="'+idx_out+'" value='+value.qty+' id="qty_'+idx_out+'"></td>';
                            html += '<td><input type="number" name="rabmaterials['+idx_out+'][price]" placeholder="Price" id="price_'+idx_out+'" class="form-control price_change" id-dest="'+idx_out+'" value='+value.price+' required></td>';
                            html += '<td><input type="number" placeholder="Total Price" class="form-control" id="total_price_'+idx_out+'" value='+(value.price*value.qty)+' disabled></td>';
                            html += '<td><button type="button" class="btn-delete-row">Delete</button></td>';
                            html += "</tr>";
                            idx_out++;
                        });
                        $('#rab_table_type_edit').append(html);
                        $('.select2').select2();
                        totalPrice();
                    },
                });
                
            }
            $(document).on('click','.btn-delete-row',function(){
                $(this).parent().parent().remove();
                totalPrice();
            });
            loadEdit();

            $('#btn_add_material').click(function(){
                $('#error-messages').html('');
                setNewRow();
                totalPrice();

            });
            $(document).on('change','.change_material',function(){
                var id_row = $(this).attr('id-dest');
                var id = $(this).val();
                $.ajax({
                    url: '{{url("/material")}}/'+id,
                    type: 'GET',

                    success: function(response){
                        $('#price_'+id_row).val(response.data.harga);
                        $('#total_price_'+id_row).val($('#qty_'+id_row).val()* response.data.harga);
                        totalPrice();
                    },
                    error: function(response_error){
                        console.log(response_error);
                    }
                });

            });
            function setNewRow(){
                
                var html = "";
                html += "<tr>";
                html += '<td><select name="rabmaterials['+idx_out+'][material_id]" style="width:100%;" class="form-control select2 change_material" id-dest="'+idx_out+'">';
            var nama = "Not Found";
            @if($materials->first()!=null)
                nama = '{{$materials->first()->harga}}';
            @endif
            
            @foreach($materials as $material)
                html += '<option value="{{$material->id}}">{{$material->nama_brg}}</option>';
            @endforeach
                html += '</select></td>'
                
                html += '<td><input type="text" name="rabmaterials['+idx_out+'][qty]" placeholder="Qty" class="form-control qty_change" id-dest="'+idx_out+'" id="qty_'+idx_out+'"></td>';
                html += '<td><input type="number" name="rabmaterials['+idx_out+'][price]" placeholder="Price" id="price_'+idx_out+'" value="'+nama+'" id-dest="'+idx_out+'" class="form-control price_change" required></td>';
                html += '<td><input type="number" placeholder="Total Price" class="form-control" id="total_price_'+idx_out+'" disabled></td>';
                html += '<td><button type="button" class="btn-delete-row">Delete</button></td>';
                html += "</tr>";
                idx_out++;
            ;
                $('#rab_table_type_edit').append(html);
                $('.select2').select2();
                totalPrice();
            }

            function totalPrice(){
                var totalAkumulasi = 0;
                $.each($('.qty_change'),function(idx,item){
                    var id_lokal = $(this).attr('id-dest');
                    
                    totalAkumulasi += (Number($(this).val())*Number($('#price_'+id_lokal).val()));
                });
                $('#total_akumulasi').val(totalAkumulasi);
            }
            $(document).on('input','.price_change',function(){
                var id_lokal = $(this).attr('id-dest');
                $('#total_price_'+id_lokal).val(Number($(this).val()) * Number($('#qty_'+id_lokal).val()));
                totalPrice();
            });
            $(document).on('input','.qty_change',function(){
                var id_lokal = $(this).attr('id-dest');
                $('#total_price_'+id_lokal).val(Number($(this).val()) * Number($('#price_'+id_lokal).val()));

                totalPrice();
            });
        });
    </script>
    @endsection