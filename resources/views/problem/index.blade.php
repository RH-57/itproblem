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
                    <span><a href="{{route('dashboard.index')}}">Dashboard</a> > Laporan</span>
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2 class="mb-4">Laporan Kerusakan</h6>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProblemModal">Tambah Laporan</button>
                            </div>
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">Tgl. Kejadian</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Cabang</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Laporan</th>
                                        <th scope="col">By.</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($reports as $report)
                                    <tr>
                                        <td>{{$report->report_date}}</td>
                                        <td>{{$report->category->name}}</td>
                                        <td>{{$report->branch->code}}</td>
                                        <td>{{$report->user}}</td>
                                        <td>{{Str::limit($report->detail_report, 17)}}</td>
                                        <td>{{$report->by}}</td>
                                        <td>
                                            <form onsubmit="return confirm('Apakah Anda Yakin?')" action="{{ route('problems.destroy', $report->id)}}" method="POST">
                                            <a href="{{ route('problems.show', $report->id )}}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <div class="alert alert-danger">
                                        Data Cabang Belum tersedia
                                    </div>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $reports->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Modal -->
            <div class="modal fade" id="addProblemModal" tabindex="-1" aria-labelledby="addProblemModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content bg-secondary">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProblemModalLabel">Tambah Data Laporan</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addProblemForm" action="{{ route('problems.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-3">
                                        <label for="name" class="form-label"><strong>Tgl. Kejadian</strong></label>
                                        <div class="input-group p-2">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                                            <input type="text" class="form-control datepicker1" name="report_date" value="" id="dateInput" aria-describedby="basic-addon1" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="name" class="form-label"><strong>Kategori</strong></label>
                                        <select class="form-select" id="category" name="category_id" aria-label="Default select example">
                                            <option value="" selected disabled>Pilih Kategori</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="subcategory" class="form-label"><strong>Sub-Kategori</strong></label>
                                        <select class="form-select" id="subcategory" name="subcategory_id" aria-label="Default select example">
                                            <option selected value="" disabled>Pilih Sub-Kategori</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="subsubcategory" class="form-label"><strong>Sub-Sub-Kategori</strong></label>
                                        <select class="form-select" id="subsubcategory" name="subsubcategory_id" aria-label="Default select example">
                                            <option selected value="" disabled>Pilih Sub-Sub-Kategori</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="branch" class="form-label"><strong>Cabang</strong></label>
                                        <select class="form-select" id="branch" name="branch_id" aria-label="Default select example">
                                            <option value="" selected disabled>Pilih Cabang</option>
                                            @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="user" class="form-label"><strong>User</strong></label>
                                        <input type="text" class="form-control" name="user" required>
                                    </div>
                                    <div class="col">
                                        <label for="by" class="form-label"><strong>By.</strong></label>
                                        <input type="text" class="form-control" name="by" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="detail_report" class="form-label"><strong>Laporan</strong></label>
                                        <textarea class="form-control" rows="2" name="detail_report" id=""></textarea>
                                    </div>
                                    <div class="col">
                                        <label for="cause" class="form-label"><strong>Masalah</strong></label>
                                        <textarea class="form-control" rows="2" name="cause" id=""></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="solution" class="form-label"><strong>Solusi</strong></label>
                                        <textarea class="form-control" rows="2" name="solution" id=""></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="finish_date" class="form-label"><strong>Tgl. Selesai</strong></label>
                                        <div class="input-group p-2">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                                            <input type="text" class="form-control datepicker2" name="finish_date" value="" id="dateInput" aria-describedby="basic-addon1" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
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
            $('.datepicker1').datepicker({
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Ambil elemen input tanggal
            const reportDateInput = document.querySelector('.datepicker1');
            const finishDateInput = document.querySelector('.datepicker2');

            // Saat nilai di report_date berubah, set nilai di finish_date
            reportDateInput.addEventListener('change', function () {
                finishDateInput.value = this.value;
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('.datepicker2').datepicker({
                format: 'yyyy-mm-dd', // Format tanggal
                autoclose: true,
                todayHighlight: true,
                orientation: 'up'
            });

            const today = new Date();
            const formattedDate = today.toISOString().split('T')[0];
            document.querySelector('.datepicker').value = formattedDate;
        });
    </script>
    <script>
        document.querySelector('#category').addEventListener('change', function () {
            const categoryId = this.value;
            const subCategorySelect = document.querySelector('#subcategory');

            // Reset subcategory and subsubcategory fields
            subCategorySelect.innerHTML = '<option value="">Pilih Sub-Kategori</option>';
            document.querySelector('#subsubcategory').innerHTML = '<option value="">Pilih Sub-SubKategori</option>';

            if (categoryId) {
                fetch(`/getSubCategories/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(subCategory => {
                            const option = document.createElement('option');
                            option.value = subCategory.id;
                            option.textContent = subCategory.name;
                            subCategorySelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching subcategories:', error);
                        alert('Gagal memuat sub-kategori. Silakan coba lagi.');
                    });
            }
        });

        document.querySelector('#subcategory').addEventListener('change', function () {
            const subCategoryId = this.value;
            const subSubCategorySelect = document.querySelector('#subsubcategory');

            // Reset subsubcategory field
            subSubCategorySelect.innerHTML = '<option value="">Pilih Sub-Sub-Kategori</option>';

            if (subCategoryId) {
                fetch(`/getSubSubCategories/${subCategoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(subSubCategory => {
                            const option = document.createElement('option');
                            option.value = subSubCategory.id;
                            option.textContent = subSubCategory.name;
                            subSubCategorySelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching sub-subcategories:', error);
                        alert('Gagal memuat sub-subkategori. Silakan coba lagi.');
                    });
            }
        });
    </script>
</body>
</html>
