<nav
class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
id="layout-navbar"
>
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
  <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
    <i class="bx bx-menu bx-sm"></i>
  </a>
</div>

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
  <!-- Search -->
  {{-- <div class="navbar-nav align-items-center">
    <div class="nav-item d-flex align-items-center">
      <i class="bx bx-search fs-4 lh-0"></i>
      <input
        type="text"
        class="form-control border-0 shadow-none"
        placeholder="Search..."
        aria-label="Search..."
      />
    </div>
  </div> --}}
  <!-- /Search -->

  <ul class="navbar-nav flex-row align-items-center ms-auto">
    <!-- Notification Icon -->
    <li class="nav-item me-3 dropdown">
      <a class="nav-link position-relative" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bx bx-bell fs-4"></i>
        <span id="notificationBadge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.75rem; display:none;">
          0
          <span class="visually-hidden">unread messages</span>
        </span>
      </a>
      <ul class="dropdown-menu dropdown-menu-end" id="notificationList" aria-labelledby="notificationDropdown" style="width: 300px; max-height: 400px; overflow-y: auto;">
        <li class="dropdown-item text-center text-muted">No notifications</li>
      </ul>
    </li>

{{--
    <li class="nav-item lh-1 me-3">
      <a
        class="github-button"
        href="https://github.com/themeselection/sneat-html-admin-template-free"
        data-icon="octicon-star"
        data-size="large"
        data-show-count="true"
        aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
        >Star</a
      >
    </li> --}}

    <!-- User -->
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
      <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
          <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
        </div>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <a class="dropdown-item" href="#1">
            <div class="d-flex">
              <div class="flex-shrink-0 me-3">
                <div class="avatar avatar-online">
                  <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                </div>
              </div>
              <div class="flex-grow-1">
                <span class="fw-semibold d-block"> {{ Auth::user()->name }}</span>
                <small class="text-muted">Admin</small>
              </div>
            </div>
          </a>
        </li>
        <li>
          <div class="dropdown-divider"></div>
        </li>
        <li>
          <a class="dropdown-item" href="#">
            <i class="bx bx-user me-2"></i>
            <span class="align-middle">My Profile</span>
          </a>
        </li>
        {{-- <li>
          <a class="dropdown-item" href="#">
            <span class="d-flex align-items-center align-middle">
              <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
              <span class="flex-grow-1 align-middle">Billing</span>
              <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
            </span>
          </a>
        </li> --}}
        <li>
          <div class="dropdown-divider"></div>
        </li>
        <li>
          <a class="dropdown-item" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"
          >
            <i class="bx bx-power-off me-2"></i>
            <span class="align-middle"

            >Log Out</span>
            {{-- <a
            class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
                {{ __('Logouts') }}
            </a> --}}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
          {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> --}}
        </li>
      </ul>
    </li>
    <!--/ User -->
  </ul>
</div>
</nav>

<audio id="notificationSound" src="{{ asset('assets/ringtone.wav') }}" preload="auto"></audio>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let lastNotificationCount = 0;
    let userInteracted = false;

    // Show alert when page loads to enable notification sound
    // setTimeout(() => {
    //     if (confirm('Enable notification sound alerts? Click OK to enable.')) {
    //         console.log('User enabled notification sound');
    //         // Try to play audio to unlock it
    //         document.getElementById('notificationSound').play().catch(() => {});
    //         userInteracted = true;
    //     }
    // }, 1000); // Show after 1 second

    // Track user interaction to enable audio
    document.addEventListener('click', () => {
      console.log('user interacted click'+userInteracted);
        if (!userInteracted) {
            console.log('play sound user interacted');
            // Try to play audio to unlock it
            document.getElementById('notificationSound').play().catch(() => {});
            userInteracted = true;
        }
    });

    function fetchNotificationCount() {
        fetch('/admin/notification-count')
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('notificationBadge');
                if (data.count > 0) {
                    badge.textContent = data.count;
                    badge.style.display = 'inline-block';
                } else {
                    badge.style.display = 'none';
                }

                // Play sound if new notifications arrived and user has interacted
                if (data.count > lastNotificationCount && userInteracted) {
                    console.log('play sound');
                    document.getElementById('notificationSound').play().catch(error => {
                        console.log('Audio play failed:', error);
                    });
                }
                lastNotificationCount = data.count;
            });
    }
    fetchNotificationCount();
    setInterval(fetchNotificationCount, 10000); // Poll every 10s

    document.getElementById('notificationDropdown').addEventListener('click', function(e) {
        e.preventDefault();

        // Fetch notifications
        fetch('/admin/notification-list')
            .then(response => response.json())
            .then(data => {
                const notificationList = document.getElementById('notificationList');
                notificationList.innerHTML = ''; // Clear previous notifications

                if (data.notifications && data.notifications.length > 0) {
                    data.notifications.forEach(notification => {
                        const li = document.createElement('li');
                        li.className = 'dropdown-item';
                        li.textContent = notification.message;
                        notificationList.appendChild(li);
                    });
                } else {
                    const li = document.createElement('li');
                    li.className = 'dropdown-item text-center text-muted';
                    li.textContent = 'No notifications';
                    notificationList.appendChild(li);
                }
            });

        // Mark as read (optional, if you want to mark as read on click)
        fetch('/admin/notification-mark-read', { 
            method: 'POST', 
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') } 
        })
        .then(() => {
            document.getElementById('notificationBadge').style.display = 'none';
        });
    });
});
</script>

