<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-home"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Geshos 404</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Profil Hotel -->
    <li class="nav-item {{ Request::is('profil*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/profil') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Profil Geshos</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen Data
    </div>

    <!-- Nav Item - Kamar -->
    <li class="nav-item {{ Request::is('kamar*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/kamar') }}">
            <i class="fas fa-fw fa-door-open"></i>
            <span>Data Kamar</span></a>
    </li>

    <!-- Nav Item - Penyewa -->
    <li class="nav-item {{ Request::is('penyewa*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/penyewa') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Tamu</span></a>
    </li>

    <!-- Nav Item - Pembayaran -->
    <li class="nav-item {{ Request::is('pembayaran*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/pembayaran') }}">
            <i class="fas fa-fw fa-money-bill-wave"></i>
            <span>Transaksi Pembayaran</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Laporan
    </div>

    <!-- Nav Item - Laporan -->
    <li class="nav-item {{ Request::is('laporan*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/laporan') }}">
            <i class="fas fa-fw fa-file-invoice"></i>
            <span>Laporan Keuangan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
