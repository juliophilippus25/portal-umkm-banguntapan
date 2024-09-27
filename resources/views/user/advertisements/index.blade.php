@extends('layouts.app')

@section('title', 'Iklan')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            {{-- <h1>Manajemen Pengguna</h1> --}}
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Iklan</li>

                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Manajemen Iklan</h5>
                        <a href="{{ route('user.advertisements.create') }}" class="btn btn-primary" title="Tambah">
                            <i class="bi bi-plus"></i> Iklan</a>
                    </div>
                    <div class="card-body">
                        <!-- Default Table -->
                        <table id="myTable" class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="col-3">Nama Iklan</th>
                                    <th scope="col" class="col-5">Periode Iklan</th>
                                    <th scope="col" class="col-2">Status</th>
                                    <th scope="col" class="col-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($advertisements as $advertisement)
                                    <tr>
                                        <td class="align-middle">
                                            @if ($advertisement->image)
                                                <img src="{{ asset('storage/images/advertisements/' . $advertisement->image) }}"
                                                    width="50" height="50" alt="Profile" class="rounded-circle" />
                                            @else
                                                <img src="{{ asset('images/default-image.jpg') }}" width="50"
                                                    height="50" alt="Profile" class="rounded-circle" />
                                            @endif
                                            {{ $advertisement->name }}
                                        </td>
                                        <td class="align-middle">
                                            {{ Carbon\Carbon::parse($advertisement->ad_start)->isoFormat('D MMMM Y') }} -
                                            {{ Carbon\Carbon::parse($advertisement->ad_end)->isoFormat('D MMMM Y') }}
                                        </td>
                                        <td class="align-middle">
                                            <span
                                                class="{{ $advertisement->isExpired ? 'badge bg-danger' : 'badge bg-success' }}">
                                                {{ $advertisement->isExpired ? 'Kadaluarsa' : 'Aktif' }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#detailAdsModal{{ $advertisement->id }}" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $advertisement->id }}" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Default Table Example -->
                    </div>
                </div>
            </div>

            {{-- Show Modal --}}
            @foreach ($advertisements as $advertisement)
                <div class="modal fade" id="detailAdsModal{{ $advertisement->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Iklan
                                    {{ $advertisement->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex justify-content-center mb-3">
                                    @if ($advertisement->image)
                                        <img src="{{ asset('storage/images/advertisements/' . $advertisement->image) }}"
                                            width="150" height="150" alt="Profile" class="rounded-circle" />
                                    @else
                                        <img src="{{ asset('images/default-image.jpg') }}" width="150" height="150"
                                            alt="Profile" class="rounded-circle" />
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
                                        <tr>
                                            <td class="fw-bold">Deskripsi Iklan</td>
                                            <td>:</td>
                                            <td>
                                                {{ $advertisement->description ? $advertisement->description : 'Tidak ada deskripsi iklan.' }}
                                            </td>
                                        </tr>
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
                                                    {{ $advertisement->isExpired ? 'Kadaluarsa' : 'Aktif' }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- End Show Modal --}}

            <!-- Modal Hapus -->
            @foreach ($advertisements as $advertisement)
                <div class="modal fade" id="deleteModal{{ $advertisement->id }}" tabindex="-1"
                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus iklan <strong>{{ $advertisement->name }}</strong>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('user.advertisements.destroy', $advertisement->id) }}"
                                    method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- End Modal Hapus -->

        </section>

    </main><!-- End #main -->

@endsection
