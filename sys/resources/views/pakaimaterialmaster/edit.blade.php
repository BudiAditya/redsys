@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Edit Pakai Material Master</h4>

                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">Pakai Material Master</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                            <div class="col-md-12">

                                    <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                        Edit Data Pakai Material Master
                                        <div class="float-right">
                                        </div>
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                        <!-- action="{{ route('pakaimaterialmaster.update', $pakaimaterialmaster->unitrumah->id) }}" method="post" -->
										<form id="form_pakai_edit" class="form-horizontal" >
										{{ csrf_field() }}
										{{ method_field('PUT') }}
                                            <input type="hidden" id="id_unit" name="id_unit" value="{{$pakaimaterialmaster->unitrumah->id}}">
                                            

                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Unit</label>
                                                <div class="col-lg-8">
                                                <select name="unit_id" id="unit_change" readonly class="form-control select2">
                                                    <option value="" selected="" disabled="">--Pilih Salah Satu--</option>
                                                    @foreach($unitrumahs as $rumah)
                                                        @if($rumah->id == $pakaimaterialmaster->unitrumah->id)
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
                                            <!-- <div class="form-group row"><label class="col-lg-2 form-control-label">Unit</label>
                                                <div class="col-lg-8">
                                                <input type="number" value="{{$pakaimaterialmaster->unit_id}}" name="unit_id" placeholder="Unit" class="form-control" required> 
                                                </div>
                                            </div> -->
                                            <div class="table-responsive">
                                                <table class="table table-bordered" width="100%" cellspacing="0">
                                                    <thead>
                                                        <th>Tanggal</th>
                                                        <th>Material</th>
                                                        <th>Qty</th>
                                                        <th>Price</th>
                                                        <th>Total Price</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody id="table_material_pakai">
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
            // $('.select2').select2();
            $('#buttonSaveEdit').click(function(){
                $('#error-messages').html('');
                var id = $('#id_unit').val();
                $.ajax({
                    url: '{{url("/pakaimaterialmaster")}}/'+id,
                    type: 'PUT',
                    data: $('#form_pakai_edit').serializeArray(),

                    success: function(response){
                        if(response.success==0){
                            for(var key in response.errors){
                                if(key.includes('sisa_stok')){
                                    $('#error-messages').html(response.errors[key]);
                                }else
                                    $('#error-messages').html(response.errors[key][0]);
                            }
                        }else
                            window.location.href = '{{url("/pakaimaterialmaster")}}';
                    },
                    error: function(response_error){
                        console.log(response_error);
                    }
                });
            });

            var idx_out=0;

            function loadEdit(){
                var id = $('#unit_change').val();
                $("#table_material_pakai").html('');
                $.ajax({
                    url: '{{url("/pakaimaterialmaster")}}/'+id+'/editing',
                    type: 'GET',
                    success: function(response){
                        console.log(response);
                        var html = "";
                        $.each(response.data,function(idx,value){
                            
                            html += "<tr>";
                            html += '<td><input type="date" name="rabpakaimaterials['+idx_out+'][tanggal]" placeholder="Tanggal" class="form-control" value='+value.tgl_pakai+'></td>';
                            html += '<td><select name="rabpakaimaterials['+idx_out+'][material_id]" style="width:100%;" id-dest="'+idx_out+'" class="form-control select2-table change_material">';

                        @foreach($materials as $material)
                            if(value.material_id == {{$material->id}})
                                html += '<option value="{{$material->id}}" selected>{{$material->nama_brg}}</option>';
                            else
                                html += '<option value="{{$material->id}}">{{$material->nama_brg}}</option>';
                        @endforeach
                            html += '</select></td>'
                            
                            html += '<td><input type="text" name="rabpakaimaterials['+idx_out+'][qty]" placeholder="Qty" id-dest="'+idx_out+'" id="qty_'+idx_out+'" class="form-control qty" value='+value.qty+'></td>';

                            html += '<td><input type="text" name="rabpakaimaterials['+idx_out+'][price]" placeholder="Price" id-dest="'+idx_out+'" id="price_'+idx_out+'"  readonly class="form-control price" value='+value.price+'></td>';

                            html += '<td><input type="text" disabled placeholder="Total Price" id-dest="'+idx_out+'" class="form-control total_price" id="total_price_'+idx_out+'" value="'+(value.qty*value.price)+'"></td>';

                            html += '<td><button type="button" class="btn-delete-row">Delete</button></td>';
                            html += "</tr>";
                            idx_out++;
                        });
                        $('#table_material_pakai').append(html);
                        $('.select2-table').select2();
                        totalPrice();
                    },
                });
            }
            $(document).on('click','.btn-delete-row',function(){
                $(this).parent().parent().remove();
                totalPrice();
            });
            loadEdit();

            function totalPrice(){
                var totalAkumulasi = 0;
                $.each($('.qty'),function(idx,item){
                    var id_lokal = $(this).attr('id-dest');
                    
                    totalAkumulasi += (Number($(this).val())*Number($('#price_'+id_lokal).val()));
                    $('#total_price_'+id_lokal).val((Number($(this).val())*Number($('#price_'+id_lokal).val())));
                });
                $('#total_akumulasi').val(totalAkumulasi);
            }

            $(document).on('input','.price',function(){
                var id_lokal = $(this).attr('id-dest');
                $('#total_price_'+id_lokal).val(Number($(this).val()) * Number($('#qty_'+id_lokal).val()));
                totalPrice();
            });

            $(document).on('input','.qty',function(){
                var id_lokal = $(this).attr('id-dest');
                $('#total_price_'+id_lokal).val(Number($(this).val()) * Number($('#price_'+id_lokal).val()));

                totalPrice();
            });


            $(document).on('change','.change_material',function(){
                var id_row = $(this).attr('id-dest');
                var id = $(this).val();
                $.ajax({
                    url: '{{url("/material")}}/'+id,
                    type: 'GET',

                    success: function(response){
                        console.log(response);  
                        $('#price_'+id_row).val(response.data.harga);
                        $('#total_price_'+id_row).val($('#qty_'+id_row).val()* response.data.harga);
                        totalPrice();
                        
                    },
                    error: function(response_error){
                        console.log(response_error);
                    }
                });
            });
        });
    </script>
    @endsection