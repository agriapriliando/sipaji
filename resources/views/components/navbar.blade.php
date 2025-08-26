<!-- Navbar-->
<nav class="navbar navbar-expand-lg navbar-light border-bottom py-0 fixed-top bg-white">
    <div class="container-fluid">
        <a class="navbar-brand d-flex justify-content-start align-items-center border-end" href="{{ route('home') }}">
            <div class="d-flex align-items-center">
                <div class="me-2">
                    <img src="{{ asset('assets/kemenag-logo-192x192.png') }}" width="40" alt="">
                </div>
                <span class="fw-black text-uppercase tracking-wide fs-6 lh-1">SIPAJI</span>
            </div>
        </a>
        <div class="d-flex justify-content-between align-items-center flex-grow-1 navbar-actions">

            <!-- Search Bar and Menu Toggle-->
            <div class="d-flex align-items-center">

                <!-- Menu Toggle-->
                <div class="menu-toggle cursor-pointer me-4 text-primary-hover transition-color disable-child-pointer">
                    <!-- Hamburger untuk Close menu -->
                    <i class="ri-menu-line ri-lg fold align-middle" data-bs-toggle="tooltip" data-bs-placement="right" title="Close menu"></i>

                    <!-- Hamburger untuk Open menu -->
                    <i class="ri-menu-line ri-lg unfold align-middle" data-bs-toggle="tooltip" data-bs-placement="right" title="Open Menu"></i>
                </div>
                <!-- / Menu Toggle-->
            </div>
            @if (Auth::user())
                <!-- Right Side Widgets-->
                <div class="d-flex align-items-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm text-white">
                            <i class="ri-logout-box-r-line"></i>
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</nav> <!-- / Navbar-->
