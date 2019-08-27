 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-laugh-wink"></i>
  </div>
  <div class="sidebar-brand-text mx-3">ADMIN <sup>PANEL</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="{{ url('home') }}">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

@if(Auth::user()->level_id=='2')

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Perijinan
</div>

<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cube"></i>
          <span>Master Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Master Data :</h6>
            <a class="collapse-item" href="{{ url('customer') }}">Master Customer</a>
            <a class="collapse-item" href="{{ url('karyawan') }}">Master Karyawan</a>
            <a class="collapse-item" href="{{ url('supplier') }}">Master Supplier</a>
            <a class="collapse-item" href="{{ url('katmaterial') }}">Master Kategori Material</a>
            <a class="collapse-item" href="{{ url('material') }}">Master Material</a>
            <a class="collapse-item" href="{{ url('gudang') }}">Master Gudang</a>
            <a class="collapse-item" href="{{ url('item') }}">Master Item</a>
            <a class="collapse-item" href="{{ url('katpekerjaan') }}">Master Kategori Pekerjaan</a>
            
            <a class="collapse-item" href="{{ url('pekerjaan') }}">Master Pekerjaan</a>
            <a class="collapse-item" href="{{ url('pekerja') }}">Master Pekerja</a>
            <a class="collapse-item" href="{{ url('proyek') }}">Master Proyek</a>
            
            
            <a class="collapse-item" href="{{ url('typerumah') }}">Master TypeRumah</a>
            <a class="collapse-item" href="{{ url('unitrumah') }}">Master Unit Rumah</a>
            
            <a class="collapse-item" href="{{ url('rabmaterialtype') }}">RAB Material Type</a>
            <a class="collapse-item" href="{{ url('rabmaterialunit') }}">RAB Material Unit</a>

            <a class="collapse-item" href="{{ url('rabpekerjaantype') }}">RAB Pekerjaan Type</a>
            <a class="collapse-item" href="{{ url('rabpekerjaanunit') }}">RAB Pekerjaan Unit</a>

            <!-- <a class="collapse-item" href="{{ url('opnamemaster') }}">Master Opname</a>
            <a class="collapse-item" href="{{ url('opnamedetail') }}">Detail Master Opname</a>

            <a class="collapse-item" href="{{ url('pakaimaterialmaster') }}">Master Pakai Material</a>
            <a class="collapse-item" href="{{ url('pakaimaterialdetail') }}">Detail Pakai Material</a> -->

          </div>
        </div>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cube"></i>
          <span>Transaksi</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">

            <!-- <a class="collapse-item" href="{{ url('opnamedetail') }}">Detail Master Opname</a> -->
            <a class="collapse-item" href="{{ url('pembelianitem') }}">Pembelian Item</a>
            <a class="collapse-item" href="{{ url('pakaimaterialmaster') }}">Pemakaian Material</a>
            <a class="collapse-item" href="{{ url('opnamemaster') }}">Opname Progress</a>
            
            <!-- <a class="collapse-item" href="{{ url('pakaimaterialdetail') }}">Detail Pakai Material</a> -->

          </div>
        </div>
      </li>


<!-- Nav Item - Pages Collapse Menu -->
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Manajement User
</div>

<li class="nav-item active"><a class="nav-link" href="{{ url('level') }}"><i class="fas fa-fw fa fa-bolt"></i><span>Level</span></a></li>
<li class="nav-item active"><a class="nav-link" href="{{ url('user') }}"><i class="fas fa-fw fa fa-user-circle"></i><span>Users</span></a></li>
<li class="nav-item active"><a class="nav-link" href="{{ url('setting') }}"><i class="fas fa-fw fa fa-cogs"></i><span>Setting</span></a></li>
@elseif (Auth::user()->level_id=='1')

<!-- Heading -->
<div class="sidebar-heading">
  Manajement Aset
</div>


<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item active"><a class="nav-link" href="{{ url('kategori') }}"><i class="fas fa-fw fa-cog"></i><span>Kategori</span></a></li>
<li class="nav-item active"><a class="nav-link" href="{{ url('aset') }}"><i class="fas fa-fw fa-id-card"></i><span>Manajement Aset</span></a></li>
<!-- Divider -->
<hr class="sidebar-divider">

@endif

<li class="nav-item active"><a class="nav-link" href="{{ url('/logout') }}"><i class="fas fa-fw fa fa-times-circle"></i><span>Logout</span></a></li>
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->
