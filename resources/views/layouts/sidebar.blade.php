<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <span class="app-brand demo menu-text fw-bolder ms-4" style="font-size: 35px">StockMat</span>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item">
            <a href="{{ url('/') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">MASTER DATA</span>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-buildings'></i>
                <div data-i18n="Material">Material</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ url('materials') }}" class="menu-link">
                        <div data-i18n="Account">Data Material</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ url('materials/create') }}" class="menu-link">
                        <div data-i18n="Notifications">Tambah Material</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="{{ url('kategoris') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Kategori">Kategori</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ url('subkategoris') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category-alt"></i>
                <div data-i18n="Sub Kategori">Sub Kategori</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ url('areas') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-area"></i>
                <div data-i18n="Area">Area</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ url('lines') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-line-chart"></i>
                <div data-i18n="Line">Line</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ url('drawings') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Data Laporan">Drawing</div>
            </a>
        </li>
        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Transaksi</span></li>
        <!-- User interface -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-log-in"></i>
                <div data-i18n="Stok Masuk">Stok Masuk</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ url('stockins') }}" class="menu-link">
                        <div data-i18n="Data Stok Masuk">Data Stok Masuk</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ url('stockins/create') }}" class="menu-link">
                        <div data-i18n="Input Stok Masuk">Input Stok Masuk</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Extended components -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-log-out"></i>
                <div data-i18n="Stok Keluar">Stok Keluar</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ url('stockouts') }}" class="menu-link">
                        <div data-i18n="Data Stok Keluar">Data Stok Keluar</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ url('stockouts/create') }}" class="menu-link">
                        <div data-i18n="Input Stok Keluar">Input Stok Keluar</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Misc -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Laporan</span></li>
        <li class="menu-item">
            <a href="{{ url('/laporan') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book"></i>
                <div data-i18n="Data Laporan">Data Laporan</div>
            </a>
        </li>
        <!-- Forms & Tables -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Setting</span></li>
        <!-- Forms -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="User">User</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ url('users') }}" class="menu-link">
                        <div data-i18n="Data User">Data User</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ url('users/create') }}" class="menu-link">
                        <div data-i18n="Tambah User">Tambah User</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
