<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
        }
        .back-btn {
            font-size: 18px;
            text-decoration: none;
        }
        h4 {
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Back Button -->
        <div class="d-flex align-items-center mb-3">
        <a href="javascript:void(0);" class="back-btn me-3" id="backButton">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h4 class="mx-auto mb-0">@yield('title')</h4>
        </div>

        @yield('content')
    </div>

</body>
<script>
document.getElementById("backButton").addEventListener("click", function() {
    console.log("asdfjjkashdfj")
    if (window.history.length > 1) {
        window.history.back(); // Navigate back
    } else {
        window.location.href = "/"; // Redirect to home if no history
    }
});
</script>
</html>
