@extends('components.layouts.app')

@section('title', $title)

@section('content')
    <!-- Page Content -->
    <main id="main">

        <!-- Breadcrumbs-->
        <div class="bg-white border-bottom py-3 mb-2">
            <div class="container-fluid d-flex justify-content-between align-items-start align-items-md-center flex-column flex-md-row">
                <nav class="mb-0" aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active" aria-current="page">L O G I N</li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-end align-items-center mt-3 mt-md-0">
                    <a class="btn btn-sm btn-secondary-faded ms-2 text-body" href="#"><i class="ri-question-line align-bottom"></i> Bantuan</a>
                </div>
            </div>
        </div>
        <!-- / Breadcrumbs-->

        <!-- Content-->
        <section class="container-fluid">

            <div class="card mb-4">
                <div class="card-header text-center">
                    <h3 class="card-title m-0">Login</h3>
                    @session('status')
                        <div class="alert alert-success mt-3" role="alert">
                            <strong>Terima Kasih!</strong> {{ session('status') }}
                        </div>
                    @endsession
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login.submit') }}">
                        @method('POST')
                        @csrf

                        <!-- Username / Email -->
                        <div class="mb-3">
                            <label for="login" class="form-label">Username / Email</label>
                            <input type="text" class="form-control @error('login') is-invalid @enderror" id="login" name="login" value="{{ old('login') }}"
                                placeholder="Masukkan Username atau Email" required autofocus>
                            @error('login')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan Password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember me -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>

            <!-- Footer -->
            <footer class="footer">
                <p class="small text-muted m-0">All rights reserved | © {{ date('Y') }}</p>
                <p class="small text-muted m-0">Template created by <a href="https://www.pixelrocket.store/">PixelRocket</a></p>
            </footer>

            <!-- Sidebar Menu Overlay-->
            <div class="menu-overlay-bg"></div>
            <!-- / Sidebar Menu Overlay-->

        </section>
        <!-- / Content-->

    </main>
    <!-- /Page Content -->
@endsection
