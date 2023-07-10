<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link bg-primary bg-light">
        <img src="{{ Storage::url($setting->logo_header) ?? asset('assets/logo/logo.png') }}" alt="AdminLTE Logo"
            class="" style=" width: 50%; height: 50%; margin-left: auto; margin-right: auto;display: block;">
        {{-- <span class="brand-text font-weight-light" style="margin-left: auto; margin-right: auto;">{{ config('app.name') }}</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel  pb-3 mb-3 d-flex" style="margin-top: 45%">
            <div class="image">
                <img src="{{ Storage::url(auth()->user()->path_image) }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="javascript:void(0)" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @if (auth()->user()->hasRole('admin'))
                    <li class="nav-header">MASTER DATA</li>
                @else
                    <li class="nav-header">MANAJEMEN DATA</li>
                @endif

                @if (Auth()->user()->hasRole('admin'))
                    <li class="nav-item">
                        <a href="{{ route('petugas.index') }}"
                            class="nav-link {{ request()->is('admin/petugas*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Petugas
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('parkir.index') }}"
                            class="nav-link {{ request()->is('admin/parkir*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-parking"></i>
                            <p>
                                Parkir
                            </p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasRole('admin'))
                    <li class="nav-header">REPORT</li>
                     <li class="nav-item">
                         <a href="{{ route('report.index') }}" class="nav-link {{ request()->is('admin/report') ? 'active' : '' }}">
                             <i class="nav-icon fas fa-file-pdf"></i>
                             <p>
                                 Laporan
                             </p>
                         </a>
                     </li>
                    <li class="nav-header">PENGATURAN APLIKASI</li>
                    <li class="nav-item">
                        <a href="{{ route('setting.index') }}"
                            class="nav-link {{ request()->is('admin/setting*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Pengaturan
                            </p>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('scan.index') }}"
                            class="nav-link {{ request()->is('karyawan/scan') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-qrcode"></i>
                            <p>
                                SCAN QR
                            </p>
                        </a>
                    </li>
                @endif

                <li class="nav-header">MANAJEMEN AKUN</li>
                <li class="nav-item">
                    <a href="{{ route('profile.show') }}"
                        class="nav-link {{ request()->is('user/profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profil
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profile.show.password') }}"
                        class="nav-link {{ request()->is('user/profile/password') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-unlock"></i>
                        <p>
                            Ubah Password
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link"
                        onclick="document.querySelector('#form-logout').submit()">
                        <i class="nav-icon fas fa-sign-in-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                    <form action="{{ route('logout') }}" method="post" id="form-logout">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
