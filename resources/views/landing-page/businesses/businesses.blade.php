@extends('landing-page.layouts.app')

@section('title', '| UMKM')

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
            <h2>Daftar Pelaku Usaha</h2>
            <p>Cari dan temukan pelaku usaha</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up">
            <!-- Default Table -->
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <th scope="col">Nama Usaha</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Nomor Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($businesses as $business)
                        <tr>
                            <td>
                                <a href="{{ route('businesses.detail', $business->id) }}">{{ $business->business_name }}</a>
                            </td>
                            <td>{{ $business->subDistrict->name }}</td>
                            <td>{{ $business->business_phone }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <!-- End Default Table Example -->
        </div>

    </section><!-- /Starter Section Section -->


@endsection
