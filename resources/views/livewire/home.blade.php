<!-- Page Content -->
<main id="main">

    <!-- Breadcrumbs-->
    <div class="bg-white border-bottom py-3 mb-2">
        <div class="container-fluid d-flex justify-content-between align-items-start align-items-md-center flex-column flex-md-row">
            <nav class="mb-0" aria-label="breadcrumb">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
        <div class="card">
            <div class="card-body row">
                <div class="col-md-6">
                    <select class="form-select" wire:model.live="jenissurat">
                        <option>Pilih Jenis Surat</option>
                        <option value="pelimpahan">Surat Pelimpahan</option>
                        <option value="pembatalan">Surat Pembatalan</option>
                    </select>
                </div>
            </div>
        </div>

        @if ($jenissurat == 'pembatalan')
            <!-- Formulir Pembatalan -->
            <div class="card mb-4">
                <div class="card-header justify-content-between align-items-center d-flex">
                    <h3 class="card-title m-0">Formulir Surat Pembatalan</h3>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="submitPembatalan">
                        <!-- Nomor Porsi Haji -->
                        <div class="mb-3 row">
                            <label for="nomor_porsi" class="col-sm-3 col-form-label">Nomor Porsi Haji</label>
                            <div class="col-sm-9">
                                <input type="text" wire:model.live.debounce.300ms="nomor_porsi" class="form-control @error('nomor_porsi') is-invalid @enderror" id="nomor_porsi"
                                    placeholder="Masukkan Nomor Porsi Haji">
                                @error('nomor_porsi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Nama -->
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" wire:model.live.debounce.300ms="nama" class="form-control" id="nama" placeholder="Masukkan Nama Lengkap">
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Bin/Binti -->
                        <div class="mb-3 row">
                            <label for="bin_binti" class="col-sm-3 col-form-label">Bin / Binti</label>
                            <div class="col-sm-9">
                                <input type="text" wire:model="bin_binti" class="form-control" id="binBinti" placeholder="Masukkan Bin/Binti">
                            </div>
                        </div>

                        <!-- Tempat, Tanggal Lahir -->
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Tempat, Tanggal Lahir</label>
                            <div class="col-sm-9 row">
                                <div class="col-md-6">
                                    <input type="text" wire:model="ttl_tempat" class="form-control" id="ttl_tempat" placeholder="Masukkan Tempat Lahir">
                                    @error('ttl_tempat')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="date" wire:model="ttl_tanggal" class="form-control" id="ttl_tanggal">
                                    @error('ttl_tanggal')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Pekerjaan -->
                        <div class="mb-3 row">
                            <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
                            <div class="col-sm-9">
                                <input type="text" wire:model="pekerjaan" class="form-control" id="pekerjaan" placeholder="Masukkan Pekerjaan">
                                @error('pekerjaan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3 row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea wire:model="alamat" class="form-control" id="alamat" rows="3" placeholder="Masukkan Alamat Lengkap"></textarea>
                                @error('alamat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Alasan Pembatalan -->
                        <div class="mb-3 row">
                            <label for="alasan_pembatalan" class="col-sm-3 col-form-label">Alasan Pembatalan</label>
                            <div class="col-sm-9">
                                <textarea wire:model="alasan_pembatalan" class="form-control" id="alasan_pembatalan" rows="3" placeholder="Masukkan Alasan Pembatalan"></textarea>
                                @error('alasan_pembatalan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="row">
                            <div class="offset-sm-3 col-sm-9">
                                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">Cetak Surat Pembatalan</button>
                                <div wire:loading wire:target="submitPembatalan" class="spinner-border spinner-border-sm ms-2" role="status">
                                    <span class="visually-hidden"></span>
                                </div>
                                <span wire:loading wire:target="submitPembatalan">Silahkan Tunggu...</span>
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
        @endif

        @if ($jenissurat == 'pelimpahan')
            <!-- Formulir Pelimpahan -->
            <div class="card mb-4">
                <div class="card-header justify-content-between align-items-center d-flex">
                    <h3 class="card-title m-0">Formulir Pelimpahan</h3>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="submitPelimpahan">
                        <!-- Nomor Porsi Haji -->
                        <div class="mb-3 row">
                            <label for="nomor_porsi" class="col-sm-3 col-form-label">Nomor Porsi Haji</label>
                            <div class="col-sm-9">
                                <input type="text" wire:model="nomor_porsi" class="form-control" id="nomor_porsi" placeholder="Masukkan Nomor Porsi Haji">
                                @error('nomor_porsi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Nama Asal -->
                        <div class="mb-3 row">
                            <label for="namaAsal" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" wire:model="nama_asal" class="form-control" id="namaAsal" placeholder="Masukkan Nama Lengkap">
                                @error('nama_asal')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Bin/Binti Asal -->
                        <div class="mb-3 row">
                            <label for="bin_binti_asal" class="col-sm-3 col-form-label">Bin / Binti</label>
                            <div class="col-sm-9">
                                <input type="text" wire:model="bin_binti_asal" class="form-control" id="bin_binti_asal" placeholder="Masukkan Bin/Binti">
                                @error('bin_binti_asal')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <!-- Nama Penerima Pelimpahan -->
                        <div class="mb-3 row">
                            <label for="namaPenerima" class="col-sm-3 col-form-label">Nama Penerima</label>
                            <div class="col-sm-9">
                                <input type="text" wire:model="nama_penerima" class="form-control" id="namaPenerima" placeholder="Masukkan Nama Penerima">
                                @error('nama_penerima')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Bin/Binti Penerima -->
                        <div class="mb-3 row">
                            <label for="binBintiPenerima" class="col-sm-3 col-form-label">Bin/Binti Penerima</label>
                            <div class="col-sm-9">
                                <input type="text" wire:model="bin_binti_penerima" class="form-control" id="binBintiPenerima" placeholder="Masukkan Bin/Binti Penerima">
                                @error('bin_binti_penerima')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Tempat, Tanggal Lahir -->
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Tempat, Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <input type="text" wire:model="ttl_tempat" class="form-control" id="tempatLahir" placeholder="Masukkan Tempat Lahir">
                                        @error('ttl_tempat')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" wire:model="ttl_tanggal" class="form-control" id="tanggalLahir">
                                        @error('ttl_tanggal')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pekerjaan -->
                        <div class="mb-3 row">
                            <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
                            <div class="col-sm-9">
                                <input type="text" wire:model="pekerjaan" class="form-control" id="pekerjaan" placeholder="Masukkan Pekerjaan">
                                @error('pekerjaan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3 row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea wire:model="alamat" class="form-control" id="alamat" rows="3" placeholder="Masukkan Alamat Lengkap"></textarea>
                                @error('alamat')
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

                        <!-- Alasan Pelimpahan -->
                        <div class="mb-3 row">
                            <label for="alasan_pelimpahan" class="col-sm-3 col-form-label">Alasan Pelimpahan</label>
                            <div class="col-sm-9">
                                <input type="text" wire:model="alasan_pelimpahan" class="form-control" id="alasan_pelimpahan" placeholder="Cantumkan Alasan Pelimpahan secara detail">
                                @error('alasan_pelimpahan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Jenis Persyaratan -->
                        <div class="mb-3 row">
                            <label for="alasan" class="col-sm-3 col-form-label">Jenis Persyaratan</label>
                            <div class="col-sm-9">
                                <select wire:model="jenis_persyaratan" class="form-select" id="alasan">
                                    <option value="">Pilih Alasan</option>
                                    <option value="Meninggal Dunia">Meninggal Dunia</option>
                                    <option value="Sakit Permanen">Sakit Permanen</option>
                                </select>
                                @error('jenis_persyaratan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="row">
                            <div class="offset-sm-3 col-sm-9">
                                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">Cetak Surat Pelimpahan</button>
                                <div wire:loading wire:target="submitPelimpahan" class="spinner-border spinner-border-sm ms-2" role="status">
                                    <span class="visually-hidden"></span>
                                </div>
                                <span wire:loading wire:target="submitPelimpahan">Silahkan Tunggu...</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Formulir Pelimpahan -->
        @endif

        <!-- Page Title-->
        <div class="d-none">
            <h2 class="fs-3 fw-bold mb-2">Welcome back, Patricia Smith 👋</h2>
            <p class="text-muted mb-5">Get a quick overview of your company's current status below, or click into
                one of
                the sections for a more detailed breakdown.</p>
        </div>
        <!-- / Page Title-->

        <!-- Footer -->
        <footer class="  footer">
            <p class="small text-muted m-0">All rights reserved | © 2021</p>
            <p class="small text-muted m-0">Template created by <a href="https://www.pixelrocket.store/">PixelRocket</a></p>
        </footer>


        <!-- Sidebar Menu Overlay-->
        <div class="menu-overlay-bg"></div>
        <!-- / Sidebar Menu Overlay-->

    </section>
    <!-- / Content-->

</main>
<!-- /Page Content -->
