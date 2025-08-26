<!-- Page Content -->
<main id="main">

    <!-- Breadcrumbs-->
    <div class="bg-white border-bottom py-3 mb-2">
        <div class="container-fluid d-flex justify-content-between align-items-start align-items-md-center flex-column flex-md-row">
            <nav class="mb-0" aria-label="breadcrumb">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Grafik</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-end align-items-center mt-3 mt-md-0">
                <a class="btn btn-sm btn-secondary-faded ms-2 text-body d-none" href="#"><i class="ri-question-line align-bottom"></i> Help</a>
            </div>
        </div>
    </div> <!-- / Breadcrumbs-->

    <!-- Content-->
    <section class="container-fluid">
        <div class="row">
            <!-- Chart Survey-->
            <div class="col-12 col-md-4 d-none">
                <div class="card">
                    <div class="card-body">
                        <div class="chart chart-lg">
                            <canvas id="surveys_chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Chart Survey Pendaftaran-->
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="chart chart-lg">
                            <canvas id="pendaftaranChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Chart Survey Pembatalan-->
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="chart chart-lg">
                            <canvas id="pembatalanChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Chart Survey Pelimpahan-->
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="chart chart-lg">
                            <canvas id="pelimpahanChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Chart Surat-->
            <style>
                #surat_chart {
                    width: 100% !important;
                    height: 280px !important;
                    /* bisa diubah sesuai kebutuhan */
                }
            </style>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="chart chart-lg">
                            <canvas id="surat_chart"></canvas>
                        </div>
                    </div>
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
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
        const chartPie = document.querySelector('#surveys_chart');
        const data = {
            labels: [
                'Puas',
                'Tidak Puas',
            ],
            datasets: [{
                // label: 'My First Dataset',
                data: [{{ $surveys_puas }}, {{ $surveys_tidak_puas }}],
                backgroundColor: [
                    'rgb(75, 192, 75)',
                    'rgb(255, 99, 132)',
                ],
                hoverOffset: 4
            }]
        };
        if (chartPie) {
            new Chart(chartPie, {
                type: 'doughnut',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // biar tinggi ikut CSS
                    plugins: {
                        datalabels: {
                            color: 'black',
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            formatter: (value, context) => {
                                const label = context.chart.data.labels[context.dataIndex];
                                const total = context.chart.data.datasets[0].data
                                    .reduce((sum, val) => sum + val, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                // contoh output: Puas: 90 (75.0%)
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        },
                        title: {
                            display: true,
                            text: ['Grafik Survey Kepuasan', 'Total Survey: ' + {{ $jumlah_survey }}],
                            font: {
                                size: 16
                            }
                        },
                    }
                },
                plugins: [ChartDataLabels]
            });
        }
    </script>
    {{-- Chart Pendaftaran --}}
    <script>
        const pendaftaranChart = document.querySelector('#pendaftaranChart');
        const datapendaftaranChart = {
            labels: [
                'Puas',
                'Tidak Puas',
            ],
            datasets: [{
                // label: 'My First Dataset',
                data: [{{ $pendaftaran_puas }}, {{ $pendaftaran_tidak_puas }}],
                backgroundColor: [
                    'rgb(75, 192, 75)',
                    'rgb(255, 99, 132)',
                ],
                hoverOffset: 4
            }]
        };
        if (pendaftaranChart) {
            new Chart(pendaftaranChart, {
                type: 'doughnut',
                data: datapendaftaranChart,
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // biar tinggi ikut CSS
                    plugins: {
                        datalabels: {
                            color: 'black',
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            formatter: (value, context) => {
                                const labelpendaftaran = context.chart.data.labels[context.dataIndex];
                                const totalpendaftaran = context.chart.data.datasets[0].data
                                    .reduce((sum, val) => sum + val, 0);
                                const percentagependaftaran = ((value / totalpendaftaran) * 100).toFixed(1);
                                // contoh output: Puas: 90 (75.0%)
                                return `${labelpendaftaran}: ${value} (${percentagependaftaran}%)`;
                            }
                        },
                        title: {
                            display: true,
                            text: ['Survey Kepuasan Layanan', 'Pendaftaran Haji', 'Total Survey: ' + {{ $pendaftaran_total }}],
                            font: {
                                size: 16
                            }
                        },
                    }
                },
                plugins: [ChartDataLabels]
            });
        }
    </script>
    {{-- Chart Pembatalan --}}
    <script>
        const pembatalanChart = document.querySelector('#pembatalanChart');
        const datapembatalanChart = {
            labels: [
                'Puas',
                'Tidak Puas',
            ],
            datasets: [{
                // label: 'My First Dataset',
                data: [{{ $pembatalan_puas }}, {{ $pembatalan_tidak_puas }}],
                backgroundColor: [
                    'rgb(75, 192, 75)',
                    'rgb(255, 99, 132)',
                ],
                hoverOffset: 4
            }]
        };
        if (pembatalanChart) {
            new Chart(pembatalanChart, {
                type: 'doughnut',
                data: datapembatalanChart,
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // biar tinggi ikut CSS
                    plugins: {
                        datalabels: {
                            color: 'black',
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            formatter: (value, context) => {
                                const labelpembatalan = context.chart.data.labels[context.dataIndex];
                                const totalpembatalan = context.chart.data.datasets[0].data
                                    .reduce((sum, val) => sum + val, 0);
                                const percentagepembatalan = ((value / totalpembatalan) * 100).toFixed(1);
                                // contoh output: Puas: 90 (75.0%)
                                return `${labelpembatalan}: ${value} (${percentagepembatalan}%)`;
                            }
                        },
                        title: {
                            display: true,
                            text: ['Survey Kepuasan Layanan', 'Pembatalan', 'Total Survey: ' + {{ $pembatalan_total }}],
                            font: {
                                size: 16
                            }
                        },
                    }
                },
                plugins: [ChartDataLabels]
            });
        }
    </script>
    {{-- Chart pelimpahan --}}
    <script>
        const pelimpahanChart = document.querySelector('#pelimpahanChart');
        const datapelimpahanChart = {
            labels: [
                'Puas',
                'Tidak Puas',
            ],
            datasets: [{
                // label: 'My First Dataset',
                data: [{{ $pelimpahan_puas }}, {{ $pelimpahan_tidak_puas }}],
                backgroundColor: [
                    'rgb(75, 192, 75)',
                    'rgb(255, 99, 132)',
                ],
                hoverOffset: 4
            }]
        };
        if (pelimpahanChart) {
            new Chart(pelimpahanChart, {
                type: 'doughnut',
                data: datapelimpahanChart,
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // biar tinggi ikut CSS
                    plugins: {
                        datalabels: {
                            color: 'black',
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            formatter: (value, context) => {
                                const label = context.chart.data.labels[context.dataIndex];
                                const total = context.chart.data.datasets[0].data
                                    .reduce((sum, val) => sum + val, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                // contoh output: Puas: 90 (75.0%)
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        },
                        title: {
                            display: true,
                            text: ['Survey Kepuasan Layanan', 'Pelimpahan Porsi Haji', 'Total Survey: ' + {{ $pelimpahan_total }}],
                            font: {
                                size: 16
                            }
                        },
                    }
                },
                plugins: [ChartDataLabels]
            });
        }
    </script>
    <script>
        const surat_chart = document.querySelector('#surat_chart');
        const datasurat_chart = {
            labels: ['Surat Pelimpahan', 'Surat Pembatalan'],
            datasets: [{
                label: 'Surat',
                data: [{{ $jumlah_pelimpahan }}, {{ $jumlah_pembatalan }}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                ],
                borderWidth: 1
            }]
        };
        if (surat_chart) {
            new Chart(surat_chart, {
                type: 'bar',
                data: datasurat_chart,
                options: {
                    responsive: true,
                    // maintainAspectRatio: false, // biar tinggi ikut CSS
                    // scales: {
                    //     y: {
                    //         beginAtZero: true
                    //     }
                    // },
                    plugins: {
                        legend: {
                            display: false
                        },
                        datalabels: {
                            color: 'black',
                            font: {
                                size: 10,
                                weight: 'bold'
                            },
                            formatter: (value, context) => {
                                const label = context.chart.data.labels[context.dataIndex];
                                return `${label}: ${value}`;
                            }
                        },
                        title: {
                            display: true,
                            text: ['Grafik Surat', 'Total Surat: ' + {{ $jumlah_surat }}],
                            font: {
                                size: 13
                            }
                        },
                    }
                },
                plugins: [ChartDataLabels]
            });
        }
    </script>
@endpush

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
