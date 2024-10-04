@extends('landing-page.layouts.app')

@section('title', '| ' . $business->business_name)

@section('body-class', 'starter-page-page')

@section('content')
    {{-- <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Daftar Pelaku Usaha</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Pelaku Usaha</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title --> --}}

    <!-- Starter Section -->
    <section id="starter-section" class="starter-section section">
        <div class="container p-4" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="card col-lg-10 mb-3 shadow-sm">
                    <div class="row">
                        <div class="col-md-4 p-0">
                            @if ($business->image)
                                <img src="{{ asset('storage/images/businesses/' . $business->image) }}"
                                    alt="{{ $business->business_name }}" class="card-img-top img-cover" width="300"
                                    height="300" />
                            @else
                                <img src="{{ asset('images/default-image.jpg') }}" alt="Default Image"
                                    class="card-img-top img-cover" width="300" height="300" />
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h3 class="card-title">{{ $business->business_name }}</h3>
                                <small class="text-muted">
                                    Bergabung sejak
                                    {{ \Carbon\Carbon::parse($business->created_at)->isoFormat('D MMMM Y') }}
                                </small>
                                <p class="card-text">
                                    {{ $business->description ?: 'Tidak ada deskripsi usaha' }}
                                </p>
                                <p class="card-text">
                                    <strong>Kategori Usaha:</strong> {{ $business->businessType->name }}
                                </p>
                                <p class="card-text">
                                    <strong>Lokasi:</strong> {{ $business->address }},
                                    {{ $business->subDistrict->name }}, Kode Pos
                                    {{ $business->zip_code }}
                                </p>
                                <div class="text-center mt-4">
                                    <a href="#" id="whatsapp-link" class="btn btn-custom">
                                        <i class="bi bi-whatsapp"></i> Hubungi Kami Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Card with an image on left -->
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Produk {{ $business->business_name }}</h2>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row g-5">
                @forelse ($products as $product)
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item item-cyan position-relative">
                            @if ($product->image)
                                <img src="{{ asset('storage/images/products/' . $product->image) }}"
                                    alt="{{ $product->name }}" class="img-fluid img-cover" width="100px" height="100px" />
                            @else
                                <img src="{{ asset('images/default-image.jpg') }}" alt="Profile"
                                    class="img-fluid img-cover" width="100px" height="100px" />
                            @endif
                            <div class="p-3"> <!-- Added padding for spacing -->
                                <h3>{{ $product->name }}</h3>
                                <p>{{ $product->description }}</p>
                                <p>{{ formatIDR($product->price) }}</p>
                                <a href="{{ route('products.detail', $product->id) }}"
                                    class="read-more stretched-link">Lihat Selengkapnya <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->
                @empty
                    <div class="col-12 text-center" data-aos="fade-up" data-aos-delay="200">
                        <p>Tidak ada produk yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5" data-aos="zoom-out" data-aos-delay="100">
                {{ $products->links('vendor.pagination.bootstrap-5') }} <!-- Menggunakan pagination kustom -->
            </div>
        </div>

    </section><!-- /Services Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Iklan {{ $business->business_name }}</h2>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row g-4"> <!-- Menambahkan row untuk mengatur layout -->
                @php
                    $activeAdvertisements = $advertisements->filter(function ($advertisement) {
                        return !$advertisement->isExpired; // Hanya ambil iklan yang tidak Kedaluwarsa
                    });
                @endphp

                @forelse ($activeAdvertisements as $advertisement)
                    <!-- Hanya mengiterasi iklan yang tidak Kedaluwarsa -->
                    <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <!-- Mengatur kolom menjadi 6 (2 per row) -->
                        <div class="testimonial-item">
                            <div class="profile">
                                @if ($advertisement->image)
                                    <img src="{{ asset('storage/images/advertisements/' . $advertisement->image) }}"
                                        class="card-img-top img-cover" width="300px" height="300px"
                                        alt="{{ $advertisement->name }}" />
                                @else
                                    <img src="{{ asset('images/default-image.jpg') }}" alt="Profile"
                                        class="card-img-top img-cover" width="300px" height="300px" />
                                @endif
                                <h3>{{ $advertisement->name }}
                                </h3>
                            </div>
                            <p>
                                {{ $advertisement->description ? $advertisement->description : 'Tidak ada deskripsi iklan' }}
                            </p>
                            <p class="text-muted">
                                {{ Carbon\Carbon::parse($advertisement->ad_start)->isoFormat('D MMMM Y') }}
                                -
                                {{ Carbon\Carbon::parse($advertisement->ad_end)->isoFormat('D MMMM Y') }}</p>
                            <a href="{{ route('advertisements.detail', $advertisement->id) }}"
                                class="read-more stretched-link">Lihat Selengkapnya <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div><!-- End Testimonial Item -->
                @empty
                    <div class="col-12 text-center" data-aos="fade-up" data-aos-delay="200">
                        <p>Tidak ada iklan yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5" data-aos="zoom-out" data-aos-delay="100">
                {{ $advertisements->links('vendor.pagination.bootstrap-5') }} <!-- Menggunakan pagination kustom -->
            </div>
            <a href="{{ route('businesses') }}" class="btn btn-secondary mt-5">Kembali</a>
        </div>

    </section><!-- /Testimonials Section -->

    @section('script')
        <script>
            const rawPhoneNumber = "{{ $business->business_phone }}"; // Misalnya 082242482355
            const phoneNumber = rawPhoneNumber.replace(/^0/, '62'); // Mengganti 0 dengan 62
            const businessName = "{{ $business->business_name }}"; // nama bisnis

            document.getElementById('whatsapp-link').addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah default link behavior

                const message =
                    `Halo ${businessName}! Saya sangat tertarik dengan produk-produk Anda. Apakah masih tersedia? Terima kasih!`;
                const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
                window.open(whatsappUrl, '_blank');
            });
        </script>
    @endsection
@endsection
