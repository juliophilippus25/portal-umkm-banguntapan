@extends('layouts.app')

@section('title', 'UMKM')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            {{-- <h1>Manajemen Pengguna</h1> --}}
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">UMKM</li>
                    <li class="breadcrumb-item active">Detail {{ $business->business_name }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="{{ asset('NiceAdmin/assets/img/profile-img.jpg') }}" alt="Profile"
                                class="rounded-circle">
                            <h2>{{ $business->user->name }}</h2>
                            <h3>{{ $business->business_name }}</h3>

                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#pemilik">Pemilik</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#umkm">UMKM</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#products">Produk</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#advertisements">Iklan</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="pemilik">

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                        <div class="col-lg-9 col-md-8">{{ $business->user->name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">UMKM</div>
                                        <div class="col-lg-9 col-md-8">{{ $business->business_name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">NIK</div>
                                        <div class="col-lg-9 col-md-8">{{ $business->user->nik }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ $business->user->email }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Bergabung sejak</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ Carbon\Carbon::parse($business->user->email_verified_at)->isoFormat('D MMMM Y') }}
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane fade show active profile-overview" id="umkm">

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nama Usaha</div>
                                        <div class="col-lg-9 col-md-8">{{ $business->business_name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Deskripsi Usaha</div>
                                        <div class="col-lg-9 col-md-8">{{ $business->business_description }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Jenis Usaha</div>
                                        <div class="col-lg-9 col-md-8">{{ $business->businessType->name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Kalurahan</div>
                                        <div class="col-lg-9 col-md-8">{{ $business->subDistrict->name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Alamat Usaha</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $business->address }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Kode Pos</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $business->zip_code }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nomor HP Usaha</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $business->business_phone }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nomor Sertifikat PIRT</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $business->no_pirt ? $business->no_pirt : 'Belum ada' }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Website</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $business->website ? $business->website : 'Belum ada' }}
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane fade pt-3" id="products">

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($business->products->isEmpty())
                                                <tr>
                                                    <td colspan="2">Tidak ada produk yang tersedia.</td>
                                                </tr>
                                            @else
                                                @foreach ($business->products as $product)
                                                    <tr>
                                                        <td>{{ $product->name }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#detailModal{{ $product->id }}">
                                                                <i class="bi bi-eye"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>

                                    {{-- Show Modal --}}
                                    @foreach ($business->products as $product)
                                        <div class="modal fade" id="detailModal{{ $product->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Produk
                                                            {{ $business->business_name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Data Penanggung Jawab -->
                                                        <table class="table-borderless w-100 mb-4">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="fw-bold" style="width: 45%">Nama Produk
                                                                    </td>
                                                                    <td>:</td>
                                                                    <td style="width: 55%">{{ $product->name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold">Jenis Produk</td>
                                                                    <td>:</td>
                                                                    <td>{{ $product->productType->name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold">Gambar</td>
                                                                    <td>:</td>
                                                                    <td>{{ $product->image ? $product->image : 'Belum ada' }}
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{-- End Show Modal --}}

                                </div>

                                <div class="tab-pane fade pt-3" id="advertisements">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nama Iklan</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($business->advertisements->isEmpty())
                                                <tr>
                                                    <td colspan="2">Tidak ada iklan yang tersedia.</td>
                                                </tr>
                                            @else
                                                @foreach ($business->advertisements as $advertisement)
                                                    <tr>
                                                        <td>{{ $advertisement->name }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#detailAdsModal{{ $advertisement->id }}">
                                                                <i class="bi bi-eye"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>

                                    {{-- Show Modal --}}
                                    @foreach ($business->advertisements as $advertisement)
                                        <div class="modal fade" id="detailAdsModal{{ $advertisement->id }}"
                                            tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Iklan
                                                            {{ $business->business_name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table-borderless w-100 mb-4">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="fw-bold" style="width: 45%">Nama Iklan</td>
                                                                    <td>:</td>
                                                                    <td style="width: 55%">{{ $advertisement->name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold">Tanggal Iklan</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        {{ Carbon\Carbon::parse($advertisement->ad_start)->isoFormat('D MMMM Y') }}
                                                                        -
                                                                        {{ Carbon\Carbon::parse($advertisement->ad_end)->isoFormat('D MMMM Y') }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold">Gambar</td>
                                                                    <td>:</td>
                                                                    <td>{{ $advertisement->image ? $advertisement->image : 'Belum ada' }}
                                                                    </td>
                                                                </tr>
                                                                {{-- Menampilkan data AdvertisementProduct --}}
                                                                <tr>
                                                                    <td class="fw-bold">Produk yang Diiklankan</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        @if ($advertisement->advertisementProducts->isEmpty())
                                                                            <span>Tidak ada produk yang diiklankan.</span>
                                                                        @else
                                                                            <span>
                                                                                @foreach ($advertisement->advertisementProducts as $index => $adProduct)
                                                                                    {{ $adProduct->product ? $adProduct->product->name : 'Produk tidak ditemukan' }}
                                                                                    @if (!$loop->last)
                                                                                        ,
                                                                                    @endif
                                                                                @endforeach
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{-- End Show Modal --}}

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
            <a href="{{ route('admin.business') }}" class="btn btn-secondary">Kembali</a>
        </section>

    </main><!-- End #main -->

@endsection
