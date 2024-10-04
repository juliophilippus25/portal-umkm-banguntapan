@extends('landing-page.layouts.app')

@section('title', '| Login')

@section('body-class', 'starter-page-page')

@section('content')
    <!-- Hero Section -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <div class="card mb-3 shadow-sm" data-aos="fade-up">
                        <div class="card-body">
                            <h5 class="card-title text-center pb-3 fs-4"><strong>Masuk ke Akun Anda</strong></h5>

                            <form action="{{ route('user.login') }}" method="POST" class="row g-3">
                                @csrf

                                <div class="col-12">
                                    <label for="email" class="form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror @if (old('email') && !$errors->has('email')) is-valid @endif"
                                        id="email" placeholder="Masukkan email anda" value="{{ old('email') }}"
                                        required>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="password" class="form-label">Kata Sandi <span
                                            class="text-danger">*</span></label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" id="password"
                                        placeholder="Masukkan kata sandi anda" required>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input type="checkbox" name="check-password" id="check-password"
                                            class="form-check-input" onclick="togglePassword()">
                                        <label class="form-check-label" for="check-password">Tampilkan kata sandi</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn btn-custom w-100" type="submit">Login</button>
                                </div>

                                <div class="col-12 text-center mt-3">
                                    <a href="{{ route('user.showRegister') }}" class="text-decoration-none">Belum punya
                                        akun? Registrasi disini</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Hero Section -->

@section('script')
    <script>
        function togglePassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endsection
@endsection
