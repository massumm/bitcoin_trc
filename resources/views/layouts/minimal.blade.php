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
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
        }
        .header-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px;
        }
        .back-btn {
            position: absolute;
            left: 0;
            font-size: 18px;
            text-decoration: none;
            color: black;
            padding-left: 10px;
        }
        .back-btn i {
            font-size: 20px;
        }
        h4 {
            margin: 0;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Back Button & Title in Same Row -->
    <div class="header-container">
        <a href="javascript:void(0);" class="back-btn" id="backButton">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h4>@yield('title')</h4>
    </div>

    @yield('content')
</div>

<script>
document.getElementById("backButton").addEventListener("click", function() {
    if (window.history.length > 1) {
        window.history.back(); // Navigate back
    } else {
        window.location.href = "/"; // Redirect to home if no history
    }
});
</script>

</body>
</html>
