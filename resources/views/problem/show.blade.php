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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">

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
            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <span><a href="{{route('dashboard.index')}}">Dashboard</a> > <a href="{{route('problems.index')}}">Laporan</a> > Detail Laporan</span>
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h2 class="mb-4">Detail Laporan</h2>
                            <dl class="row">
                                <dt class="col-sm-3">Tgl. Kejadian</dt>
                                <dd class="col-sm-9">: {{$reports->report_date}}</dd>
                                <dt class="col-sm-3">Kategori</dt>
                                <dd class="col-sm-9">: {{$reports->category->name}}</dd>
                                <dt class="col-sm-3">Sub-Kategori</dt>
                                <dd class="col-sm-9">: {{ $reports->subcategory ? $reports->subcategory->name : 'Tidak Ada Sub-Kategori' }}</dd>
                                <dt class="col-sm-3">Sub-Sub-Kategori</dt>
                                <dd class="col-sm-9">: {{$reports->subSubCategory->name ?? '-'}}</dd>
                                <dt class="col-sm-3">Cabang</dt>
                                <dd class="col-sm-9">: {{$reports->branch->name}}</dd>
                                <dt class="col-sm-3">User</dt>
                                <dd class="col-sm-9">: {{$reports->user}}</dd>
                                <dt class="col-sm-3">Laporan</dt>
                                <dd class="col-sm-9">: {{$reports->detail_report}}</dd>
                                <dt class="col-sm-3">Masalah</dt>
                                <dd class="col-sm-9">: {{$reports->cause}}</dd>
                                <dt class="col-sm-3">Solusi</dt>
                                <dd class="col-sm-9">: {{$reports->solution}}</dd>
                                <dt class="col-sm-3">Tgl. Selesai</dt>
                                <dd class="col-sm-9">: {{$reports->finish_date}}</dd>
                                <dt class="col-sm-3">By</dt>
                                <dd class="col-sm-9">: {{$reports->by}}</dd>
                            </dl>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        document.addEventListener("DOMContentLoaded", function() {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd', // Format tanggal
                autoclose: true,
                todayHighlight: true,
                orientation: 'bottom'
            });

            const today = new Date();
            const formattedDate = today.toISOString().split('T')[0];
            document.querySelector('.datepicker').value = formattedDate;
        });
    </script>
</body>
</html>
