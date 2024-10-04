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
                            <img src="{{ asset('storage/images/users/' . $business->user->avatar) }}" alt="Profile"
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

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Status akun</div>
                                        <div class="col-lg-9 col-md-8">
                                            @if ($business->user->isActive == 0)
                                                <span class="badge bg-danger">Nonaktif</span>
                                            @else
                                                <span class="badge bg-success">Aktif</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-overview" id="umkm">
                                    <div class="profile-card my-3 d-flex flex-column align-items-center">
                                        @if ($business->avatar)
                                            <img src="{{ asset('storage/images/businesses/' . $business->avatar) }}"
                                                alt="Profile" class="rounded-circle" />
                                        @elseif ($business->image === null)
                                            <img src="{{ asset('images/default-image.jpg') }}" alt="Profile"
                                                class="rounded-circle" />
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nama Usaha</div>
                                        <div class="col-lg-9 col-md-8">{{ $business->business_name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Deskripsi Usaha</div>
                                        <div class="col-lg-9 col-md-8">{{ $business->business_description }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Kategori Usaha</div>
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
                                                    <td colspan="2" class="text-center">
                                                        Tidak ada produk yang tersedia.
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($business->products as $product)
                                                    <tr>
                                                        <td class="align-middle">
                                                            @if ($product->image)
                                                                <img src="{{ asset('storage/images/products/' . $product->image) }}"
                                                                    width="50" height="50" alt="Profile"
                                                                    class="rounded-circle" />
                                                            @elseif ($product->image === null)
                                                                <img src="{{ asset('images/default-image.jpg') }}"
                                                                    width="50" height="50" alt="Profile"
                                                                    class="rounded-circle" />
                                                            @endif
                                                            &nbsp;{{ $product->name }}
                                                        </td>
                                                        <td class="align-middle">
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#detailModal{{ $product->id }}"
                                                                title="Detail">
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
                                                        <h5 class="modal-title">Detail Produk {{ $product->name }} dari
                                                            {{ $product->business->business_name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="d-flex justify-content-center mb-3">
                                                            @if ($product->image)
                                                                <img src="{{ asset('storage/images/products/' . $product->image) }}"
                                                                    width="150" height="150" alt="Profile"
                                                                    class="rounded-circle" />
                                                            @else
                                                                <img src="{{ asset('images/default-image.jpg') }}"
                                                                    width="150" height="150" alt="Profile"
                                                                    class="rounded-circle" />
                                                            @endif
                                                        </div>
                                                        <table class="table-borderless w-100 mb-4">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="fw-bold" style="width: 45%">Kode Produk
                                                                    </td>
                                                                    <td>:</td>
                                                                    <td style="width: 55%">{{ $product->id }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold">Nama</td>
                                                                    <td>:</td>
                                                                    <td>{{ $product->name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold">Deskripsi</td>
                                                                    <td>:</td>
                                                                    <td>{{ $product->description }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold">Harga</td>
                                                                    <td>:</td>
                                                                    <td>{{ formatIDR($product->price) }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold">Kategori Produk</td>
                                                                    <td>:</td>
                                                                    <td>{{ $product->productType->name }}</td>
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
                                                    <td colspan="2" class="text-center">Tidak ada iklan yang tersedia.
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($business->advertisements as $advertisement)
                                                    <tr>
                                                        <td class="align-middle">
                                                            @if ($advertisement->image)
                                                                <img src="{{ asset('storage/images/advertisements/' . $advertisement->image) }}"
                                                                    width="50" height="50" alt="Profile"
                                                                    class="rounded-circle" />
                                                            @elseif ($advertisement->image === null)
                                                                <img src="{{ asset('images/default-image.jpg') }}"
                                                                    width="50" height="50" alt="Profile"
                                                                    class="rounded-circle" />
                                                            @endif
                                                            &nbsp;{{ $advertisement->name }}
                                                        </td>
                                                        <td class="align-middle">
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
                                                        <h5 class="modal-title">Detail Iklan {{ $advertisement->name }}
                                                            dari
                                                            {{ $business->business_name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="d-flex justify-content-center mb-3">
                                                            @if ($advertisement->image)
                                                                <img src="{{ asset('storage/images/advertisements/' . $advertisement->image) }}"
                                                                    width="150" height="150" alt="Profile"
                                                                    class="rounded-circle" />
                                                            @else
                                                                <img src="{{ asset('images/default-image.jpg') }}"
                                                                    width="150" height="150" alt="Profile"
                                                                    class="rounded-circle" />
                                                            @endif
                                                        </div>
                                                        <table class="table-borderless w-100 mb-4">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="fw-bold" style="width: 45%">Kode Iklan</td>
                                                                    <td>:</td>
                                                                    <td style="width: 55%">{{ $advertisement->id }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold">Nama Iklan</td>
                                                                    <td>:</td>
                                                                    <td>{{ $advertisement->name }}</td>
                                                                </tr>
                                                                <td class="fw-bold">Deskripsi Iklan</td>
                                                                <td>:</td>
                                                                <td>
                                                                    {{ $advertisement->description ? $advertisement->description : 'Tidak ada deskripsi iklan.' }}
                                                                </td>
                                                                <tr>
                                                                    <td class="fw-bold">Periode Iklan</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        {{ Carbon\Carbon::parse($advertisement->ad_start)->isoFormat('D MMMM Y') }}
                                                                        -
                                                                        {{ Carbon\Carbon::parse($advertisement->ad_end)->isoFormat('D MMMM Y') }}
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
                                                                <tr>
                                                                    <td class="fw-bold">Status</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <span
                                                                            class="{{ $advertisement->isExpired ? 'badge bg-danger' : 'badge bg-success' }}">
                                                                            {{ $advertisement->isExpired ? 'Kedaluwarsa' : 'Aktif' }}
                                                                        </span>
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
