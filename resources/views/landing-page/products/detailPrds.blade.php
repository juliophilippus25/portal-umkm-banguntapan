@extends('landing-page.layouts.app')

@section('title', '| ' . $product->name)

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

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">

        <div class="container p-4" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="card col-lg-10 mb-3 shadow-sm">
                    <div class="row">
                        <div class="col-md-4 p-0">
                            @if ($product->image)
                                <img src="{{ asset('storage/images/products/' . $product->image) }}"
                                    alt="{{ $product->name }}" class="card-img-top img-cover" width="300px"
                                    height="300px" />
                            @else
                                <img src="{{ asset('images/default-image.jpg') }}" alt="Default Image"
                                    class="card-img-top img-cover" width="300px" height="300px" />
                            @endif
                        </div>
                        <div class="col-md-8">
                            @php
                                $colors = [
                                    1 => 'bg-primary',
                                    2 => 'bg-success',
                                    3 => 'bg-warning',
                                    4 => 'bg-info',
                                    5 => 'bg-secondary',
                                ];
                            @endphp
                            <div class="card-body">
                                <span class="badge {{ $colors[$product->productType->id] ?? 'bg-warning' }} mb-2">
                                    {{ $product->productType->name }}
                                </span>
                                <h3 class="card-title">{{ $product->name }} - {{ $product->business->business_name }}</h3>
                                <small class="text-muted">Diposting
                                    {{ Carbon\Carbon::parse($product->created_at)->isoFormat('D MMMM Y') }}</small>
                                <p class="card-text">
                                    {{ $product->description ? $product->description : 'Tidak ada deskripsi produk' }}
                                </p>
                                <p class="card-text">{{ formatIDR($product->price) }}</p>
                                <div class="text-center">
                                    <a href="#" id="whatsapp-link" class="btn btn-custom">
                                        <i class="bi bi-whatsapp"></i> Hubungi Kami Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Card with an image on left -->
            </div>
            <a href="{{ route('products') }}" class="btn btn-secondary mt-5">Kembali</a>
        </div>


    </section><!-- /Starter Section Section -->

@section('script')
    <script>
        // Mengumpulkan nama produk menjadi array
        const productName = "{{ $product->name }}";

        const rawPhoneNumber = "{{ $product->business->business_phone }}"; // Misalnya 082242482355
        const phoneNumber = rawPhoneNumber.replace(/^0/, '62'); // Mengganti 0 dengan 62
        const businessName = "{{ $product->business->business_name }}"; // Ganti dengan iklan

        document.getElementById('whatsapp-link').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah default link behavior

            // Menggabungkan nama produk menjadi string
            const message =
                `Halo ${businessName}! Saya sangat tertarik dengan produk anda ${productName}. Apakah masih tersedia? Terima kasih!`;
            const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        });
    </script>
@endsection

@endsection
