<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="dashboard" class="app-brand-link">
        <span class="app-brand-logo demo">
         {{-- SVG-LOGO-PATH --}}
        </span>
        {{-- <span class="app-brand-text demo menu-text fw-bolder ms-2">MEDI SHOP</span> --}}
        <?php
        // Retrieve the value from the database
        $dbTitle = DB::table('tbl_basic_setting')->value('d_title');
        ?>
        <span class="app-brand-text demo menu-text fw-bolder ms-2" style="text-transform: uppercase;"><?php echo $dbTitle; ?></span>
      </a>
      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
      <!-- Dashboard -->
       <li class="menu-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
        <a href="/admin/dashboard" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">{{__('dashboard')}}</div>
        </a>
      </li>


      <!-- PRESCRIPTION ORDER SECTION  -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">{{__('prescripOrder')}}</span></li>
      <li class="menu-item {{Request::is('admin/view-pending-order') ? 'active' : '' }}" >
        <a href="/admin/view-pending-order" class="menu-link">
          {{-- <i class="menu-icon tf-icons bx bx-collection"></i> --}}
          <i class="menu-icon fas fa-shopping-cart"></i>
          <div data-i18n="Basic">{{__('pendingOrders')}}</div>
        </a>
      </li>
      <li class="menu-item  {{Request::is('admin/view-completed-order') ? 'active' : '' }}">
        <a href="/admin/view-completed-order" class="menu-link">
          {{-- <i class="menu-icon tf-icons bx bx-collection"></i> --}}
          <i class="menu-icon fas fa-check"></i>
          <div data-i18n="Basic">{{__('completedOrders')}}</div>
        </a>
      </li>
      <li class="menu-item  {{Request::is('admin/view-cancalled-order') ? 'active' : '' }}">
        <a href="/admin/view-cancalled-order" class="menu-link">
          {{-- <i class="menu-icon tf-icons bx bx-collection"></i> --}}
          <i class="menu-icon fas fa-times"></i>
          <div data-i18n="Basic">{{__('invalidOrders')}}</div>
        </a>
      </li>

           <!-- MEDICINE SECTION -->
           <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{__('medicineSection')}}</span>
          </li>
          <li class="menu-item {{ Request::is('admin/add-medicine') || Request::is('admin/add-medicines')
          || Request::is('admin/view-medicines') || Request::is('admin/view-medicine') ? 'active open' : '' }} ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              {{-- <i class="menu-icon tf-icons bx bx-dock-top"></i> --}}
              <i class="menu-icon fas fa-pills"></i>
              <div data-i18n="Account Settings">{{__('medicine')}}</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item {{ Request::is('admin/add-medicine') ? 'active' : '' }}">
                <a href="/admin/add-medicine" class="menu-link">
                  <div data-i18n="Connections">{{__('medicineImport')}}</div>
                </a>
              </li>
              <li class="menu-item {{ Request::is('admin/view-medicine') ? 'active' : '' }}">
                <a href="/admin/view-medicine" class="menu-link">
                  <div data-i18n="Connections">{{__('medicineList')}}</div>
                </a>
              </li>
            </ul>
          </li>



      <!-- CUSTOMER SECTION -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">{{__('customerSection')}}</span></li>
      <li class="menu-item  {{Request::is('admin/view-userslist') ? 'active' : '' }}">
        <a href="{{ url('admin/view-userslist') }}" class="menu-link">
          {{-- <i class="menu-icon tf-icons bx bx-collection"></i> --}}
          <i class="menu-icon fas fa-users"></i>
          <div data-i18n="Basic">{{__('customarList')}}</div>
        </a>
      </li>
      <li class="menu-item {{Request::is('admin/view-calender') ? 'active' : '' }}">
        <a  href="{{ url('admin/view-calender') }}" class="menu-link">
          {{-- <i class="menu-icon tf-icons bx bx-collection"></i> --}}
          <i class="menu-icon fas fa-calendar-alt"></i>
          <div data-i18n="Basic">{{__('calenderPage')}}</div>
        </a>
      </li>

      <!-- PAYMENT GATEWAY SECTION -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">{{__('settings')}}</span></li>

      <!-- Cards -->
      <li class="menu-item {{Request::is('admin/view-basic-settings') ? 'active' : '' }}">
        <a  href="{{ url('admin/view-basic-settings') }}" class="menu-link">
          <i class="bx bx-cog me-2"></i>
          <div data-i18n="Basic">{{__('basicSetup')}}</div>
        </a>
      </li>
      <li class="menu-item {{Request::is('admin/view-pages-settings') ? 'active' : '' }}">
        <a  href="{{ url('admin/view-pages-settings') }}" class="menu-link">
          {{-- <i class="menu-icon fas fa-globe"></i> --}}

          <i class="menu-icon fas fa-toolbox"></i>
          <div data-i18n="Basic">{{__('pages')}}</div>
        </a>
      </li>
      <li class="menu-item {{Request::is('admin/view-payment-list') ? 'active' : '' }}">
        <a  href="{{ url('admin/view-payment-list') }}" class="menu-link">
          <i class="menu-icon fas fa-money-bill-alt"></i>
          <div data-i18n="Basic">{{__('paymentGateway')}}</div>
        </a>
      </li>
      <li class="menu-item {{Request::is('admin/add-Country-Code') ? 'active' : '' }}">
        <a  href="{{ url('admin/add-Country-Code') }}" class="menu-link">
          <i class="menu-icon fas fa-globe"></i>

          <div data-i18n="Basic">{{__('paymentGateway')}}</div>
        </a>
      </li>
        </ul>
  </aside>
