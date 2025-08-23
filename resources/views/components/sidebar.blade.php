<!-- Page Aside-->
<aside class="aside bg-white">

    <div class="simplebar-wrapper">
        <div data-pixr-simplebar>
            <div class="pb-6">
                <!-- Mobile Logo-->
                <div class="d-flex d-xl-none justify-content-between align-items-center border-bottom aside-header">
                    <a class="navbar-brand lh-1 border-0 m-0 d-flex align-items-center" href="{{ route('home') }}">
                        <div class="d-flex align-items-center">
                            <svg class="f-w-5 me-2 text-primary d-flex align-self-center lh-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 203.58 182">
                                <path
                                    d="M101.66,41.34C94.54,58.53,88.89,72.13,84,83.78A21.2,21.2,0,0,1,69.76,96.41,94.86,94.86,0,0,0,26.61,122.3L81.12,0h41.6l55.07,123.15c-12-12.59-26.38-21.88-44.25-26.81a21.22,21.22,0,0,1-14.35-12.69c-4.71-11.35-10.3-24.86-17.53-42.31Z"
                                    fill="currentColor" fill-rule="evenodd" fill-opacity="0.5" />
                                <path d="M0,182H29.76a21.3,21.3,0,0,0,18.56-10.33,63.27,63.27,0,0,1,106.94,0A21.3,21.3,0,0,0,173.82,182h29.76c-22.66-50.84-49.5-80.34-101.79-80.34S22.66,131.16,0,182Z"
                                    fill="currentColor" fill-rule="evenodd" />
                            </svg>
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
                    <li class="menu-item bg-warning"><a class="d-flex align-items-center" href="{{ route('addkritiksaran') }}">
                            <span class="menu-icon">
                                <i class="ri-feedback-line"></i>
                            </span>
                            <span class="menu-link">
                                Kritik dan Saran</span>
                        </a>
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
                            <li class="menu-item"><a class="d-flex align-items-center" href="{{ route('kritiksaran') }}">
                                    <span class="menu-icon">
                                        <i class="ri-feedback-line"></i>
                                    </span>
                                    <span class="menu-link">Daftar Kritik dan Saran</span>
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
