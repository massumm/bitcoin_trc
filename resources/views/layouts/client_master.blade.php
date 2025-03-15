<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title id="medishop_title">
        <?php echo DB::table('tbl_basic_setting')->value('d_title'); ?>
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}" />

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
            color: #333;
            font-size: 14px;
        }

        .bottom-nav a.active {
            color: #007bff;
            font-weight: bold;
        }

        .bottom-nav i {
            display: block;
            font-size: 20px;
            margin-bottom: 5px;
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
                <a href="/client/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Home
                </a>
            </li>
            <li>
                <a  href="{{ route('service') }}" class="{{ request()->is('wallet') ? 'active' : '' }}">
                    <i class="fas fa-wallet"></i> Service
                </a>
            </li>
            <li>
                <a href="/client/projectspage" class="{{ request()->is('recharge') ? 'active' : '' }}">
                    <i class="fas fa-credit-card"></i> Menu
                </a>
            </li>
            <li>
                <a href="/client/recordlist" class="{{ request()->is('recharge') ? 'active' : '' }}">
                    <i class="fas fa-credit-card"></i> Record
                </a>
            </li>
            <li>
                <a href="/client/mine"  class="{{ request()->is('profile') ? 'active' : '' }}">
                    <i class="fas fa-user"></i> Mine
                </a>
            </li>
        </ul>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
