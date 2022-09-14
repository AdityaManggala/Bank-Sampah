<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Bank Sampah</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                @if (Auth::guard('admin')->check())
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}"
                            class="nav-link @if (Route::is('dashboard')) active @endif">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Dashboard
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </a>
                    @elseif (Auth::guard('nasabah')->check())
                    <li class="nav-item">
                        <a href="{{ route('nasabah.profilNasabah') }}"
                            class="nav-link @if (Route::is('nasabah.profilNasabah')) active @endif">
                            <i class="nav-icon fa fa-user"></i>
                            <p> Profil Nasabah </p>
                        </a>
                @endif
                @if (Auth::guard('admin')->check())
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
                            <i class="nav-icon fas fa-sitemap"></i>
                            <p>
                                Data Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('jenis-harga-sampah.index') }}"
                                    class="nav-link @if (Route::is('jenis-harga-sampah.index')) active @endif">
                                    <i class="far fa-circle nav-icon "></i>
                                    <p>Jenis Harga</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('jenis-satuan-sampah.index') }}"
                                    class="nav-link @if (Route::is('jenis-satuan-sampah.index')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jenis Satuan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('sampah.index') }}"
                                    class="nav-link @if (Route::is('sampah.index')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Sampah</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('nasabah.index') }}"
                                    class="nav-link @if (Route::is('nasabah.index')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nasabah</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('transaksi-nasabah.index') }}"
                                    class="nav-link @if (Route::is('transaksi-nasabah.index')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Transaksi Nasabah</p>
                                </a>
                            </li>
                        </ul>
                    @elseif (Auth::guard('nasabah')->check())
                    <li class="nav-item">
                        <a href="{{ route('transaksi.nasabah', Auth::id()) }}"
                            class="nav-link @if (Route::is('transaksi.nasabah')) active @endif">
                            <i class="fas fa-shopping-cart nav-icon"></i>
                            
                            <p>Transaksi Nasabah</p>
                        </a>
                    </li>
                @endif
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
</aside>
