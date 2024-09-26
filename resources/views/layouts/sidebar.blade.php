<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        @auth('admin')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}"
                    href="{{ route('admin.users') }}">
                    <i class="bi bi-people"></i>
                    <span>Pengguna</span>
                </a>
            </li><!-- End Users Nav -->

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.business*') ? 'active' : '' }}"
                    href="{{ route('admin.business') }}">
                    <i class="bi bi-shop"></i>
                    <span>UMKM</span>
                </a>
            </li><!-- End UMKM Nav -->

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.products') ? 'active' : '' }}"
                    href="{{ route('admin.products') }}">
                    <i class="bi bi-bag"></i>
                    <span>Produk</span>
                </a>
            </li><!-- End Produk Nav -->

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.advertisements') ? 'active' : '' }}"
                    href="{{ route('admin.advertisements') }}">
                    <i class="bi bi-badge-ad"></i>
                    <span>Iklan</span>
                </a>
            </li><!-- End Iklan Nav -->

            <li class="nav-item">
                <a class="nav-link 
                    {{ request()->routeIs('admin.bTypes') || request()->routeIs('admin.pTypes') ? 'active' : 'collapsed' }}"
                    data-bs-target="#categories-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-grid"></i><span>Kategori</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="categories-nav"
                    class="nav-content collapse {{ request()->routeIs('admin.bTypes') || request()->routeIs('admin.pTypes') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin.bTypes') }}"
                            class="{{ request()->routeIs('admin.bTypes') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Usaha</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pTypes') }}"
                            class="{{ request()->routeIs('admin.pTypes') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Produk</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Categories Nav -->


            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.subDistrict') ? 'active' : '' }}"
                    href="{{ route('admin.subDistrict') }}">
                    <i class="bi bi-building"></i>
                    <span>Kalurahan</span>
                </a>
            </li><!-- End Sub Kalurahan Nav -->
        @endauth

        @auth('user')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}"
                    href="{{ route('user.dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('user.products*') ? 'active' : '' }}"
                    href="{{ route('user.products') }}">
                    <i class="bi bi-bag"></i>
                    <span>Produk</span>
                </a>
            </li><!-- End Produk Nav -->

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('user.advertisements*') ? 'active' : '' }}"
                    href="{{ route('user.advertisements') }}">
                    <i class="bi bi-badge-ad"></i>
                    <span>Iklan</span>
                </a>
            </li><!-- End Iklan Nav -->
        @endauth

    </ul>

</aside><!-- End Sidebar-->
