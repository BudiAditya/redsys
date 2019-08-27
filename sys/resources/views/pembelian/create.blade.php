@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Create Pembelian</h4>

                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">Create Pembelian</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                            <div class="col-md-12">


                                
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                        Create New Pembelian 
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                        <form id="form_pembelian_item" class="form-horizontal" action="{{ route('pembelianitem.store') }}" method="post">
										{{ csrf_field() }}
                                       
                                            <button type="button" id="btn_add_material">Add Item</button>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" width="100%" cellspacing="0">
                                                    <thead>
                                                        <th>Material</th>
                                                        <th>Supplier</th>
                                                        <th>Satuan</th>
                                                        <th>Qty</th>
                                                        <th>Price</th>
                                                        <th>Total Price</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody id="table_item_purchased">
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
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Total Bayar</label>

                                                <div class="col-lg-8">
                                                    <input type="number" id="total_bayar" name="" placeholder="Total Bayar" disabled class="form-control">
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Gudang</label>
                                                <div class="col-lg-8">
                                                    <select class="form-control" name="gudang_id">
                                                        @foreach($gudangs as $gudang)
                                                        <option value="{{$gudang->id}}">{{$gudang->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Jumlah Bayar</label>

                                                <div class="col-lg-8">
                                                    <input type="number" id="jum_bayar" name="jumlah_bayar" placeholder="Jumlah Bayar" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Sisa Bayar</label>

                                                <div class="col-lg-8">
                                                    <input type="number" id="sisa_bayar" placeholder="Sisa" class="form-control" disabled="">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <div class="col-lg-offset-2 col-lg-8">
                                                    <button id="btnSavePakai" class="btn btn-sm btn-primary" type="button">Save</button>
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
            $('#btnSavePakai').click(function(){
                $('#error-messages').html('');
                $.ajax({
                    url: '{{url("/pembelianitem")}}',
                    type: 'POST',
                    data: $('#form_pembelian_item').serializeArray(),

                    success: function(response){
                        if(response.success==0){
                            for(var key in response.errors){
                                $('#error-messages').html(response.errors[key][0]);
                            }
                        }else
                            window.location.href = '{{url("/pembelianitem")}}';
                    },
                    error: function(response_error){
                        console.log(response_error);
                    }
                });
            });

        	var idx_out=0;
            $('.js-example-basic-single').select2();
            $('.select2-gudang').select2();
            
            $(document).on('click','.btn-delete-row',function(){
                $(this).parent().parent().remove();
            });

            $('#btn_add_material').click(function(){
                $('#error-messages').html('');
                setNewRow();

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

            $(document).on('change','.selectmaterial',function(){
            	var id = $(this).val();
            	var id_dest = $(this).attr('id-dest');
            	console.log(id_dest);
            	$.ajax({
                    url: '{{url("/material")}}/'+id,
                    type: 'GET',
                    success: function(response){
                    	
                        console.log(response);
                        $('#price_'+id_dest).val(response.data.harga);
                        $('#satuan_'+id_dest).val(response.data.satuan);

                        if(response.data.supplier!=null)
                            $('#supplier_'+id_dest).val(response.data.supplier.nama);
                        else
                            $('#supplier_'+id_dest).val("Not Found");

                    },
                });
            });

            function setNewRow(){
                
                var html = "";
                html += "<tr>";
                html += '<td><select id-dest="'+idx_out+'" name="pembelians['+idx_out+'][material_id]" style="width:100%;" class="form-control select2 selectmaterial">';

                var nama = "Not Found";
                @if($materials->first()->supplier!=null)
                    nama = '{{$materials->first()->supplier->nama}}';
                @endif

            @foreach($materials as $material)
                html += '<option value="{{$material->id}}">{{$material->nama_brg}}</option>';
            @endforeach
                html += '</select></td>'
                
                html += '<td><input type="text" name="pembelians['+idx_out+'][supplier]" placeholder="Supplier" class="form-control" id="supplier_'+idx_out+'" value="'+nama+'" readonly></td>';

                html += '<td><input type="text" name="pembelians['+idx_out+'][satuan]" placeholder="Satuan" class="form-control" id="satuan_'+idx_out+'" value="{{$materials->first()->satuan}}" readonly></td>';

                html += '<td><input type="text" name="pembelians['+idx_out+'][qty]" placeholder="Qty" class="form-control qty_buy" id-dest="'+idx_out+'" id="qty_'+idx_out+'"></td>';

                html += '<td><input type="number" name="pembelians['+idx_out+'][price]" placeholder="Price" class="form-control price_buy" id="price_'+idx_out+'" value="{{$materials->first()->harga}}" readonly></td>';
                html += '<td><input type="number"  placeholder="Total Price" class="form-control price_total_buy" id="price_total_'+idx_out+'" value="-1 " readonly></td>';
                html += '<td><button type="button" class="btn-delete-row">Delete</button></td>';
                html += "</tr>";
                idx_out++;

                $('#table_item_purchased').append(html);
                $('.select2').select2();

            }

            $(document).on('change','.qty_buy',function(){
                var id_lokal = $(this).attr('id-dest');
                var lokal_total = (Number($(this).val()) * Number($('#price_'+id_lokal).val()));
                $('#price_total_'+id_lokal).val(lokal_total);

            	var total =0;
            	$.each($('.qty_buy'),function(index,item){
            		var id = $(this).attr('id-dest');
            		console.log(id);
            		total += (Number($(this).val()) * Number($('#price_'+id).val()));
            	});
            	$('#total_bayar').val(total);
            });

            $(document).on('input','#jum_bayar',function(){
            	var total =0;
            	$.each($('.qty_buy'),function(index,item){
            		var id = $(this).attr('id-dest');
            		console.log(id);
            		total += (Number($(this).val()) * Number($('#price_'+id).val()));
            	});
            	$('#sisa_bayar').val(Number($(this).val())-total);
            });



            
        });
    </script>
    @endsection