<!-- Page Content -->
<main id="main">

    <!-- Breadcrumbs-->
    <div class="bg-white border-bottom py-3 mb-2 d-none">
        <div class="container-fluid d-flex justify-content-between align-items-start align-items-md-center flex-column flex-md-row">
            <nav class="mb-0" aria-label="breadcrumb">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
    <section class="container-fluid" x-data="{ informasi: '', survey: '' }">
        {{-- toast --}}
        <div class="toast-container position-fixed top-0 start-50 translate-middle-x">
            <div id="liveToast" class="toast mt-3" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto" id="pesan"></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
        {{-- toast --}}
        <div class="row my-2">
            <div class="col-12 d-flex justify-content-center align-items-center text-center">
                <img src="{{ asset('assets/kemenag-logo-192x192.png') }}" width="100" alt="">
                <h2 class="fs-4 fw-bold mb-2">Pusat Layanan Haji dan Umrah Terpadu <br>
                    Kementerian Agama Kabupaten Katingan
                </h2>
            </div>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        <div class="row mb-2">
            <div class="col-6 d-grid mb-1 d-none">
                <a href="{{ route('addkritiksaran') }}" class="btn btn-warning" type="button">Kritik dan Saran</a>
            </div>
            <div class="col-12 d-grid mb-1">
                <button @click="survey = 'terbuka'" class="btn btn-success" type="button" wire:click="resetsurvey()">Surveys</button>
            </div>
        </div>
        @if (session()->has('surveysuccess'))
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('surveysuccess') }}
                <button type="button" class="btn-close" @click="show = false" aria-label="Close"></button>
            </div>
        @endif
        <div x-show="survey == 'terbuka'" class="row" x-transition @click.away="survey = ''">
            <div class="col">
                <form wire:submit.prevent="addSurvey" method="POST" class="survey-form">
                    @csrf

                    {{-- hidden polymorphic target (opsional, kalau mau pakai polymorphic) --}}
                    <input type="hidden" wire:model="target_id" value="homepage">

                    <!-- Pilih Layanan -->
                    <h3 class="survey-title">Survey Kepuasan Pelayanan :</h3>
                    <p class="text-muted">Bantu kami mengisi survey ini agar kami dapat meningkatkan pelayanan</p>
                    <div class="survey-options">
                        <label class="survey-option layanan">
                            <input type="radio" wire:model.live="layanan" value="Pendaftaran Haji" required>
                            <div class="icon">🕌</div>
                            <span>Pendaftaran Haji</span>
                        </label>

                        <label class="survey-option layanan">
                            <input type="radio" wire:model.live="layanan" value="Pembatalan Porsi Haji" required>
                            <div class="icon">❌</div>
                            <span>Pembatalan</span>
                        </label>

                        <label class="survey-option layanan">
                            <input type="radio" wire:model.live="layanan" value="Pelimpahan Porsi Haji" required>
                            <div class="icon">🔄</div>
                            <span>Pelimpahan Porsi Haji</span>
                        </label>
                    </div>
                    @error('layanan')
                        <div class="error">{{ $message }}</div>
                    @enderror

                    <!-- Pilih Kepuasan -->
                    <h3 class="survey-title">Bagaimana tingkat kepuasan Anda?</h3>
                    <div class="survey-options">
                        <label class="survey-option">
                            <input type="radio" wire:model.live="kepuasan" value="puas" required>
                            <div class="icon puas">😊</div>
                            <span>Puas</span>
                        </label>

                        <label class="survey-option">
                            <input type="radio" wire:model.live="kepuasan" value="tidak_puas" required>
                            <div class="icon tidak-puas">😞</div>
                            <span>Tidak Puas</span>
                        </label>
                    </div>
                    @error('kepuasan')
                        <div class="error">{{ $message }}</div>
                    @enderror

                    <!-- Kritik Saran -->
                    <div class="mb-3 row">
                        <label for="kritik_saran">Apakah ada hal lain yang ingin anda sampaikan?</label>
                        <div>
                            <textarea wire:model="kritik_saran" class="form-control" id="kritik_saran" rows="3" placeholder="Masukan Kritik dan Saran Anda"></textarea>
                            @error('kritik_saran')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit -->
                    @if ($kepuasan != '' && $layanan != '')
                        <button type="submit" class="btn-submit" @click="survey = ''">Kirim Surveys</button>
                        <br>
                        <p>Terima Kasih atas waktu dan tanggapan Anda</p>
                    @endif
                </form>

                <style>
                    /* Container Form */
                    .survey-form {
                        max-width: 500px;
                        margin: 15px auto;
                        padding: 15px;
                        border-radius: 12px;
                        background: #fdfdfd;
                        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
                        font-family: Arial, sans-serif;
                        text-align: center;
                    }

                    /* Judul section */
                    .survey-title {
                        margin: 15px 0 10px;
                        font-size: 1rem;
                        font-weight: bold;
                    }

                    /* Wrapper pilihan */
                    .survey-options {
                        display: flex;
                        justify-content: center;
                        gap: 8px;
                        /* jarak antar tombol lebih kecil */
                        margin-bottom: 12px;
                        overflow-x: auto;
                        /* scroll horizontal di mobile */
                        flex-wrap: nowrap;
                        padding-bottom: 5px;
                        scrollbar-width: thin;
                    }

                    /* Tombol pilihan */
                    .survey-option {
                        flex: 0 0 auto;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        cursor: pointer;
                        padding: 6px;
                        border: 2px solid #ddd;
                        border-radius: 8px;
                        width: 85px;
                        /* lebih kecil */
                        transition: all 0.3s ease;
                        font-size: 0.75rem;
                        /* tulisan lebih kecil */
                        background: #fff;
                    }

                    /* Hilangkan radio bawaan */
                    .survey-option input {
                        display: none;
                    }

                    /* Icon lebih kecil */
                    .survey-option .icon {
                        font-size: 1.4rem;
                        /* sebelumnya 1.8rem */
                        margin-bottom: 3px;
                    }

                    /* Warna icon */
                    .survey-option .puas {
                        color: #28a745;
                    }

                    .survey-option .tidak-puas {
                        color: #dc3545;
                    }

                    /* Hover */
                    .survey-option:hover {
                        background: #f8f8f8;
                        border-color: #aaa;
                    }

                    /* Checked */
                    .survey-option input:checked+.icon,
                    .survey-option input:checked+.icon+span {
                        font-weight: bold;
                        color: #202020;
                        border: #424242 2px solid;
                        border-radius: 3px;
                        padding: 2px;
                    }

                    .survey-option input:checked+.icon {
                        padding: 4px;
                        border-radius: 50%;
                    }

                    .survey-option input:checked+.icon.puas {
                        background: #28a745;
                    }

                    .survey-option input:checked+.icon.tidak-puas {
                        background: #dc3545;
                    }

                    /* Error */
                    .error {
                        color: #dc3545;
                        font-size: 0.8rem;
                        margin-bottom: 8px;
                    }

                    /* Tombol submit lebih kecil */
                    .btn-submit {
                        background: #007bff;
                        color: #fff;
                        padding: 6px 15px;
                        border: none;
                        border-radius: 6px;
                        cursor: pointer;
                        font-size: 0.85rem;
                        transition: background 0.3s ease;
                    }

                    .btn-submit:hover {
                        background: #0056b3;
                    }

                    /* Mobile responsive */
                    @media (max-width: 400px) {
                        .survey-option {
                            width: 75px;
                            padding: 5px;
                            font-size: 0.7rem;
                        }

                        .survey-option .icon {
                            font-size: 1.2rem;
                        }

                        .btn-submit {
                            width: 100%;
                            padding: 8px 0;
                        }
                    }
                </style>
            </div>
        </div>
        <div class="card">
            <div class="card-body row">
                <!-- Tombol -->
                <div class="col-md-3 d-grid mb-2">
                    <button class="btn btn-primary" type="button" @click="informasi = 'pendaftaran'">
                        Informasi Pendaftaran Haji
                    </button>
                </div>
                <div class="col-md-3 d-grid mb-2">
                    <button class="btn btn-primary" type="button" @click="informasi = 'pembatalan'">
                        Informasi Pembatalan Nomor Porsi
                    </button>
                </div>
                <div class="col-md-3 d-grid mb-2">
                    <button class="btn btn-primary" type="button" @click="informasi = 'pelimpahan'">
                        Informasi Pelimpahan Nomor Porsi
                    </button>
                </div>

                <!-- Konten -->
                <div class="col-12 mb-3" x-show="informasi === 'pendaftaran'" x-transition>
                    <h3>{{ $informasi[0]['judul_informasi'] }}</h3>
                    <img src="{{ url('storage/' . $informasi[0]['gambar']) }}" class="img-fluid mb-2" alt="">
                    <p>
                        {{ $informasi[0]['isi_informasi'] }}
                    </p>
                    <button class="btn btn-sm btn-warning" type="button" @click="informasi = ''"><i class="ri-close-line"></i> Tutup Informasi</button>
                </div>

                <div class="col-12 mb-3" x-show="informasi === 'pembatalan'" x-transition>
                    <h3>{{ $informasi[1]['judul_informasi'] }}</h3>
                    <img src="{{ url('storage/' . $informasi[1]['gambar']) }}" class="img-fluid mb-2" alt="">
                    <p>
                        {{ $informasi[1]['isi_informasi'] }}
                    </p>
                    <button class="btn btn-sm btn-warning" type="button" @click="informasi = ''"><i class="ri-close-line"></i> Tutup Informasi</button>
                </div>
                <div class="col-12 mb-3" x-show="informasi === 'pelimpahan'" x-transition>
                    <h3>{{ $informasi[2]['judul_informasi'] }}</h3>
                    <img src="{{ url('storage/' . $informasi[2]['gambar']) }}" class="img-fluid mb-2" alt="">
                    <p>
                        {{ $informasi[2]['isi_informasi'] }}
                    </p>
                    <button class="btn btn-sm btn-warning" type="button" @click="informasi = ''"><i class="ri-close-line"></i> Tutup Informasi</button>
                </div>
                <div class="col-md-3 mb-2">
                    <select class="form-select" wire:model.live="jenissurat">
                        <option>Pilih Formulir</option>
                        <option value="pelimpahan">Surat Pelimpahan</option>
                        <option value="pembatalan">Surat Pembatalan</option>
                    </select>
                </div>
            </div>
        </div>
        {{-- modal pop up --}}
        <div>
            @if ($showSurveyModal)
                {{-- Overlay menutup seluruh layar --}}
                <div id="survey-overlay" class="modal-overlay" aria-modal="true" role="dialog" aria-labelledby="surveyTitle">
                    <div class="modal-box">
                        <h2 id="surveyTitle" class="modal-title">Survey Kepuasan Pelayanan</h2>
                        <p class="modal-subtitle">Bantu kami meningkatkan pelayanan dengan menjawab singkat survey ini.</p>

                        <form wire:submit.prevent="addSurvey" class="survey-form">
                            @csrf
                            <input type="hidden" wire:model="target_id" value="homepage">

                            <!-- Pilih Layanan -->
                            <h3 class="survey-section-title">Layanan yang Anda gunakan</h3>
                            <div class="survey-options">
                                <label class="survey-option layanan">
                                    <input type="radio" wire:model.live="layanan" value="Pendaftaran Haji" required>
                                    <div class="icon">🕌</div><span>Pendaftaran Haji</span>
                                </label>
                                <label class="survey-option layanan">
                                    <input type="radio" wire:model.live="layanan" value="Pembatalan Porsi Haji" required>
                                    <div class="icon">❌</div><span>Pembatalan</span>
                                </label>
                                <label class="survey-option layanan">
                                    <input type="radio" wire:model.live="layanan" value="Pelimpahan Porsi Haji" required>
                                    <div class="icon">🔄</div><span>Pelimpahan Porsi Haji</span>
                                </label>
                            </div>
                            @error('layanan')
                                <div class="error">{{ $message }}</div>
                            @enderror

                            <!-- Pilih Kepuasan -->
                            <h3 class="survey-section-title">Tingkat kepuasan Anda</h3>
                            <div class="survey-options">
                                <label class="survey-option">
                                    <input type="radio" wire:model.live="kepuasan" value="puas" required>
                                    <div class="icon puas">😊</div><span>Puas</span>
                                </label>
                                <label class="survey-option">
                                    <input type="radio" wire:model.live="kepuasan" value="tidak_puas" required>
                                    <div class="icon tidak-puas">😞</div><span>Tidak Puas</span>
                                </label>
                            </div>
                            @error('kepuasan')
                                <div class="error">{{ $message }}</div>
                            @enderror

                            <!-- Kritik & Saran -->
                            <label for="kritik_saran" class="survey-section-title">Kritik & Saran (opsional)</label>
                            <textarea wire:model="kritik_saran" id="kritik_saran" rows="3" class="form-control" placeholder="Masukan kritik/saran Anda..."></textarea>
                            @error('kritik_saran')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <!-- Submit -->
                            @if ($kepuasan != '' && $layanan != '')
                                <button type="submit" class="btn-submit" wire:loading.attr="disabled">
                                    Kirim Survey
                                </button>
                            @endif
                        </form>
                    </div>
                </div>

                {{-- Kunci scroll halaman saat modal tampil --}}
                <script>
                    (function lockScroll() {
                        document.documentElement.style.overflow = 'hidden';
                        document.body.style.overflow = 'hidden';
                        document.body.style.height = '100vh';
                    })();
                    window.addEventListener('survey-submitted', () => {
                        document.documentElement.style.overflow = '';
                        document.body.style.overflow = '';
                        document.body.style.height = '';
                    });
                </script>
            @endif
        </div>

        <style>
            /* === Modal Overlay Full Screen (tanpa framework) === */
            .modal-overlay {
                position: fixed;
                inset: 0;
                /* top:0; right:0; bottom:0; left:0 */
                width: 100vw;
                height: 100vh;
                background: rgba(0, 0, 0, .6);
                z-index: 2147483647;
                /* di atas semua elemen */
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 12px;
            }

            @supports (backdrop-filter: blur(4px)) {
                .modal-overlay {
                    backdrop-filter: blur(4px);
                }
            }

            .modal-box {
                background: #fff;
                width: 100%;
                max-width: 560px;
                max-height: 90vh;
                overflow: auto;
                border-radius: 12px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, .25);
                padding: 16px;
            }

            /* Judul/subtitle modal */
            .modal-title {
                margin: 0 0 4px;
                font-size: 20px;
                font-weight: 700;
                text-align: center;
            }

            .modal-subtitle {
                margin: 0 0 12px;
                font-size: 13px;
                color: #666;
                text-align: center;
            }

            /* Form styling (ambil gaya dari milikmu, sederhanakan) */
            .survey-form {
                font-family: Arial, sans-serif;
            }

            .survey-section-title {
                display: block;
                margin: 10px 0 6px;
                font-weight: 700;
                font-size: 14px;
            }

            .survey-options {
                display: flex;
                gap: 8px;
                flex-wrap: wrap;
                margin-bottom: 8px;
            }

            .survey-option {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 4px;
                padding: 8px;
                width: 120px;
                background: #fff;
                border: 2px solid #ddd;
                border-radius: 8px;
                cursor: pointer;
            }

            .survey-option input {
                display: none;
            }

            .survey-option .icon {
                font-size: 22px;
            }

            .survey-option .puas {
                color: #28a745;
            }

            .survey-option .tidak-puas {
                color: #dc3545;
            }

            .survey-option:hover {
                border-color: #888;
                background: #f9f9f9;
            }

            .survey-option input:checked+.icon,
            .survey-option input:checked+.icon+span {
                font-weight: 700;
                color: #202020;
                border: 2px solid #424242;
                border-radius: 4px;
                padding: 2px;
            }

            .form-control {
                width: 100%;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 6px;
                resize: vertical;
                font: inherit;
            }

            .btn-submit {
                width: 100%;
                margin-top: 10px;
                padding: 10px 14px;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                background: #007bff;
                color: #fff;
                font-weight: 700;
            }

            .btn-submit:hover {
                background: #0063cc;
            }

            .error {
                color: #dc3545;
                font-size: 12px;
            }

            /* Lock background click */
            body {
                position: relative;
            }
        </style>
        {{-- modal pop up --}}

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

                        <!-- Jenis Kelamin -->
                        <div class="mb-3 row">
                            <label for="jenisKelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <select wire:model="jenis_kelamin" class="form-select" id="jenisKelamin">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
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

                        <!-- Jenis Kelamin -->
                        <div class="mb-3 row">
                            <label for="jenisKelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <select wire:model="jenis_kelamin" class="form-select" id="jenisKelamin">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
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

        <x-footer></x-footer>

        <!-- Sidebar Menu Overlay-->
        <div class="menu-overlay-bg"></div>
        <!-- / Sidebar Menu Overlay-->

    </section>
    <!-- / Content-->

</main>
<!-- /Page Content -->
@script
    <script>
        $wire.on('survey-success', (event) => {
            var element = document.getElementById('liveToast');
            console.log(event.message);
            const myToast = bootstrap.Toast.getOrCreateInstance(element);
            setTimeout(function() {
                myToast.show();
                document.getElementById('pesan').innerHTML = event.message;
                element.className += " text-bg-success";
                console.log(event.message);
            }, 10);
            setTimeout(function() {
                myToast.hide();
            }, 3000);
        });
    </script>
@endscript

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
