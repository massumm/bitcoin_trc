<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title id="medishop_title">
    GlobalMall
    </title>
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
            background-color: #F8F8F8;
        }
       

        .header-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px;
            margin-bottom: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
            padding: 0 15px;
        }
        .back-btn {
            position: absolute;
            left: 15px;
            font-size: 18px;
            text-decoration: none;
            color: black;
        }
        .back-btn i {
            font-size: 20px;
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

<div class="container">
    <div class="header-container">
        <a href="javascript:void(0);" class="back-btn" id="backButton">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h4>@yield('title')</h4>
    </div>

    <div class="content-wrapper">
        @yield('content')
    </div>
</div>

<script>
document.getElementById("backButton").addEventListener("click", function() {
    if (window.history.length > 1) {
        window.history.back();
    } else {
        window.location.href = "/";
    }
});
</script>

</body>
</html>
