@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Create Material</h4>

                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">Material</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                            <div class="col-md-12">

                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                        Create New Material
                                    </div>
                                    <div class="panel-body  p-xl-3">
                                        <form class="form-horizontal" action="{{ route('material.store') }}" method="post" enctype="multipart/form-data">
										{{ csrf_field() }}
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Kode</label>
                                              <div class="col-lg-8">
                                                <input type="text" name="kode" placeholder="Kode" class="form-control" required> 
                                              </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Kategori</label>
                                              <div class="col-lg-8">
                                                <select name="kategori_id" id="" class="form-control js-example-basic-single">
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach($kategorimaterials as $kategorimaterial)
                                                    <option value="{{$kategorimaterial->id}}">{{$kategorimaterial->kategori}}</option>
                                                @endforeach
                                                </select>
                                              </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Supplier</label>
                                              <div class="col-lg-8">
                                                <select name="supplier_id" id="" class="form-control js-example-basic-single">
                                                <option value="">-- Pilih Supplier --</option>
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{$supplier->id}}">{{$supplier->nama}}</option>
                                                @endforeach
                                                </select>
                                              </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Nama Barang</label>
                                              <div class="col-lg-8">
                                                <input type="text" name="nama_brg" placeholder="Nama Barang" class="form-control" required> 
                                              </div>
                                            </div>
                                            <!-- <div class="form-group row"><label class="col-lg-2 form-control-label">Ukuran</label>
                                              <div class="col-lg-8">
                                                <input type="text" name="ukuran" placeholder="Ukuran" class="form-control" required> 
                                              </div>
                                            </div> -->
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Satuan</label>
                                              <div class="col-lg-8">
                                                <input type="text" name="satuan" placeholder="Satuan" class="form-control" required> 
                                              </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Harga</label>
                                              <div class="col-lg-8">
                                                <input type="text" name="harga" placeholder="Harga" class="form-control" required> 
                                              </div>
                                            </div>                                            
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Keterangan</label>
                                              <div class="col-lg-8">
                                                <input type="text" name="keterangan" class="form-control" value="" />
                        												<!-- <textarea class="form-control" name="keterangan" id="" cols="30" rows="10"></textarea> -->
                                              </div>
                                            </div>
                                            <!-- <div class="form-group row"><label class="col-lg-2 form-control-label">Stock</label>
                                              <div class="col-lg-8">
                                                <select name="is_stock" id="" class="form-control">
                                                <option value="">--Status Stock--</option>
                                                <option value="0">Tidak Tersedia</option>
                                                <option value="1">Tersedia</option>
                                                </select>
                                              </div>
                                            </div> -->
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">File Gambar</label>
                                              <div class="col-lg-8">
                                                <input type="file" name="image">
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
            
        });
    </script>
    @endsection