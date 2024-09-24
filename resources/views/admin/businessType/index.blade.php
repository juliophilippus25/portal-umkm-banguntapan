@extends('layouts.app')

@section('title', 'Users')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            {{-- <h1>Manajemen Pengguna</h1> --}}
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Jenis Usaha</li>

                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manajemen Jenis Usaha</h5>

                        <!-- Default Table -->
                        <table id="myTable" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Jenis Usaha</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bTypes as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>-</td>
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
