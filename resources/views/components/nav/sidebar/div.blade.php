<!-- leftbar-tab-menu -->
<div class="startbar d-print-none">
    <!--start brand-->
    <div class="brand">
        <a href="{{ url('/') }}" class="logo">
            <span>
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="logo-small" class="logo-sm">
            </span>
            <span class="">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="logo-large" class="logo-lg logo-light">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="logo-large" class="logo-lg logo-dark">
            </span>
        </a>
    </div>
    <!--end brand-->
    <!--start startbar-menu-->
    <div class="startbar-menu">
        <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
            <div class="d-flex align-items-start flex-column w-100">
                <!-- Navigation -->
                <ul class="navbar-nav mb-auto w-100" id="sidebar-menu" style="display:none">
                    <li class="menu-label mt-2">
                        <span>Main</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('dashboard') }}">
                            <i class="iconoir-report-columns menu-icon"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wishlist" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="wishlist">
                            <i class="iconoir-paste-clipboard menu-icon"></i>
                            <span>Wishlist</span>
                        </a>
                        <div class="collapse " id="wishlist">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="{{ url('wishlist/categories') }}" class="nav-link ">Kategori</a>
                                </li><!--end nav-item-->
                                <li class="nav-item">
                                    <a href="{{ url('wishlist/wishlists') }}" class="nav-link ">Wishlist</a>
                                </li><!--end nav-item-->
                            </ul><!--end nav-->
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tasklist" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="tasklist">
                            <i class="iconoir-paste-clipboard menu-icon"></i>
                            <span>Tasklist</span>
                        </a>
                        <div class="collapse " id="tasklist">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="{{ url('tasklist/overview') }}" class="nav-link ">Overview</a>
                                </li><!--end nav-item-->
                                <li class="nav-item">
                                    <a href="{{ url('tasklist/projects') }}" class="nav-link ">Project</a>
                                </li><!--end nav-item-->
                                <li class="nav-item">
                                    <a href="{{ url('tasklist/tasklist') }}" class="nav-link ">Tasklist</a>
                                </li><!--end nav-item-->
                            </ul><!--end nav-->
                        </div>
                    </li>
                </ul><!--end navbar-nav--->

                <l-hatch id="loader-sidebar" size="50" stroke="4" speed="3.5" color="white"
                    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                </l-hatch>

            </div>
        </div><!--end startbar-collapse-->
    </div><!--end startbar-menu-->
</div><!--end startbar-->
