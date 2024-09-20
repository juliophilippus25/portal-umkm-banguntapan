<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        @auth('admin')
            <li class="nav-item">
                <a class="nav-link collapsed active" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin.users') }}">
                    <i class="bi bi-people"></i>
                    <span>Pengguna</span>
                </a>
            </li><!-- End Users Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="index.html">
                    <i class="bi bi-grid"></i>
                    <span>Kategori</span>
                </a>
            </li><!-- End Categories Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="index.html">
                    <i class="bi bi-building"></i>
                    <span>Kelurahan</span>
                </a>
            </li><!-- End Categories Nav -->
        @endauth

        @auth('user')
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('user.dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="bi bi-bag"></i>
                    <span>Produk</span>
                </a>
            </li><!-- End Produk Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="bi bi-badge-ad"></i>
                    <span>Iklan</span>
                </a>
            </li><!-- End Iklan Nav -->
        @endauth

    </ul>

</aside><!-- End Sidebar-->
