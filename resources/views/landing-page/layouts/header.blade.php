<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
            {{-- <img src="{{ asset('QuickStart/assets/img/logo.png') }}" alt=""> --}}
            <h1 class="sitename">UMKM Banguntapan</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li>
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                </li>
                <li>
                    <a href="{{ route('businesses') }}"
                        class="{{ request()->routeIs('businesses*') ? 'active' : '' }}">Pelaku
                        Usaha</a>
                </li>
                <li><a href="{{ route('products') }}"
                        class="{{ request()->routeIs('products*') ? 'active' : '' }}">Produk</a>
                </li>
                <li><a href="{{ route('advertisements') }}"
                        class="{{ request()->routeIs('advertisements*') ? 'active' : '' }}">Iklan</a>
                </li>
                <li><a href="{{ route('user.showRegister') }}"
                        class="{{ request()->routeIs('user.showRegister') ? 'active' : '' }}">Registrasi</a>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="{{ route('user.showLogin') }}">Login</a>

    </div>
</header>
