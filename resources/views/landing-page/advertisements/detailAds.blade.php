@extends('landing-page.layouts.app')

@section('title', '| ' . $advertisement->name)

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
                            @if ($advertisement->image)
                                <img src="{{ asset('storage/images/advertisements/' . $advertisement->image) }}"
                                    alt="{{ $advertisement->name }}" class="card-img-top img-cover" width="300px"
                                    height="300px" />
                            @else
                                <img src="{{ asset('images/default-image.jpg') }}" alt="Default Image"
                                    class="card-img-top img-cover" width="300px" height="300px" />
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h3 class="card-title">{{ $advertisement->name }} -
                                    {{ $advertisement->business->business_name }}</h3>
                                <small class="text-muted">Diposting
                                    {{ Carbon\Carbon::parse($advertisement->created_at)->isoFormat('D MMMM Y') }}</small>
                                <p class="card-text">
                                    {{ $advertisement->description ? $advertisement->description : 'Tidak ada deskripsi iklan' }}
                                </p>
                                @if ($advertisement->advertisementProducts->isEmpty())
                                    <span class="badge bg-secondary">Saat ini tidak ada produk yang diiklankan.</span>
                                @else
                                    <span class="badge bg-success">
                                        @foreach ($advertisement->advertisementProducts as $index => $adProduct)
                                            {{ $adProduct->product ? $adProduct->product->name : 'Produk tidak ditemukan' }}
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </span>
                                @endif
                                <p class="text-muted mt-2">
                                    {{ Carbon\Carbon::parse($advertisement->ad_start)->isoFormat('D MMMM Y') }} -
                                    {{ Carbon\Carbon::parse($advertisement->ad_end)->isoFormat('D MMMM Y') }}
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
            <a href="{{ route('advertisements') }}" class="btn btn-secondary mt-5">Kembali</a>
        </div>


    </section><!-- /Starter Section Section -->

@section('script')
    <script>
        // Mengumpulkan nama produk menjadi array
        const productNames = [
            @foreach ($advertisement->advertisementProducts as $index => $adProduct)
                "{{ $adProduct->product ? $adProduct->product->name : 'Produk tidak ditemukan' }}"
                @if (!$loop->last)
                    ,
                @endif
            @endforeach
        ];

        const rawPhoneNumber = "{{ $advertisement->business->business_phone }}"; // Misalnya 082242482355
        const phoneNumber = rawPhoneNumber.replace(/^0/, '62'); // Mengganti 0 dengan 62
        const advertisements = "{{ $advertisement->name }}"; // Ganti dengan iklan
        const businessName = "{{ $advertisement->business->business_name }}"; // Ganti dengan iklan

        document.getElementById('whatsapp-link').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah default link behavior

            // Menggabungkan nama produk menjadi string
            const productName = productNames.join(', '); // Menggabungkan nama produk dengan koma
            const message =
                `Halo ${businessName}! Saya sangat tertarik dengan produk yang Anda iklankan: ${productName}. Apakah ${advertisements} masih berlaku? Terima kasih!`;
            const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        });
    </script>
@endsection

@endsection
