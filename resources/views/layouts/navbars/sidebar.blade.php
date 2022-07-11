<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-home text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                @can('admin.hakakses', Auth::user())
                    <li class="nav-pa {{ $activePage == 'permission' || $activePage == 'role' ? ' active' : '' }}">
                        <a class="nav-link collapsed" href="#navbar-examples" data-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="navbar-examples">
                            <i class="ni ni-lock-circle-open"></i>
                            <span class="nav-link-text">{{ __('Hak Akses') }}</span>
                        </a>
                        <div class="collapse" id="navbar-examples">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('permission.index') }}">
                                        {{ __('Permission') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('role.index') }}">
                                        {{ __('Role') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan
                @can('admin.crud-vendor-client', Auth::user())
                    <li class="nav-vc {{ $activePage == 'vendor' || $activePage == 'client' ? ' active' : '' }}">
                        <a class="nav-link collapsed" href="#navbar-crud-vendor" data-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="navbar-crud-vendor">
                            <i class="ni ni-collection"></i>
                            <span class="nav-link-text">{{ __('Clients & Vendor') }}</span>
                        </a>
                        <div class="collapse" id="navbar-crud-vendor">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('client.index') }}">
                                        {{ __('Clients') }}
                                    </a>
                                    <a class="nav-link" href="{{ route('vendor.index') }}">
                                        {{ __('Vendors') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan
                @can('admin.transaksi', Auth::user())
                    <li
                        class="nav-tr {{ $activePage == 'sales_orders' || $activePage == 'job_orders' ? ' active' : '' }}">
                        <a class="nav-link collapsed" href="#navbar-crud-Transaksi" data-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="navbar-crud-Transaksi">
                            <i class="ni ni-credit-card"></i>
                            <span class="nav-link-text">{{ __('Transaksi') }}</span>
                        </a>

                        <div class="collapse" id="navbar-crud-Transaksi">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('job_order.index') }}">
                                        {{ __('Job Order') }}
                                    </a>
                                    <a class="nav-link" href="{{ route('sales_order.index') }}">
                                        {{ __('Sales Order') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan
                @can('admin.cetakinv', Auth::user())
                    <li class="nav-inv {{ $activePage == 'invoice' ? ' active' : '' }}">
                        <a class="nav-link collapsed" href="#navbar-crud-cetak" data-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="navbar-crud-cetak">
                            <i class="fas fa-file-export"></i>
                            <span class="nav-link-text">{{ __('Cetak Invoice') }}</span>
                        </a>

                        <div class="collapse" id="navbar-crud-cetak">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('finance.index') }}">
                                        {{ __('finance') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                {{-- isi nav bawah --}}
            </ul>
        </div>
    </div>
</nav>
