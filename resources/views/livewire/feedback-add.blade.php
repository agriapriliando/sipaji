<!-- Page Content -->
<main id="main">

    <!-- Breadcrumbs-->
    <div class="bg-white border-bottom py-3 mb-2">
        <div class="container-fluid d-flex justify-content-between align-items-start align-items-md-center flex-column flex-md-row">
            <nav class="mb-0" aria-label="breadcrumb">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Data Surat</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-end align-items-center mt-3 mt-md-0">
                <a class="btn btn-sm btn-primary" href="{{ route('home') }}" wire:navigate><i class="ri-add-circle-line align-bottom"></i> Ajuan
                    Baru</a>
                <a class="btn btn-sm btn-secondary-faded ms-2 text-body d-none" href="#"><i class="ri-question-line align-bottom"></i> Help</a>
            </div>
        </div>
    </div> <!-- / Breadcrumbs-->

    <!-- Content-->
    <section class="container-fluid">
        <!-- Formulir Pembatalan -->
        <div class="card mb-4">
            <div class="card-header justify-content-between align-items-center d-flex">
                <h3 class="card-title m-0">Sampaikan Kritik dan Saran</h3>
                <a onclick="window.history.back();" class="btn btn-sm btn-success"><i class="ri-arrow-go-back-line"></i> Kembali</a>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save">

                    <!-- Nama -->
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" wire:model.live.debounce.300ms="nama" class="form-control" id="nama" placeholder="Masukkan Nama Lengkap">
                            @error('nama')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Nomor HP -->
                    <div class="mb-3 row">
                        <label for="nomorHp" class="col-sm-3 col-form-label">Nomor HP</label>
                        <div class="col-sm-9">
                            <input type="tel" wire:model="nomor_hp" class="form-control" id="nomorHp" placeholder="Masukkan Nomor HP">
                            @error('nomor_hp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Kritik / Saran -->
                    <div class="mb-3 row">
                        <label for="pesan" class="col-sm-3 col-form-label">Kritik / Saran</label>
                        <div class="col-sm-9">
                            <textarea wire:model="pesan" class="form-control" id="pesan" rows="3" placeholder="Masukkan Kritik Saran"></textarea>
                            @error('pesan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="row">
                        <div class="offset-sm-3 col-sm-9">
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">Kirim Kritik dan Saran</button>
                            <div wire:loading wire:target="save" class="spinner-border spinner-border-sm ms-2" role="status">
                                <span class="visually-hidden"></span>
                            </div>
                            <span wire:loading wire:target="save">Silahkan Tunggu...</span>
                        </div>
                    </div>
                </form>

                @if (session()->has('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
        <!-- /Formulir Pembatalan -->

        <!-- Page Title-->
        <div class="d-none">
            <h2 class="fs-3 fw-bold mb-2">Welcome back, Patricia Smith 👋</h2>
            <p class="text-muted mb-5">Get a quick overview of your company's current status below, or click into
                one of
                the sections for a more detailed breakdown.</p>
        </div>
        <!-- / Page Title-->

        <x-footer></x-footer>

        <!-- Sidebar Menu Overlay-->
        <div class="menu-overlay-bg"></div>
        <!-- / Sidebar Menu Overlay-->

    </section>
    <!-- / Content-->

</main>
<!-- /Page Content -->
