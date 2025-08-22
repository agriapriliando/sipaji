<!-- Page Content -->
<main id="main" x-data="{
    copyTable() {
        let rows = Array.from(document.querySelectorAll('#table-data tr'));
        let text = rows.map(row => {
            // Ambil hanya data dari <td> (atau <th> kalau mau)
            return Array.from(row.querySelectorAll('th,td'))
                .map(cell => cell.innerText)
                .join('\t'); // Tab sebagai pemisah kolom
        }).join('\n'); // Enter sebagai pemisah baris

        // Copy ke clipboard
        navigator.clipboard.writeText(text).then(() => {
            alert('Data tabel berhasil disalin!');
        });
    }
}">
    <style>
        td {
            white-space: nowrap;
        }
    </style>
    <!-- Breadcrumbs-->
    <div class="bg-white border-bottom py-3 mb-2">
        <div class="container-fluid d-flex justify-content-between align-items-start align-items-md-center flex-column flex-md-row">
            <nav class="mb-0" aria-label="breadcrumb">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar Kritik Saran</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-end align-items-center mt-3 mt-md-0">
                <a class="btn btn-sm btn-primary" href="{{ route('home') }}" ><i class="ri-add-circle-line align-bottom"></i> Ajuan
                    Baru</a>
                <a class="btn btn-sm btn-secondary-faded ms-2 text-body d-none" href="#"><i class="ri-question-line align-bottom"></i> Help</a>
                <a class="btn btn-outline-primary btn-sm text-body ms-2" @click="copyTable"><i class="ri-file-copy-fill"></i> Copy</a>
            </div>
        </div>
    </div> <!-- / Breadcrumbs-->

    <!-- Content-->
    <section class="container-fluid">
        <!-- Middle Row Widgets-->
        <div class="row mb-4 mt-0">
            <!-- Tabel Pembatalan-->
            <div class="col-12 mb-3">
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
                <div class="card mb-4 h-100">
                    <div class="card-header justify-content-between align-items-center d-md-flex">
                        <h6 class="card-title mb-2">Daftar Kritik dan Saran</h6>
                        <div class="d-flex">
                            <!-- Search Bar-->
                            <select wire:model.live="perPage" class="form-select" id="" style="width: 90px;">
                                <option value="5">5 Item</option>
                                <option value="20">20 Item</option>
                                <option value="{{ $data->total() }}">All {{ $data->total() }} Item</option>
                            </select>
                            <form class="d-flex bg-light rounded px-3 me-2">
                                <input wire:model.live.debounce="search" class="form-control border-0 bg-transparent px-0 py-2 me-5 fw-bolder" type="" placeholder="Cari Nama / No HP"
                                    aria-label="Search">
                                <button class="btn btn-link p-0 text-muted" type="submit"><i class="ri-search-2-line"></i></button>
                            </form>
                            <!-- / Search Bar-->
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <div style="overflow-x:auto;">
                                <table class="table mt-3" id="table-data" style="overflow-x: auto;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">No HP</th>
                                            <th scope="col">Pesan</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr x-data="{ open: false }">
                                                <th scope="row">
                                                    {{ ($data->currentPage() - 1) * $data->perPage() + $loop->index + 1 }}
                                                </th>
                                                <td>
                                                    {{ $item->nama }}
                                                </td>
                                                <td>
                                                    {{ $item->nohp }}
                                                </td>
                                                <td style="white-space: wrap !important">
                                                    {{ $item->pesan }}
                                                </td>
                                                <td>
                                                    {{ $item->created_at->translatedFormat('d F Y h:i') }} WIB
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm" @click="open = true" title="Hapus Data">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                    <div style="display: inline; wrap: nowrap;">
                                                        <!-- Modal Konfirmasi -->
                                                        <div x-show="open" x-transition
                                                            style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; z-index: 9999;">
                                                            <div style="background: #fff; padding: 20px 24px; border-radius: 6px; min-width: 220px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.15);"
                                                                @click.away="open = false">
                                                                <div style="margin-bottom: 16px; font-weight: bold;">Yakin ingin menghapus data {{ $item->nama }} ini?</div>
                                                                <button
                                                                    style="background: #dc3545; color: #fff; border: none; padding: 5px 15px; border-radius: 3px; margin-right: 8px; cursor: pointer;"
                                                                    @click="$wire.delete('{{ $item->id }}'); open = false;">Ya, Hapus</button>
                                                                <button style="background: #6c757d; color: #fff; border: none; padding: 5px 15px; border-radius: 3px; cursor: pointer;"
                                                                    @click="open = false">Batal</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tabel Pembatalan-->

        </div>
        <!-- / Middle Row Widgets-->

        <x-footer></x-footer>

        <!-- Sidebar Menu Overlay-->
        <div class="menu-overlay-bg"></div>
        <!-- / Sidebar Menu Overlay-->


    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- / Content-->
</main>
<!-- /Page Content -->
@script
    <script>
        $wire.on('deleted-success', (event) => {
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
