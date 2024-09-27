@extends('layouts.app')

@section('title', 'Produk')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            {{-- <h1>Manajemen Pengguna</h1> --}}
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Produk</li>

                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manajemen Produk</h5>

                        <!-- Default Table -->
                        <table id="myTable" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">UMKM</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="align-middle">
                                            @if ($product->image)
                                                <img src="{{ asset('storage/images/products/' . $product->image) }}"
                                                    width="50" height="50" alt="Profile" class="rounded-circle" />
                                            @elseif ($product->image === null)
                                                <img src="{{ asset('images/default-image.jpg') }}" width="50"
                                                    height="50" alt="Profile" class="rounded-circle" />
                                            @endif
                                            &nbsp;{{ $product->name }}
                                        </td>
                                        <td class="align-middle">{{ $product->business->business_name }}</td>
                                        <td class="align-middle">
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#detailModal{{ $product->id }}" title="Detail">
                                                <i class="bi bi-eye"></i>
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
            @foreach ($products as $product)
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
                                        <img src="{{ asset('storage/images/products/' . $product->image) }}" width="150"
                                            height="150" alt="Profile" class="rounded-circle" />
                                    @else
                                        <img src="{{ asset('images/default-image.jpg') }}" width="150" height="150"
                                            alt="Profile" class="rounded-circle" />
                                    @endif
                                </div>
                                <table class="table-borderless w-100 mb-4">
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold" style="width: 45%">Kode Produk</td>
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- End Show Modal --}}

        </section>

    </main><!-- End #main -->

@endsection
