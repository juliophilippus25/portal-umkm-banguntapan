@extends('landing-page.layouts.app')

@section('title', '| Iklan')

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

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Daftar Iklan</h2>
            <p>Cari dan temukan iklan yang tersedia</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up">
            <!-- Card Grid -->
            <div class="row">
                @php
                    $activeAdvertisements = $advertisements->filter(function ($advertisement) {
                        return !$advertisement->isExpired; // Hanya ambil iklan yang tidak Kedaluwarsa
                    });
                @endphp

                @forelse ($activeAdvertisements as $advertisement)
                    <!-- Hanya mengiterasi iklan yang tidak Kedaluwarsa -->
                    <div class="col-lg-4">
                        <div class="card">
                            @if ($advertisement->image)
                                <img src="{{ asset('storage/images/advertisements/' . $advertisement->image) }}"
                                    alt="Profile" class="card-img-top img-cover" width="300px" height="300px" />
                            @else
                                <img src="{{ asset('images/default-image.jpg') }}" alt="Profile"
                                    class="card-img-top img-cover" width="300px" height="300px" />
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $advertisement->name }}</h5>
                                <p class="card-text">
                                    {{ $advertisement->description ? $advertisement->description : 'Tidak ada deskripsi iklan.' }}
                                </p>
                                <p class="text-muted">
                                    {{ Carbon\Carbon::parse($advertisement->ad_start)->isoFormat('D MMMM Y') }}
                                    -
                                    {{ Carbon\Carbon::parse($advertisement->ad_end)->isoFormat('D MMMM Y') }}</p>
                                <a href="{{ route('advertisements.detail', $advertisement->id) }}"
                                    class="btn btn-custom col-12">Lihat Selengkapnya</a>
                            </div>
                        </div><!-- End Card with an image on top -->
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>Tidak ada iklan yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
            <!-- End Card Grid -->

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $advertisements->links('vendor.pagination.bootstrap-5') }} <!-- Menggunakan pagination kustom -->
            </div>
        </div>

    </section><!-- /Starter Section Section -->


@endsection
