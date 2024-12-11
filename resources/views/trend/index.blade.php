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
    <div class="container-xxl position-relative bg-white d-flex p-0">
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

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <span><a href="{{ route('dashboard.index')}}">Dasboard</a> > Trend</span>
                </div>
            </div>
            <!--
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-file fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Laporan</p>
                                <h6 class="mb-0">{{ $totalReportInYear }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            -->
            <div class="container-fluid pt-2 px-4">
                <div class="row g-4 mb-2">
                    <form class="row g-3" action="{{ route('trend.index') }}" method="GET">
                        <div class="col-auto">
                            <div class="d-flex align-items-center">
                                <label for="year" class="col-form-label me-2">Pilih:</label>
                                <select name="year" id="year" class="form-select" onchange="this.form.submit()">
                                    @for ($year = now()->year - 4; $year <= now()->year; $year++)
                                        <option value="{{ $year }}" @if ($selectedYear == $year) selected @endif>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Trend Kerusakan</h6>
                            </div>
                            <canvas id="trendChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Barang Sering Rusak</h6>
                            </div>
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($frequentSubSubCategories as $index => $subSubCategory)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $subSubCategory->sub_sub_category_name }}</td>
                                            <td>{{ $subSubCategory->total_damage }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">User Sering Lapor</h6>
                            </div>
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama User</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($frequentReporters as $index => $reporter)
                                    <tr>
                                        <td>{{ $index + 1}}</td>
                                        <td>{{$reporter->user_name}} </td>
                                        <td>{{$reporter->total_reports}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Bulan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                        </table>
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
        // Data untuk grafik
        var trendData = @json($trendData); // Data per kategori
        var months = @json(array_map(fn($m) => DateTime::createFromFormat('!m', $m)->format('F'), $months)); // Bulan dalam format teks

        const colors = [
            { borderColor: 'rgba(87, 148, 242, 1)', backgroundColor: 'rgba(87, 148, 242, 0.3)' }, // Warna 1
            { borderColor: 'rgba(0, 128, 0, 1)', backgroundColor: 'rgba(0, 128, 0, 0.3)' }, // Warna 2
            { borderColor: 'rgba(255, 0, 0, 1)', backgroundColor: 'rgba(255, 0, 0, 0.3)' }  // Warna 3
        ];

        // Buat dataset untuk Chart.js
        var datasets = trendData.map((item, index) => ({
            label: item.label,
            data: item.data,
            borderColor: colors[index % colors.length].borderColor, // Pilih warna berdasarkan index
            backgroundColor: colors[index % colors.length].backgroundColor, // Pilih warna berdasarkan index
            borderWidth: 2,
            fill: false,
            tension: 0.1
        }));

        // Render grafik menggunakan Chart.js
        var ctx = document.getElementById('trendChart').getContext('2d');
        var trendChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: datasets
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah Kerusakan'
                        },
                        beginAtZero: true,

                    }
                }
            }
        });
    </script>
</body>
</html>
