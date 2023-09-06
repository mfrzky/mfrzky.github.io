<div class="l-navbar" id="nav-bar">
    <nav class="nav">
      <div>
          <div class="header_toggle nav_logo">
              <i class="fa-solid fa-bars nav_logo-icon" id="header-toggle"></i>
              <span class="nav_logo-name">Menu</span>
          </div>
          <div class="nav_list">
              <a href="{{route('purchase-orders.index')}}" class="nav_link {{ Request::path() == 'purchase-orders' ? 'active' : '' }}">
                <i class="fa-solid fa-cart-shopping nav_icon"></i>
                <span class="nav_name">Purchase Orders</span>
              </a>
              <a href="{{route('surat-jalan.index')}}" class="nav_link {{ Request::path() == 'surat-jalan' ? 'active' : '' }}">
                <i class="fa-solid fa-truck nav_icon"></i>
                <span class="nav_name">Surat Jalan</span>
              </a>
              <a href="{{route('invoices.index')}}" class="nav_link {{ Request::path() == 'invoices' ? 'active' : '' }}">
                <i class="fa-solid fa-credit-card nav_icon"></i>
                <span class="nav_name">Invoices</span>
              </a>
              <a href="{{route('dts.index')}}" class="nav_link {{ Request::path() == 'dts' ? 'active' : '' }}">
                <i class="fa-solid fa-download nav_icon"></i>
                <span class="nav_name">DTS</span>
              </a>
          </div>
      </div>
      <div class="d-flex justify-content-center align-items-center px-3 pb-time" id="divTime">
          <span class="text-white" id="time"> </span>
      </div>
    </nav>
</div>