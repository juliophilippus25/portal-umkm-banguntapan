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

            @auth('admin')
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">{{ $countUnverifiedUsers }}</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            Anda memiliki {{ $countUnverifiedUsers }} notifikasi baru
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        @if ($countUnverifiedUsers > 0)
                            @foreach ($getUnverifiedUsers as $user)
                                <li class="notification-item">
                                    <i class="bi bi-info-circle text-primary"></i>
                                    <div>
                                        <h4>Akun belum terverifikasi</h4>
                                        <p>{{ $user->name }} - {{ $user->business->business_name }}</p>
                                        <p>{{ $user->created_at->diffForHumans() }}</p>
                                    </div>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            @endforeach
                        @else
                            <li class="notification-item">
                                <div>
                                    <h4>Tidak ada notifikasi baru</h4>
                                </div>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        @endif

                        <li class="dropdown-footer">
                            <a href="{{ route('admin.users') }}"><span class="badge rounded-pill bg-primary p-2 ms-2">Lihat
                                    Semua</span></a>
                        </li>

                    </ul><!-- End Notification Dropdown Items -->
                </li><!-- End Notification Nav -->
            @endauth

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
