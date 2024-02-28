<div class="l-navbar showNav" id="nav-bar">
    <nav class="nav">
      <div>
          <div class="header_toggle nav_logo">
              <i class="fa-solid fa-bars nav_logo-icon" id="header-toggle"></i>
              <span class="nav_logo-name">Menu</span>
          </div>
          <div class="nav_list">
              @if (session('user')->IS_ADMIN == 1 || session('user')->IS_ADMIN != NULL)
                <a href="{{route('admin-menu.index')}}" class="nav_link {{ Request::path() == 'admin' ? 'active' : '' }}">
                  <i class="fa-solid fa-user fa-lg"></i>
                  <span class="nav_name">Admin</span>
                </a>
              @endif
              <a href="{{route('purchase-orders.index')}}" class="nav_link {{ Request::path() == 'purchase-orders' ? 'active' : '' }}">
                <i class="fa-solid fa-cart-shopping fa-lg"></i>
                <span class="nav_name">Purchase Orders</span>
              </a>
              <a href="{{route('surat-jalan.index')}}" class="nav_link {{ Request::path() == 'surat-jalan' ? 'active' : '' }}">
                <i class="fa-solid fa-truck fa-lg"></i>
                <span class="nav_name">Surat Jalan</span>
              </a>
              <a href="{{route('invoices.index')}}" class="nav_link {{ Request::path() == 'invoices' ? 'active' : '' }}">
                <i class="fa-solid fa-credit-card fa-lg"></i>
                <span class="nav_name">Invoices</span>
              </a>
              <a href="{{route('dts.index')}}" class="nav_link {{ Request::path() == 'dts' ? 'active' : '' }}">
                <i class="fa-solid fa-download fa-lg"></i>
                <span class="nav_name">DTS</span>
              </a>
              <a href="{{route('management-material.index')}}" class="nav_link {{ Request::path() == 'management-material' ? 'active' : '' }}">
                <i class="fa-solid fa-list-check fa-lg"></i>
                <span class="nav_name">Management Material</span>
              </a>
              <a href="{{route('laporan.index')}}" class="nav_link {{ Request::path() == 'laporan' ? 'active' : '' }}">
                <i class="fa-regular fa-folder fa-lg"></i>
                <span class="nav_name">Laporan</span>
              </a>
          </div>
      </div>
      <div class="d-flex justify-content-center align-items-center px-3 pb-time" id="divTime">
          <span class="text-white" id="time"> </span>
      </div>
    </nav>
</div>