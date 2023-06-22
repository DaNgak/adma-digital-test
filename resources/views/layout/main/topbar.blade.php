<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" >
        <em class="fa fa-bars"></em>
    </button>

    <!-- Topbar Search -->
    {{-- @if ($title !== "Dashboard" && $title !== "Detail Data")
        <form action="" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input id="inputkey" type="text" name="key" value="{{ request("key") }}" autofocus="" autocomplete="off" class="form-control bg-light border-0 small" placeholder="Search by Name" />
                <input id="inputtabel" type="hidden" value="test" />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <em class="fas fa-search fa-sm"></em>
                    </button>
                </div>
            </div>
        </form>
    @endif --}}

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->username }}</span>
                <img alt="Provile" class="img-profile rounded-circle" src="{{ asset("img/undraw_profile.svg") }}"/>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <em class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></em>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <em class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></em>
                    Settings
                </a>
                <a class="dropdown-item" href="#">
                    <em class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></em>
                    Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <em class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></em>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>