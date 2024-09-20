<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between w-full">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="{{ asset('NiceAdmin/assets/img/logo.png') }}" alt="Logo">
            <span class="d-none d-lg-block">{{ env('APP_NAME') }}</span>
            {{-- <h1 class="d-none d-lg-block">{{ env('APP_NAME') }}</h1> --}}
        </a>
        <i class="bi bi-list d-block toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('NiceAdmin/assets/img/profile-img.jpg') }}" alt="Profile"
                        class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">
                        @auth('admin')
                            {{ Auth::guard('admin')->user()->name }}
                            @elseauth('user')
                            {{ Auth::guard('user')->user()->name }}
                        @endauth
                    </span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>
                            @auth('admin')
                                {{ Auth::guard('admin')->user()->name }}
                                @elseauth('user')
                                {{ Auth::guard('user')->user()->name }}
                            @endauth
                        </h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-person"></i>
                            <span>Profil Ku</span>
                        </a>
                    </li>

                    @auth('user')
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-shop"></i>
                                <span>Profil UMKM</span>
                            </a>
                        </li>
                    @endauth

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        @auth('admin')
                            @php $logoutRoute = route('admin.logout'); @endphp
                            @elseauth('user')
                            @php $logoutRoute = route('user.logout'); @endphp
                        @endauth

                        @if (isset($logoutRoute))
                            <a class="dropdown-item d-flex align-items-center" href="{{ $logoutRoute }}"
                                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ $logoutRoute }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endif
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
