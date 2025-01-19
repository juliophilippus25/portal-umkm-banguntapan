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
                @if (!auth('user')->check() && !auth('admin')->check())
                    <li><a href="{{ route('user.showRegister') }}"
                            class="{{ request()->routeIs('user.showRegister') ? 'active' : '' }}">Registrasi</a></li>
                @endif
                @auth('user')
                    <li class="dropdown"><a href="#">
                            <span>
                                {{ Auth::guard('user')->user()->name }}
                            </span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                            <li>
                                <a href="{{ route('user.logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span>Logout</span>
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </li>
                @endauth

                @auth('admin')
                    <li class="dropdown"><a href="#">
                            <span>
                                {{ Auth::guard('admin')->user()->name }}
                            </span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li>
                                <a href="{{ route('admin.logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span>Logout</span>
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </li>
                @endauth
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        @if (!auth('user')->check() && !auth('admin')->check())
            <a class="btn-getstarted" href="{{ route('user.showLogin') }}">Login</a>
        @endif

    </div>
</header>
