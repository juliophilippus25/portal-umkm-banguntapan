@extends('layouts.app')

@section('title', 'UMKM')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            {{-- <h1>Manajemen Pengguna</h1> --}}
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">UMKM</li>

                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manajemen UMKM</h5>

                        <!-- Default Table -->
                        <table id="myTable" class="table">
                            <thead>

                                <tr>
                                    <th scope="col">Nama UMKM</th>
                                    <th scope="col">Tanggal Bergabung</th>
                                    <th scope="col">Jenis Usaha</th>
                                    <th scope="col">Bertempat</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($businesses as $item)
                                    <tr>
                                        <td>{{ $item->business_name }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->created_at)->isoFormat('D MMMM Y') }}</td>
                                        <td>{{ $item->businessType->name }}</td>
                                        <td>{{ $item->subDistrict->name }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                                        </td>
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
