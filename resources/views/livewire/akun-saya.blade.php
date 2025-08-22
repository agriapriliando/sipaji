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
            <div class="card-body">
                <div>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form wire:submit.prevent="update">
                        @csrf
                        <div class="row">
                            <!-- Nama -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Username -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" wire:model="username" class="form-control @error('username') is-invalid @enderror">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <!-- Password Baru -->
                                <div class="col-md-6 mb-3" x-data="{ show: false }">
                                    <label class="form-label">Password Baru</label>
                                    <div class="input-group">
                                        <input :type="show ? 'text' : 'password'" wire:model.live.debounce.300ms="password" class="form-control @error('password') is-invalid @enderror">
                                        <button type="button" class="btn btn-outline-secondary" @click="show = !show">
                                            <i :class="show ? 'ri-eye-off-line' : 'ri-eye-line'"></i>
                                        </button>
                                        @error('password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Konfirmasi Password -->
                                <div class="col-md-6 mb-3" x-data="{ show: false }">
                                    <label class="form-label">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <input :type="show ? 'text' : 'password'" wire:model.live.debounce.300ms="password_confirmation"
                                            class="form-control {{ $password_confirmation ? ($passwordMatch ? 'is-valid' : 'is-invalid') : '' }}">
                                        <button type="button" class="btn btn-outline-secondary" @click="show = !show">
                                            <i :class="show ? 'ri-eye-off-line' : 'ri-eye-line'"></i>
                                        </button>
                                    </div>

                                    @if ($password_confirmation)
                                        @if ($passwordMatch)
                                            <div class="valid-feedback d-block">Password cocok ✔</div>
                                        @else
                                            <div class="invalid-feedback d-block">Password tidak cocok ✖</div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <x-footer></x-footer>

        <!-- Sidebar Menu Overlay-->
        <div class="menu-overlay-bg"></div>
        <!-- / Sidebar Menu Overlay-->

    </section>
    <!-- / Content-->

</main>
<!-- /Page Content -->
