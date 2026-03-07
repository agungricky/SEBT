<nav class="bottom-navbar">
    <div class="container">
        <ul class="nav page-navigation justify-content-center">

            {{-- DASHBOARD --}}
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/dashboard') }}">
                    <i class="mdi mdi-view-dashboard-outline menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>

            {{-- RIWAYAT --}}
            <li class="nav-item {{ request()->is('riwayat*') ? 'active' : '' }}">
                <a href="#" class="nav-link">
                    <i class="mdi mdi-history menu-icon"></i>
                    <span class="menu-title">Riwayat</span>
                    <i class="menu-arrow"></i>
                </a>

                {{-- <div class="submenu">
                    <ul>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('riwayat/buttons') ? 'active' : '' }}"
                                href="{{ url('/riwayat/buttons') }}">
                                Buttons
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('riwayat/typography') ? 'active' : '' }}"
                                href="{{ url('/riwayat/typography') }}">
                                Typography
                            </a>
                        </li>
                    </ul>
                </div> --}}
            </li>

        </ul>
    </div>
</nav>
