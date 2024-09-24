@extends('layouts.app')

@section('title', 'Users')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            {{-- <h1>Manajemen Pengguna</h1> --}}
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
                        <h5 class="card-title">Manajemen Pengguna</h5>

                        <!-- Default Table -->
                        <table id="myTable" class="table">
                            <thead>
                                <tr>
                                    <th scope="col-3">Nama Pemilik</th>
                                    <th scope="col-3">Nama UMKM</th>
                                    <th scope="col=2">Tanggal Daftar</th>
                                    <th scope="col-2">Status</th>
                                    <th scope="col-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->business->business_name }}</td>
                                        <td>{{ Carbon\Carbon::parse($user->business->created_at)->isoFormat('D MMMM Y') }}
                                        </td>
                                        <td>
                                            @if ($user->email_verified_at == null)
                                                <span class="badge bg-danger">Belum Verifikasi</span>
                                            @elseif ($user->email_verified_at)
                                                <span class="badge bg-success">Terverifikasi</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->email_verified_at == null)
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#verifyModal{{ $user->id }}">
                                                    <i class="bi bi-check"></i>
                                                </button>
                                            @elseif ($user->email_verified_at)
                                                <a href="#" class="btn btn-primary btn-sm"><i
                                                        class="bi bi-eye"></i></a>
                                            @endif

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

        {{-- Modal --}}
        @foreach ($users as $user)
            <div class="modal fade" id="verifyModal{{ $user->id }}" tabindex="-1">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Verifikasi Akun</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Data Penanggung Jawab -->
                            <table class="table-borderless w-100 mb-4">
                                <thead>
                                    <tr>
                                        <th colspan="3" class="text-center fw-bold fs-4">Data Penanggung Jawab</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold" style="width: 45%">Nama Pemilik</td>
                                        <td>:</td>
                                        <td style="width: 55%">{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Nomor HP</td>
                                        <td>:</td>
                                        <td>{{ $user->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">NIK</td>
                                        <td>:</td>
                                        <td>{{ $user->nik }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Email</td>
                                        <td>:</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Data UMKM -->
                            <table class="table-borderless w-100">
                                <thead>
                                    <tr>
                                        <th colspan="3" class="text-center fw-bold fs-4">Data UMKM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold" style="width: 45%">Nama Usaha</td>
                                        <td>:</td>
                                        <td style="width: 55%">{{ $user->business->business_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Deskripsi Usaha</td>
                                        <td>:</td>
                                        <td>{{ $user->business->business_description }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Jenis Usaha</td>
                                        <td>:</td>
                                        <td>{{ $user->business->businessType->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Kalurahan</td>
                                        <td>:</td>
                                        <td>{{ $user->business->subDistrict->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Alamat Usaha</td>
                                        <td>:</td>
                                        <td>{{ $user->business->address }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Kode Pos</td>
                                        <td>:</td>
                                        <td>{{ $user->business->zip_code }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Nomor HP Usaha</td>
                                        <td>:</td>
                                        <td>{{ $user->business->business_phone ?? 'Belum Diisi' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Nomor Sertifikat PIRT</td>
                                        <td>:</td>
                                        <td>{{ $user->business->no_pirt ?? 'Belum Diisi' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Website</td>
                                        <td>:</td>
                                        <td>{{ $user->business->website ?? 'Belum Diisi' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                            <a href="{{ route('admin.userVerify', $user->id) }}" class="btn btn-primary">Verifikasi</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </main><!-- End #main -->

@endsection
