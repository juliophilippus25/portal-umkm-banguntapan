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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Manajemen Produk</h5>
                        <a href="{{ route('user.products.create') }}" class="btn btn-primary" title="Tambah">
                            <i class="bi bi-plus"></i> Produk</a>
                    </div>
                    <div class="card-body">
                        <!-- Default Table -->
                        <table id="myTable" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Produk</th>
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
                                        <td class="align-middle">
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#detailModal{{ $product->id }}" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <a href="{{ route('user.products.edit', $product->id) }}"
                                                class="btn btn-warning btn-sm" title="Ubah"><i
                                                    class="bi bi-pencil"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $product->id }}" title="Hapus">
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
            @foreach ($products as $product)
                <div class="modal fade" id="detailModal{{ $product->id }}" tabindex="-1">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Produk {{ $product->name }}</h5>
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
                                            <td class="fw-bold">Jenis Produk</td>
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

            <!-- Modal Hapus -->
            @foreach ($products as $product)
                <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1"
                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus produk <strong>{{ $product->name }}</strong>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('user.products.destroy', $product->id) }}" method="POST"
                                    style="display: inline;">
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
