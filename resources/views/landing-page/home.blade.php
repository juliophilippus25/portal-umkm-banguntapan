@extends('landing-page.layouts.app')

@section('body-class', 'index-page')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">
        <div class="hero-bg">
            <img src="{{ asset('QuickStart/assets/img/hero-bg-light.webp') }}" alt="">
        </div>
        <div class="container text-center">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h1 data-aos="fade-up">Selamat datang di <span>{{ env('APP_NAME') }}</span></h1>
                <p data-aos="fade-up" data-aos-delay="100">Mari bergabung bersama kami<br></p>
                <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('user.showRegister') }}" class="btn-get-started">Registrasi</a>
                </div>
                <img src="{{ asset('QuickStart/assets/img/hero-services-img.webp') }}" class="img-fluid hero-img"
                    alt="" data-aos="zoom-out" data-aos-delay="300">
            </div>
        </div>

    </section><!-- /Hero Section -->

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section light-background">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Panduan</h2>
        </div><!-- End Section Title -->
        <div class="container">

            <div class="row gy-4">

                <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item d-flex">
                        <div class="icon flex-shrink-0"><i class="bi bi-clipboard-data"></i></div>
                        <div>
                            <h4 class="title"><a href="#" class="stretched-link">Daftar Sekarang</a></h4>
                            <p class="description">Bergabunglah dengan komunitas kami dengan membuat akun baru. Isi
                                formulir pendaftaran dengan informasi yang diperlukan untuk memulai perjalanan Anda.
                                Proses ini cepat dan mudah, dan hanya memerlukan beberapa menit!</p>
                        </div>
                    </div>
                </div>
                <!-- End Service Item -->

                <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item d-flex">
                        <div class="icon flex-shrink-0"><i class="bi bi-envelope"></i></div>
                        <div>
                            <h4 class="title"><a href="#" class="stretched-link">Konfirmasi Melalui Email
                                    Anda</a></h4>
                            <p class="description">Setelah pendaftaran, Anda akan menerima email verifikasi. Klik
                                tautan
                                yang dikirimkan untuk mengonfirmasi akun Anda. Ini adalah langkah penting untuk
                                menjaga
                                keamanan dan integritas akun Anda.</p>
                        </div>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item d-flex">
                        <div class="icon flex-shrink-0"><i class="bi bi-card-list"></i></div>
                        <div>
                            <h4 class="title"><a href="#" class="stretched-link">Sesuaikan Produk dan Iklan
                                    Anda</a>
                            </h4>
                            <p class="description">Setelah akun Anda terverifikasi, Anda dapat mulai mengatur produk
                                dan
                                iklan sesuai kebutuhan. Gunakan fitur yang kami sediakan untuk menambahkan deskripsi
                                produk, mengunggah gambar, dan membuat iklan yang menarik untuk menjangkau lebih
                                banyak
                                pelanggan.</p>
                        </div>
                    </div>
                </div><!-- End Service Item -->

            </div>

        </div>

    </section><!-- /Featured Services Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Produk Terbaru</h2>
            <p>Temukan berbagai produk terbaru yang ditawarkan oleh pelaku usaha. Dari inovasi hingga barang
                berkualitas, kami menyajikan pilihan menarik yang siap memenuhi kebutuhan Anda. Pastikan Anda tidak
                ketinggalan untuk menjelajahi koleksi terbaru ini!</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row g-5">
                @forelse ($products as $product)
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item item-cyan position-relative">
                            @if ($product->image)
                                <img src="{{ asset('storage/images/products/' . $product->image) }}" alt="Profile"
                                    class="img-fluid img-cover" width="100px" height="100px" />
                            @else
                                <img src="{{ asset('images/default-image.jpg') }}" alt="Profile"
                                    class="img-fluid img-cover" width="100px" height="100px" />
                            @endif
                            <div class="p-3"> <!-- Added padding for spacing -->
                                <h3>{{ $product->name }} dari {{ $product->business->business_name }}</h3>
                                <p>{{ $product->description }}</p>
                                <p>{{ formatIDR($product->price) }}</p>
                                <a href="{{ route('products.detail', $product->id) }}"
                                    class="read-more stretched-link">Lihat Selengkapnya <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->
                @empty
                    <div class="col-12 text-center">
                        <p>Tidak ada produk yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-5" data-aos="zoom-out" data-aos-delay="100">
                <a href="{{ route('products') }}" class="read-more stretched-link" style="font-size: 1.5rem;">
                    <!-- Besar tulisan -->
                    Lihat Semua Produk
                </a>
            </div>
        </div>

    </section><!-- /Services Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Iklan Terbaru</h2>
            <p>Jelajahi iklan terbaru dari pelaku usaha yang siap menarik perhatian Anda. Dari promosi menarik
                hingga
                penawaran khusus, iklan ini dirancang untuk memberikan informasi terkini tentang produk dan layanan
                yang
                tersedia. Dapatkan penawaran terbaik dan jadilah yang pertama mengetahui promo menarik!</p>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row g-4"> <!-- Menambahkan row untuk mengatur layout -->
                @php
                    $activeAdvertisements = $advertisements->filter(function ($advertisement) {
                        return !$advertisement->isExpired; // Hanya ambil iklan yang tidak kedaluwarsa
                    });
                @endphp

                @forelse ($activeAdvertisements as $advertisement)
                    <!-- Hanya mengiterasi iklan yang tidak kedaluwarsa -->
                    <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <!-- Mengatur kolom menjadi 6 (2 per row) -->
                        <div class="testimonial-item">
                            <div class="profile">
                                @if ($advertisement->image)
                                    <img src="{{ asset('storage/images/advertisements/' . $advertisement->image) }}"
                                        class="card-img-top img-cover" width="300px" height="300px" />
                                @else
                                    <img src="{{ asset('images/default-image.jpg') }}" alt="Profile"
                                        class="card-img-top img-cover" width="300px" height="300px" />
                                @endif
                                <h3>{{ $advertisement->name }} dari
                                    {{ $advertisement->business->business_name }}
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
                    <div class="col-12 text-center">
                        <p>Tidak ada iklan yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-4" data-aos="zoom-out" data-aos-delay="100">
                <a href="{{ route('advertisements.detail', $advertisement->id) }}" class="read-more stretched-link"
                    style="font-size: 1.5rem;"> <!-- Besar tulisan -->
                    Lihat Semua Iklan
                </a>
            </div>
        </div>

    </section><!-- /Testimonials Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Kontak Kami</h2>
            <p>Jika Anda memiliki pertanyaan, saran, atau membutuhkan bantuan, jangan ragu untuk menghubungi kami.
                Tim
                kami siap membantu Anda dengan cepat dan profesional.</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-6">
                    <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up"
                        data-aos-delay="200">
                        <i class="bi bi-geo-alt"></i>
                        <h3>Alamat</h3>
                        <p>Jl. Gedongkuning No.170</p>
                    </div>
                </div><!-- End Info Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up"
                        data-aos-delay="300">
                        <i class="bi bi-telephone"></i>
                        <h3>Telepon Kami</h3>
                        <p>+62 9449 8844 7755</p>
                    </div>
                </div><!-- End Info Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up"
                        data-aos-delay="400">
                        <i class="bi bi-envelope"></i>
                        <h3>Email Kami</h3>
                        <p>admin@umkmbanguntapan.com</p>
                    </div>
                </div><!-- End Info Item -->

            </div>

            <div class="row gy-4 mt-1">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.8387775767897!2d110.39997217415564!3d-7.80688617750471!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a57427fdba893%3A0xb33a91d740d0f003!2sPemerintah%20Kalurahan%20Banguntapan!5e0!3m2!1sid!2sid!4v1727846997899!5m2!1sid!2sid"
                        frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div><!-- End Google Maps -->

            </div>

        </div>

    </section><!-- /Contact Section -->
@endsection
