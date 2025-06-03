<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title id="medishop_title">GlobalMall</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/profile.jpg') }}" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

    <!-- Custom Styles -->
    <style>
        body {
            padding-bottom: 60px; /* Space for bottom navigation */
        }

        /* Bottom Navigation Bar */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #fff;
            border-top: 1px solid #ddd;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .bottom-nav ul {
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 10px 0;
            margin: 0;
            list-style: none;
        }

        .bottom-nav li {
            flex: 1;
            text-align: center;
        }

        .bottom-nav a {
            text-decoration: none;
            color: #888; /* Default gray color */
            font-size: 14px;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: color 0.3s ease;
        }

        .bottom-nav a.active {
            color: #4169E1; /* Active blue color */
        }

        .bottom-nav i {
            font-size: 20px;
            margin-bottom: 4px;
        }

        .bottom-nav span {
            font-size: 12px;
        }
    </style>
</head>
<body>

    <!-- Page Content -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Bottom Navigation -->
    <nav class="bottom-nav">
        <ul>
            <li>
                <a href="/client/dashboard" class="{{ request()->is('client/dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>{{ __('messages.home') }}</span>
                </a>
            </li>
            <li>
                <a href="/client/service" class="{{ request()->is('client/service') ? 'active' : '' }}">
                    <i class="fas fa-wallet"></i>
                    <span>{{ __('messages.service') }}</span>
                </a>
            </li>
            <li>
                <a href="/client/projectspage" class="{{ request()->is('client/projectspage') ? 'active' : '' }}">
                    <i class="fas fa-credit-card"></i>
                    <span>{{ __('messages.menu') }}</span>
                </a>
            </li>
            <li>
                <a href="/client/recordlist" class="{{ request()->is('client/recordlist') ? 'active' : '' }}">
                    <i class="fas fa-credit-card"></i>
                    <span>{{ __('messages.record') }}</span>
                </a>
            </li>
            <li>
                <a href="/client/mine" class="{{ request()->is('client/mine') ? 'active' : '' }}">
                    <i class="fas fa-user"></i>
                    <span>{{ __('messages.mine') }}</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
