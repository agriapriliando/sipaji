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
                <a class="btn btn-sm btn-primary d-none" href="{{ route('home') }}"><i class="ri-add-circle-line align-bottom"></i> Ajuan
                    Baru</a>
                <a class="btn btn-sm btn-secondary-faded ms-2 text-body d-none" href="#"><i class="ri-question-line align-bottom"></i> Help</a>
            </div>
        </div>
    </div> <!-- / Breadcrumbs-->

    <!-- Content-->
    <section class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Formulir Pembatalan -->
                <div class="card mb-4" x-data="{ informasi: 'pendaftaran' }">
                    <div class="card-header align-items-center d-flex">
                        <button class="btn btn-primary me-2 mb-2" type="button" @click="informasi = 'pendaftaran'" wire:click="loadData(1)">Pendaftaran</button>
                        <button class="btn btn-primary me-2 mb-2" type="button" @click="informasi = 'pembatalan'" wire:click="loadData(2)">Pembatalan</button>
                        <button class="btn btn-primary me-2 mb-2" type="button" @click="informasi = 'pelimpahan'" wire:click="loadData(3)">Pelimpahan</button>
                    </div>
                    <div class="card-body">
                        @if ($openform == true)
                            <h3 class="card-title m-0" x-text="informasi"></h3>
                            <form wire:submit.prevent="update" enctype="multipart/form-data">
                                <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true" x-on:livewire-upload-finish="uploading = false"
                                    x-on:livewire-upload-cancel="uploading = false" x-on:livewire-upload-error="uploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <!-- judul_informasi -->
                                    <div class="mb-3 row">
                                        <label for="judul_informasi" class="col-sm-3 col-form-label">Judul</label>
                                        <div class="col-sm-9">
                                            <input type="text" wire:model.live.debounce.300ms="judul_informasi" class="form-control" id="judul_informasi"
                                                placeholder="Masukkan judul_informasi Lengkap">
                                            @error('judul_informasi')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Isi -->
                                    <div class="mb-3 row">
                                        <label for="isi" class="col-sm-3 col-form-label">Isi</label>
                                        <div class="col-sm-9">
                                            <textarea wire:model.live.debounce.300ms="isi" class="form-control" id="isi" placeholder="Masukkan isi informasi" rows="4"></textarea>
                                            @error('isi')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Upload Gambar -->
                                    <div class="mb-3 row">
                                        <label for="gambar" class="col-sm-3 col-form-label">Upload Gambar</label>
                                        <div class="col-sm-9">
                                            <input type="file" wire:model="gambar" class="form-control" id="gambar">
                                            @error('gambar')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror

                                            <!-- Progress Bar dgn persen -->
                                            <div x-show="uploading" class="mt-2">
                                                <div class="progress" style="height:10px;">
                                                    <div class="progress-bar" role="progressbar" x-bind:style="`width: ${Math.round(progress)}%`" x-text="Math.round(progress) + '%'" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <small class="text-muted d-block mt-1" x-text="Math.round(progress) + '% uploaded'"></small>
                                            </div>

                                            {{-- Preview jika sudah ada file --}}
                                            @if ($gambar)
                                                <div class="mt-2">
                                                    <img src="{{ $gambar->temporaryUrl() }}" class="img-thumbnail" width="200">
                                                </div>
                                            @endif

                                            @if ($existing_gambar)
                                                <div class="mt-2">
                                                    <img src="{{ url('storage/' . $existing_gambar) }}" class="img-thumbnail" width="200">
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Tombol Submit -->
                                    <div class="row">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" class="btn btn-primary" :disabled="uploading" wire:loading.attr="disabled" wire:target="update,gambar">
                                                Simpan Informasi
                                            </button>
                                            <div wire:loading wire:target="update,gambar" class="spinner-border spinner-border-sm ms-2" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <span wire:loading wire:target="save">Silahkan Tunggu...</span>
                                        </div>
                                    </div>
                            </form>
                        @endif

                        @if (session()->has('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /Formulir Pembatalan -->
            </div>
        </div>

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

@push('scriptsatas')
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('') }}assets/css/libs.bundle.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('') }}assets/css/theme.bundle.css" />
@endpush

@push('scriptsbawah')
    <!-- Theme JS -->
    <!-- Vendor JS -->
    <script src="{{ asset('') }}assets/js/vendor.bundle.js"></script>

    <!-- Theme JS -->
    <script src="{{ asset('') }}assets/js/theme.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush
