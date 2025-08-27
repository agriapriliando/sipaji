<!-- Page Aside-->
<aside class="aside bg-white">

    <div class="simplebar-wrapper">
        <div data-pixr-simplebar>
            <div class="pb-6">
                <!-- Mobile Logo-->
                <div class="d-flex d-xl-none justify-content-between align-items-center border-bottom aside-header">
                    <a class="navbar-brand lh-1 border-0 m-0 d-flex align-items-center" href="{{ route('home') }}">
                        <div class="d-flex align-items-center">
                            <div class="me-2">
                                <img src="{{ asset('assets/kemenag-logo-192x192.png') }}" width="30" alt="">
                            </div>
                            <span class="fw-black text-uppercase tracking-wide fs-6 lh-1">SIPAJI</span>
                        </div>
                    </a>
                    <i class="ri-close-circle-line ri-lg close-menu text-muted transition-all text-primary-hover me-4 cursor-pointer"></i>
                </div>
                <!-- / Mobile Logo-->

                <ul class="list-unstyled mb-6">

                    <!-- Dashboard Menu Section-->
                    <li class="menu-item"><a class="d-flex align-items-center" href="{{ route('home') }}">
                            <span class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-100">
                                    <rect fill-opacity=".5" fill="currentColor" x="3" y="3" width="7" height="7">
                                    </rect>
                                    <rect fill="currentColor" x="14" y="3" width="7" height="7"></rect>
                                    <rect fill-opacity=".5" fill="currentColor" x="14" y="14" width="7" height="7">
                                    </rect>
                                    <rect fill="currentColor" x="3" y="14" width="7" height="7"></rect>
                                </svg>
                            </span>
                            <span class="menu-link">
                                Dashboard
                            </span></a>
                    </li>
                    @if (Auth::user())
                        <li class="menu-item"><a class="d-flex align-items-center" href="{{ route('akunsaya') }}">
                                <span class="menu-icon">
                                    <i class="ri-user-line"></i>
                                </span>
                                <span class="menu-link">
                                    Haii, {{ Auth::user()->name }}</span>
                            </a>
                        </li>
                    @endif
                    @if (!Auth::user())
                        <li class="menu-item"><a class="d-flex align-items-center" href="{{ route('login') }}">
                                <span class="menu-icon">
                                    <i class="ri-login-box-line"></i>
                                </span>
                                <span class="menu-link">
                                    L O G I N</span>
                            </a>
                        </li>
                    @endif

                    <li class="menu-item"><a class="d-flex align-items-center" href="{{ route('grafik') }}">
                            <span class="menu-icon">
                                <i class="ri-dashboard-line"></i>
                            </span>
                            <span class="menu-link">
                                Grafik
                            </span></a>
                    </li>
                    <!-- / Dashboard Menu Section-->

                    @if (Auth::user())
                        <!-- Dashboard Menu Section-->
                        <div>
                            <li class="menu-section mt-4">Formulir</li>
                            <li class="menu-item"><a class="d-flex align-items-center" href="{{ url('pembatalan') }}">
                                    <span class="menu-icon">
                                        <i class="ri-close-circle-fill"></i>
                                    </span>
                                    <span class="menu-link">
                                        Pembatalan
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item"><a class="d-flex align-items-center" href="{{ url('pelimpahan') }}">
                                    <span class="menu-icon">
                                        <i class="ri-swap-box-line"></i>
                                    </span>
                                    <span class="menu-link">Pelimpahan </span>
                                </a>
                            </li>
                            <li class="menu-item d-none"><a class="d-flex align-items-center" href="#">
                                    <span class="menu-icon">
                                        <i class="ri-feedback-line"></i>
                                    </span>
                                    <span class="menu-link">Survey</span>
                                </a>
                            </li>
                            <li class="menu-item"><a class="d-flex align-items-center" href="{{ route('surveyall') }}">
                                    <span class="menu-icon">
                                        <i class="ri-feedback-line"></i>
                                    </span>
                                    <span class="menu-link">Hasil Survey</span>
                                </a>
                            </li>
                            <li class="menu-item"><a class="d-flex align-items-center" href="{{ route('informasi') }}">
                                    <span class="menu-icon">
                                        <i class="ri-information-line"></i>
                                    </span>
                                    <span class="menu-link">
                                        Informasi</span>
                                </a>
                            </li>
                        </div>
                        <!-- / Dashboard Menu Section-->
                    @endif


                </ul>
            </div>
        </div>
    </div>

</aside> <!-- / Page Aside-->
