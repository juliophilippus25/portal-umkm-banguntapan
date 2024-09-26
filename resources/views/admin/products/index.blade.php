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
                                    <th scope="col">Jenis Produk</th>
                                    <th scope="col">Oleh UMKM</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->productType->name }}</td>
                                        <td>{{ $product->business->business_name }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <!-- End Default Table Example -->
                    </div>
                </div>
            </div>

        </section>

    </main><!-- End #main -->

@endsection
