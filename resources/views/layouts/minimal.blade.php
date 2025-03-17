<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            background-color: #F8F8F8;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 0 15px;
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
        h4 {
            margin: 0;
            font-weight: 600;
        }
        .content-wrapper {
            padding: 0 5px;
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
