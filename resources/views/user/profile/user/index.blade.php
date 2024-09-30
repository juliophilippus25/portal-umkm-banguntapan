@extends('layouts.app')

@section('title', 'Profil Ku')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            {{-- <h1>Manajemen Pengguna</h1> --}}
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Profil Ku</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            @if ($user->avatar)
                                <img src="{{ asset('storage/images/users/' . $user->avatar) }}" alt="Profile"
                                    class="rounded-circle" />
                            @elseif ($user->avatar === null)
                                <img src="{{ asset('images/default-image.jpg') }}" alt="Profile" class="rounded-circle" />
                            @endif
                            <h2>{{ $user->name }}</h2>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <div class="profile-edit">
                                <form action="{{ route('user.profile.update', $user->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="imgInp" class="col-md-4 col-lg-3 col-form-label">Foto
                                            Profil</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="mb-2">
                                                <small class="text-muted"><em>Unggah foto dengan format jpg/jpeg/png dan
                                                        maksimal ukuran foto 2mb</em></small>
                                            </div>
                                            @if ($user->avatar)
                                                <img id="preview"
                                                    src="{{ asset('storage/images/users/' . $user->avatar) }}"
                                                    width="150" height="150" />
                                            @else
                                                <img id="preview" src="{{ asset('images/default-image.jpg') }}"
                                                    width="150" height="150" />
                                            @endif
                                            <div class="mt-3">
                                                <div class="input-group">
                                                    <input class="form-control @error('avatar') is-invalid @enderror"
                                                        type="file" id="imgInp" name="avatar" accept="image/*">
                                                </div>
                                                @error('avatar')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror @if (old('name') && !$errors->has('name')) is-valid @endif"
                                                id="name" value="{{ old('name', $user->name) }}"
                                                placeholder="Masukkan nama lengkap anda">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="nik" class="col-md-4 col-lg-3 col-form-label">NIK</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="nik" type="text"
                                                class="form-control @error('nik') is-invalid @enderror @if (old('nik') && !$errors->has('nik')) is-valid @endif"
                                                id="nik" value="{{ old('nik', $user->nik) }}"
                                                placeholder="Masukkan nama lengkap anda"
                                                onkeypress="return isNumberKey(event)">
                                            @error('nik')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror @if (old('email') && !$errors->has('email')) is-valid @endif"
                                                id="email" value="{{ old('email', $user->email) }}"
                                                placeholder="Masukkan email anda">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="phone" class="col-md-4 col-lg-3 col-form-label">Nomor HP</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text"
                                                class="form-control @error('phone') is-invalid @enderror @if (old('phone') && !$errors->has('phone')) is-valid @endif"
                                                id="phone" value="{{ old('phone', $user->phone) }}"
                                                onkeypress="return isNumberKey(event)" placeholder="Masukkan nomor HP anda">
                                            @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-lg-3 col-form-label">Kata Sandi
                                            Baru</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror @if (old('password') && !$errors->has('password')) is-valid @endif"
                                                id="password" placeholder="Masukkan kata sandi baru">
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password_confirmation"
                                            class="col-md-4 col-lg-3 col-form-label">Konfirmasi Kata Sandi</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password_confirmation" type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror @if (old('password_confirmation') && !$errors->has('password_confirmation')) is-valid @endif"
                                                id="password_confirmation" placeholder="Masukkan konfirmasi kata sandi">
                                            @error('password_confirmation')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <div class="form-check mt-2">
                                                <input type="checkbox" name="check-password" id="check-password"
                                                    class="form-check-input" onclick="togglePassword()">
                                                <label for="check-password"
                                                    class="form-check-label text-muted"><small>Tampilkan kata
                                                        sandi</small></label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

@section('script')
    <script>
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }

        function togglePassword() {
            var x = document.getElementById("password");
            var y = document.getElementById("password_confirmation");
            if (x.type === "password" && y.type === "password") {
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
        }
    </script>
@endsection

@endsection
