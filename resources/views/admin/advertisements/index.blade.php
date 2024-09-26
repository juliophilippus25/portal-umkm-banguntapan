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
                    <div class="card-body">
                        <h5 class="card-title">Manajemen Iklan</h5>

                        <!-- Default Table -->
                        <table id="myTable" class="table">
                            <thead>

                                <tr>
                                    <th scope="col">Nama Iklan</th>
                                    <th scope="col">Tanggal Iklan</th>
                                    <th scope="col">Oleh UMKM</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($advertisements as $advertisement)
                                    <tr>
                                        <td>{{ $advertisement->name }}</td>
                                        <td>
                                            {{ Carbon\Carbon::parse($advertisement->ad_start)->isoFormat('D MMMM Y') }}
                                            -
                                            {{ Carbon\Carbon::parse($advertisement->ad_end)->isoFormat('D MMMM Y') }}
                                        </td>
                                        <td>{{ $advertisement->business->business_name }}</td>
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
