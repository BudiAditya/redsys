@extends('layouts.adm') 
@section('content')
<!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Edit Unit Rumah</h4>

                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">Unit Rumah</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                            <div class="col-md-12">


                                
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                        Edit Data Unit Rumah
                                        <div class="float-right">
                                        </div>
                                    </div>
                                    <div class="panel-body  p-xl-3">
										<form class="form-horizontal" action="{{ route('unitrumah.update', $unitrumah->id) }}" method="post">
										{{ csrf_field() }}
										{{ method_field('PUT') }}
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Type Rumah</label>
                                                <div class="col-lg-8">
                                                <select name="type" required placeholder="Type Rumah" id="cbo_type" class="form-control js-example-basic-single">
                                                    @foreach($typerumahs as $typerumah)
                                                        @if($typerumah->id == $unitrumah->typerumah->id)
                                                            <option value="{{$typerumah->id}}" selected="">{{$typerumah->type}}</option>
                                                        @else
                                                            <option value="{{$typerumah->id}}">{{$typerumah->type}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Alamat</label>

                                                <div class="col-lg-8">
                                                    <input type="text" name="alamat" required="" class="form-control" value="{{$unitrumah->alamat}}">
                                                <!-- <textarea class="form-control" required="" name="alamat" id="" cols="30" rows="10"></textarea> -->
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Status Pembelian</label>
                                              <div class="col-lg-8">
                                                <select name="status_beli" id="" class="form-control js-example-basic-single">
                                                <option value="">--Status Pekerja--</option>
                                                @if($unitrumah->status_beli==1)
                                                    <option value="1" selected>Akad Fix</option>
                                                    <option value="2">Booking</option>
                                                @else
                                                    <option value="1">Akad Fix</option>
                                                    <option value="2" selected>Booking</option>
                                                @endif
                                                </select>
                                              </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Status Pekerjaan</label>

                                                <div class="col-lg-8">
                                                <select name="status_pekerjaan" placeholder="Status Pekerjaan" class="form-control js-example-basic-single">
                                                    @if($unitrumah->status_pekerjaan==0)
                                                        <option value="0" selected="">Standar</option>
                                                        <option value="1">Perluasan/Penambahan</option>
                                                    @else
                                                        <option value="0" >Standar</option>
                                                        <option value="1" selected="">Perluasan/Penambahan</option>
                                                    @endif
                                                </select> 
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Status Progress</label>

                                                <div class="col-lg-8">
                                                <select name="status_progress" placeholder="Status Progress" class="form-control js-example-basic-single">
                                                    @if($unitrumah->status_progress==0)
                                                        <option value="0" selected="">Progress</option>
                                                        <option value="1">Selesai</option>
                                                    @else
                                                        <option value="0">Progress</option>
                                                        <option value="1" selected>Selesai</option>
                                                    @endif
                                                </select>  
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Proyek</label>
                                                <div class="col-lg-8">
                                                    <select name="proyek_id" placeholder="Proyek" class="form-control js-example-basic-single">
                                                        @foreach($proyeks as $proyek)
                                                            @if($unitrumah->proyek!=null)
                                                                @if($proyek->id == $unitrumah->proyek->id)
                                                                    <option value="{{$proyek->id}}" selected="">{{$proyek->nama}}</option>
                                                                @else
                                                                    <option value="{{$proyek->id}}" >{{$proyek->nama}}</option>
                                                                @endif
                                                            @else
                                                                <option value="{{$proyek->id}}" >{{$proyek->nama}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Luas Bangunan</label>
                                                <div class="col-lg-8">
                                                <input type="number" id="txt_luas_bangunan" name="luas_bangunan" placeholder="Luas Bangunan" class="form-control" value="{{$unitrumah->luas_bangunan}}" required> 
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Luas Tanah</label>
                                                <div class="col-lg-8">
                                                <input type="number" id="txt_luas_tanah" name="luas_tanah" placeholder="Luas Tanah" class="form-control" value="{{$unitrumah->luas_tanah}}" required> 
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Customer</label>
                                                <div class="col-lg-8">
                                                    <select name="customer_id"placeholder="Customer" class="form-control js-example-basic-single">
                                                        @foreach($customers as $customer)
                                                            @if($customer->id == $unitrumah->customer->id)
                                                                <option value="{{$customer->id}}" selected="">{{$customer->nama}}</option>
                                                            @else
                                                                <option value="{{$customer->id}}">{{$customer->nama}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Mulai Bangun</label>
                                                <div class="col-lg-8">
                                                <input type="date" name="mulai_bangun" placeholder="Mulai Bangun" class="form-control" value="{{$unitrumah->mulai_bangun}}" > 
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Selesai Bangun</label>
                                                <div class="col-lg-8">
                                                <input type="date" name="selesai_bangun" placeholder="Selesai Bangun" class="form-control" value="{{$unitrumah->selesai_bangun}}" > 
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Tanggal Serah Terima Kunci</label>
                                                <div class="col-lg-8">
                                                <input type="date" name="tst_kunci" placeholder="Tanggal Serah Terima Kunci" class="form-control" value="{{$unitrumah->tst_kunci}}" > 
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Pekerja</label>
                                                <div class="col-lg-8">
                                                <select name="pekerja_id"placeholder="Pekerja" class="form-control js-example-basic-single">
                                                        @foreach($pekerjas as $pekerja)
                                                            @if($pekerja->id == $unitrumah->pekerja->id)
                                                                <option value="{{$pekerja->id}}" selected="">{{$pekerja->nama}}</option>
                                                            @else
                                                                <option value="{{$pekerja->id}}">{{$pekerja->nama}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Arsitek</label>
                                                <div class="col-lg-8">
                                                <select name="arsitek_id" placeholder="Arsitek" class="form-control js-example-basic-single">
                                                    @foreach($karyawans as $karyawan)
                                                        @if($karyawan->bagian->nama=="Arsitek")
                                                        @if($unitrumah->arsitek!=null && $karyawan->id == $unitrumah->arsitek->id)
                                                            <option value="{{$karyawan->id}}" selected="">{{$karyawan->nama}}</option>
                                                        @else
                                                            <option value="{{$karyawan->id}}" >{{$karyawan->nama}}</option>
                                                        @endif
                                                        @endif
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Pengawas</label>
                                                <div class="col-lg-8">
                                                <select name="pengawas_id" placeholder="Pengawas" class="form-control js-example-basic-single">
                                                    
                                                    @foreach($karyawans as $karyawan)
                                                    @if($karyawan->bagian->nama=="Pengawas")
                                                        @if($unitrumah->pengawas!=null && $karyawan->id == $unitrumah->pengawas->id)
                                                            <option value="{{$karyawan->id}}" selected="">{{$karyawan->nama}}</option>
                                                        @else
                                                            <option value="{{$karyawan->id}}" >{{$karyawan->nama}}</option>
                                                        @endif
                                                        @endif
                                                    @endforeach

                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Marketing</label>
                                                <div class="col-lg-8">
                                                <select name="marketing_id" placeholder="Marketing" class="form-control js-example-basic-single">
                                                    @foreach($karyawans as $karyawan)
                                                        @if($unitrumah->marketing!=null && $karyawan->bagian->nama=="Marketing")
                                                        @if($karyawan->id == $unitrumah->marketing->id)
                                                            <option value="{{$karyawan->id}}" selected="">{{$karyawan->nama}}</option>
                                                        @else
                                                            <option value="{{$karyawan->id}}" >{{$karyawan->nama}}</option>
                                                        @endif
                                                        @endif
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row"><label class="col-lg-2 form-control-label">Keterangan</label>

                                                <div class="col-lg-8">
                                                     <input type="text" name="keterangan" class="form-control" value="{{$unitrumah->keterangan}}" />
                                                <!-- <textarea class="form-control" name="keterangan" id="" cols="30" rows="10">{{$unitrumah->keterangan}}</textarea> -->
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
            $('#cbo_type').change(function(){
                var id= $(this).val();
                $.ajax({
                    url: '{{url("/typerumah")}}/'+id,
                    type: 'GET',
                    success: function(response){
                        $('#txt_luas_bangunan').val(response.data.luas_bangunan);
                        $('#txt_luas_tanah').val(response.data.luas_tanah);
                        console.log(response);
                    },
                });
            })
        });
    </script>
    @endsection