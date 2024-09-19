@extends('layouts.app')

@section('title', 'Users')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Manajemen Pengguna</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Pengguna</li>

                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Default Table</h5>

                        <!-- Default Table -->
                        <table class="table">
                            <thead>

                                <tr>
                                    <th scope="col">Nama Pemilik</th>
                                    <th scope="col">Nama UMKM</th>
                                    <th scope="col">Tanggal Daftar</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->business->business_name }}</td>
                                        <td>{{ $user->business->created_at }}</td>
                                        <td>
                                            @if ($user->email_verified_at == null)
                                                <span class="badge bg-danger">Belum Verifikasi</span>
                                            @elseif ($user->email_verified_at)
                                                <span class="badge bg-success">Terverifikasi</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.userVerify', $user->id) }}"
                                                class="btn btn-primary btn-sm"><i class="bi bi-check"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <strong class="text-dark">
                                                <center>No data available.</center>
                                            </strong>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <!-- End Default Table Example -->
                    </div>
                </div>
            </div>

        </section>

    </main><!-- End #main -->

@endsection
