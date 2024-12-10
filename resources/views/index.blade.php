<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>IT-REPORTS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0" style="max-width: 100%; overflow-x: hidden;">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
        @include('partials.sidebar')
        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            @include('partials.header')
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-2 px-2">
                <div class="row g-2">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-file fa-3x text-white"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Total Laporan</p>
                                    <h6 class="mb-0">{{$reportCount}}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-code-branch fa-3x text-white"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Total Cabang</p>
                                    <h6 class="mb-0"> {{ $branchCount }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-table fa-3x text-white"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Total Kategori</p>
                                    <h6 class="mb-0">{{$categoryCount}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- Sale & Revenue End -->

            <div class="container-fluid pt-2 px-2">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary text-center rounded p-3">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Trend Kerusakan</h6>
                                <a class="text-white" href="{{route('trend.index')}}">Lihat Detail</a>
                            </div>
                            <canvas id="trendChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-secondary text-center rounded p-3">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Total Kerusakan by Kategori</h6>
                            </div>
                            <canvas id="damageChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sales Chart Start -->
            <div class="container-fluid pt-2 px-2">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Total Kerusakan by Sub-Kategori</h6>
                            </div>
                            <canvas id="subCategoryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sales Chart End -->

            <div class="container-fluid pt-2 px-2">
                <div class="row g-4">
                    <div class="col">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Total Kerusakan by Sub-Sub-Kategori</h6>
                            </div>
                            <canvas id="subSubCategoryChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid pt-2 px-2">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">User Paling Sering Lapor</h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-white">
                                            <th scope="col">No.</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($mostActiveUser as $index => $item)
                                        <tr>
                                            <td>{{$index + 1}}</td>
                                            <td>{{$item->user}}</td>
                                            <td>{{$item->report_count}}</td>
                                        </tr>
                                        @empty
                                        <div class="alert alert-danger">
                                            Data Item Belum tersedia
                                        </div>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Barang Sering Rusak</h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-white">
                                            <th scope="col">No.</th>
                                            <th scope="col">Nama Barang</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($mostDamagedParts as $index => $item)
                                        <tr>
                                            <td>{{$index + 1}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->total_damage}}</td>
                                        </tr>
                                        @empty
                                        <div class="alert alert-danger">
                                            Data Item Belum tersedia
                                        </div>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Start -->
            @include('partials.footer')
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/chart/chart.min.js')}}"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js')}}"></script>
    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/main.js')}}"></script>
    <script>
        var ctx = document.getElementById('trendChart').getContext('2d');

        // Data dari backend
        var trendData = @json($trendDataByCategory); // Data kategori
        var allYears = @json($allYears); // Semua tahun (x-axis)

        // Warna spesifik untuk dataset
        var predefinedColors = [
            { borderColor: 'rgba(87, 148, 242, 1)', backgroundColor: 'rgba(87, 148, 242, 0.3)' }, // Warna 1
            { borderColor: 'rgba(0, 128, 0, 1)', backgroundColor: 'rgba(0, 128, 0, 0.3)' }, // Warna 2
            { borderColor: 'rgba(255, 0, 0, 1)', backgroundColor: 'rgba(255, 0, 0, 0.3)' }  // Warna 3
        ];

        // Siapkan dataset untuk Chart.js
        var datasets = trendData.map((item, index) => {
            // Gunakan warna berdasarkan urutan dataset
            var colors = predefinedColors[index % predefinedColors.length];

            return {
                label: item.label, // Nama kategori
                data: allYears.map(year => {
                    // Cari nilai kerusakan pada tahun tertentu (atau 0 jika tidak ada data)
                    const index = item.years.indexOf(year);
                    return index !== -1 ? item.data[index] : 0;
                }),
                borderColor: colors.borderColor, // Warna garis dari predefinedColors
                backgroundColor: colors.backgroundColor, // Warna latar belakang dari predefinedColors
                borderWidth: 2,
                fill: false, // Isi area di bawah garis
                tension: 0.1
            };
        });

        var trendChart = new Chart(ctx, {
            type: 'line', // Tipe chart garis
            data: {
                labels: allYears, // Tahun (x-axis)
                datasets: datasets // Dataset untuk setiap kategori
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tahun'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah Kerusakan'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        // Plugin global untuk menampilkan nilai di atas bar
        Chart.register({
            id: 'barValuePlugin',
            afterDatasetsDraw(chart) {
                const {ctx, data} = chart;
                chart.data.datasets.forEach((dataset, datasetIndex) => {
                    const meta = chart.getDatasetMeta(datasetIndex);
                    meta.data.forEach((bar, index) => {
                        const value = dataset.data[index];
                        const x = bar.x;
                        const y = bar.y;

                        // Tampilkan nilai di atas bar
                        ctx.save();
                        ctx.fillStyle = 'white';
                        ctx.textAlign = 'center';
                        ctx.fillText(value, x, y - 5); // Posisi nilai (tepat di atas bar)
                        ctx.restore();
                    });
                });
            }
        });

        // Chart kategori
        var ctxCategory = document.getElementById('damageChart').getContext('2d');
        var categoryChart = new Chart(ctxCategory, {
            type: 'bar',
            data: {
                labels: @json($categoryLabels),
                datasets: [{
                    label: 'Total Kerusakan',
                    data: @json($categoryData),
                    backgroundColor: 'rgba(87, 148, 242, 0.8)',
                    borderColor: 'rgba(87, 148, 242, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', // Membuat chart horizontal
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                    }
                }
            }
        });

        // Chart sub-kategori
        var ctxSubCategory = document.getElementById('subCategoryChart').getContext('2d');
        var subCategoryChart = new Chart(ctxSubCategory, {
            type: 'bar',
            data: {
                labels: @json($subCategoryLabels),
                datasets: [{
                    label: 'Total Kerusakan',
                    data: @json($subCategoryData),
                    backgroundColor: 'rgba(87, 148, 242, 0.8)',
                    borderColor: 'rgba(87, 148, 242, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', // Membuat chart horizontal
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                    }
                }
            }
        });

        // Chart sub-sub-kategori
        var ctxSubSubCategory = document.getElementById('subSubCategoryChart').getContext('2d');
        var subSubCategoryChart = new Chart(ctxSubSubCategory, {
            type: 'bar',
            data: {
                labels: @json($subSubCategoryLabels),
                datasets: [{
                    label: 'Total Kerusakan',
                    data: @json($subSubCategoryData),
                    backgroundColor: 'rgba(87, 148, 242, 0.8)',
                    borderColor: 'rgba(87, 148, 242, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                    }
                }
            }
        });
    </script>
</body>

</html>
