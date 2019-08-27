@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Informasi RAB Material Type. {{$type->type}}</h4>

                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">Informasi RAB Material Type. {{$type->type}}</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                            <div class="col-md-12">


                                
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                        Informasi RAB Material Type. {{$type->type}}
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" width="100%" cellspacing="0">
                                                <thead>
                                                    <th>Material</th>
                                                    <th>Qty</th>
                                                    <th>Price</th>
                                                    <th>Total Price</th>
                                                </thead>
                                                <tbody id="table_item_purchased">
                                                    @foreach($type->rabmaterialtypes as $rabmaterialtype)
                                                    <tr>
                                                        <td>{{$rabmaterialtype->material->nama_brg}}</td>
                                                        <td>{{$rabmaterialtype->qty}}</td>
                                                        <td>{{$rabmaterialtype->price}}</td>
                                                        <td>{{$rabmaterialtype->qty * $rabmaterialtype->price}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <span id="error-messages" style="color:red;"></span>
                                        </div>
                                        
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach($type->rabmaterialtypes as $rabmaterialtype)
                                            @php
                                                $total += $rabmaterialtype->qty * $rabmaterialtype->price;
                                            @endphp
                                        @endforeach

                                        <div>Total Biaya:  Rp. {{ number_format($total, 2, ',', '.')}}</div>
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