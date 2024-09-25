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
                                    <th scope="col">Nama Iklan</th>
                                    <th scope="col">Tanggal Iklan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($advertisements as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            {{ Carbon\Carbon::parse($item->ad_start)->isoFormat('D MMMM Y') }} -
                                            {{ Carbon\Carbon::parse($item->ad_end)->isoFormat('D MMMM Y') }}
                                        </td>
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
