@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Informasi Pembelian No. {{$transaksi->id}}</h4>

                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">Informasi Pembelian No. {{$transaksi->id}}</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                            <div class="col-md-12">


                                
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                        Informasi Pembelian No. {{$transaksi->id}}, Tanggal: {{date('d-m-Y',strtotime($transaksi->created_at))}}
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" width="100%" cellspacing="0">
                                                <thead>
                                                    <th>Material</th>
                                                    <th>Supplier</th>
                                                    <th>Satuan</th>
                                                    <th>Qty</th>
                                                    <th>Price</th>
                                                    <th>Total Price</th>
                                                </thead>
                                                <tbody id="table_item_purchased">
                                                    @foreach($transaksi->items as $item)
                                                    <tr>
                                                    	<td>{{$item->material->nama_brg}}</td>
                                                    	@if($item->supplier!=null)
                                                    		<td>{{$item->supplier->nama}}</td>
                                                    	@else
                                                    		<td>-</td>
                                                    	@endif
                                                    	<td>{{$item->material->satuan}}</td>
                                                    	<td>{{$item->qty}}</td>
                                                    	<td>{{$item->harga}}</td>
                                                    	<td>{{$item->qty * $item->harga}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <span id="error-messages" style="color:red;"></span>
                                        </div>
                                        
                                        @php
                                        	$total = 0;
                                        @endphp
                                        @foreach($transaksi->items as $item)
                                        	@php
                                        		$total += $item->qty * $item->harga;
                                        	@endphp
                                        @endforeach

                                        <div>Jumlah Bayar:  Rp. {{ number_format($transaksi->jumlah_bayar, 2, ',', '.') }}</div>
                                        <div>Total Bayar:  Rp. {{ number_format($total, 2, ',', '.')}}</div>
                                        <div>Sisa: Rp. {{ number_format(($transaksi->jumlah_bayar - $total), 2, ',', '.')}}</div>
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
    
    @endsection