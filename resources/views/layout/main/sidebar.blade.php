<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route("dashboard.index") }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <em class="fas fa-laugh-wink"></em>
        </div>
        <div class="sidebar-brand-text mx-3">TravelApp</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route("dashboard.index") }}">
            <em class="fas fa-fw fa-tachometer-alt"></em>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">



    @if (auth()->user()->role === "admin")    
        <!-- Nav Item - Tables -->
        <div class="sidebar-heading">
            Data Table
        </div>
        <!-- Nav Item - Table -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <em class="fas fa-fw fa-table"></em>
                <span>Tabel Data</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">List Tabel Data</h6>
                    <a class="collapse-item" href="{{ route("location.index") }}">Data Lokasi</a>
                    <a class="collapse-item" href="{{ route("merek.index") }}">Data Merek</a>
                    <a class="collapse-item" href="{{ route("pricing-order.index") }}">Data Harga</a>
                    <a class="collapse-item" href="{{ route("transport.index") }}">Data Kendaraan</a>
                    {{-- @if (auth()->user()->role === "admin")
                        <a class="collapse-item" href="{{ route("transport.index") }}">Data Kendaraan</a>
                        <a class="collapse-item" href="{{ route("transport.index") }}">Data Kendaraan</a>
                        <a class="collapse-item" href="{{ route("order-transport.index") }}">Data Sewa (Ongoing)</a>
                        <a class="collapse-item" href="{{ route("order-transport.finish.index") }}">Data Sewa (Finish)</a>
                    @else
                        <a class="collapse-item" href="{{ route("transport.boss.index") }}">Data Kendaraan</a>
                        <a class="collapse-item" href="{{ route("order-transport.boss.index") }}">Data Sewa (Ongoing)</a>
                        <a class="collapse-item" href="{{ route("order-transport.finish.index") }}">Data Sewa (Finish)</a>
                    @endif --}}
                </div>
            </div>
        </li>
        
        {{-- Data User --}}
        <div class="sidebar-heading">
            Data Order
        </div>

        <!-- Nav Item - Table -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapsePagesOrder"
                aria-expanded="true" aria-controls="collapsePagesOrder">
                <em class="fas fa-fw fa-table"></em>
                <span>Tabel Data</span>
            </a>
            <div id="collapsePagesOrder" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">List Tabel Data</h6>
                    <a class="collapse-item" href="{{ route("order-transport.index") }}">Data Order</a>
                    {{-- @if (auth()->user()->role === "admin")
                        <a class="collapse-item" href="{{ route("transport.index") }}">Data Kendaraan</a>
                        <a class="collapse-item" href="{{ route("transport.index") }}">Data Kendaraan</a>
                        <a class="collapse-item" href="{{ route("order-transport.index") }}">Data Sewa (Ongoing)</a>
                        <a class="collapse-item" href="{{ route("order-transport.finish.index") }}">Data Sewa (Finish)</a>
                    @else
                        <a class="collapse-item" href="{{ route("transport.boss.index") }}">Data Kendaraan</a>
                        <a class="collapse-item" href="{{ route("order-transport.boss.index") }}">Data Sewa (Ongoing)</a>
                        <a class="collapse-item" href="{{ route("order-transport.finish.index") }}">Data Sewa (Finish)</a>
                    @endif --}}
                </div>
            </div>
        </li>
        <!-- Nav Item - Trash Data -->
        <div class="sidebar-heading">
            Data Sampah
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapsePagesTrash"
                aria-expanded="true" aria-controls="collapsePagesTrash">
                <em class="fas fa-fw fa-table"></em>
                <span>Tabel Sampah</span>
            </a>
            <div id="collapsePagesTrash" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">List Tabel Sampah</h6>
                    <a class="collapse-item" href="{{ route("location.trash.index") }}">Data Lokasi</a>
                    <a class="collapse-item" href="{{ route("merek.trash.index") }}">Data Merek</a>
                    <a class="collapse-item" href="{{ route("pricing-order.trash.index") }}">Data Harga</a>
                    <a class="collapse-item" href="{{ route("transport.trash.index") }}">Data Kendaraan</a>
                    <a class="collapse-item" href="{{ route("order-transport.trash.index") }}">Data Order</a>
                    {{-- <a class="collapse-item" href="{{ route("rooms.trash.index") }}">Data Kamar</a>
                    <a class="collapse-item" href="{{ route("dormitory.trash.index") }}">Data Penghuni</a>
                    <a class="collapse-item" href="{{ route("transactions.trash.index") }}">Data Transaksi</a>
                    <a class="collapse-item" href="{{ route("users.trash.index") }}">Data User</a> --}}
                </div>
            </div>
        </li>
    @endif

    @if (auth()->user()->role === "user")
        <div class="sidebar-heading">
            Data
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapsePagesTrash"
                aria-expanded="true" aria-controls="collapsePagesTrash">
                <em class="fas fa-fw fa-table"></em>
                <span>Tabel Data</span>
            </a>
            <div id="collapsePagesTrash" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">List Tabel</h6>
                    <a class="collapse-item" href="{{ route("order.index") }}">Data Order</a>
                    <a class="collapse-item" href="{{ route("user.order.history") }}">Riwayat Order</a>
                    <a class="collapse-item" href="{{ route("user.transport.index") }}">Daftar Kendaraan</a>
                    <a class="collapse-item" href="{{ route("user.pricing-order.index") }}">Daftar Rute</a>
                    {{-- <a class="collapse-item" href="{{ route("rooms.trash.index") }}">Data Kamar</a>
                    <a class="collapse-item" href="{{ route("dormitory.trash.index") }}">Data Penghuni</a>
                    <a class="collapse-item" href="{{ route("transactions.trash.index") }}">Data Transaksi</a>
                    <a class="collapse-item" href="{{ route("users.trash.index") }}">Data User</a> --}}
                </div>
            </div>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider">


</ul>
<!-- End of Sidebar -->