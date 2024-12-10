<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="{{route('dashboard.index')}}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-white"><i class="fa fa-edit me-2"></i>IT-REPORTS</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="ms-3">
                <span>{{ Auth::user()->name }}</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{route('dashboard.index')}}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Master</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('branches.index')}}" class="dropdown-item">Cabang</a>
                    <a href="{{ route('categories.index')}}" class="dropdown-item">Kategori</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Reports</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{route('problems.index')}}" class="dropdown-item">Kerusakan</a>
                    <a href="#" class="dropdown-item">MRTG <i>(Soon)</i></a>
                </div>
            </div>
            <!--<a href="{{route('problems.index')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Permasalahan</a> -->
        </div>
    </nav>
</div>
<!-- Sidebar End -->
