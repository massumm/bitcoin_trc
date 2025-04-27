<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>CoinBit</title>

    <meta name="description" content="" />



    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />


    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->
     <!-- Page -->
     <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
          <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
              <div class="card-body">
                <!-- Back Button -->
                <div class="mb-3">
                    <a href="/" class="btn btn-link" style="text-decoration: none; color: #666; font-size: 22px;">
                        <i class="fas fa-arrow-left"></i> 
                </div>
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                  <a href="index.html" class="app-brand-link gap-2">

                    <!-- <img src="{{ asset('assets/img/icons/medilogo.png') }}" class="responsive"style="max-width: 100%;"> -->
                    <span class=" demo text-body fw-bolder">{{__('messages.welcome')}}</span> 
                  </a>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    
                @endif
                <form action="{{ url('register_client') }}" method="POST" id="registerForm">
                    @csrf
             
                  <div class="mb-3">
                      <label for="name" class="form-label">{{ __('messages.enterYourName') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <div id="nameError" class="invalid-feedback" style="display: none;">
                        <strong>Username already exists</strong>
                    </div>
                    @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>



                  <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                      <label class="form-label" for="password">{{ __('messages.password') }}</label>
                    </div>
                    <div class="input-group input-group-merge">
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                  </div>

                  <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                      <label class="form-label" for="password_confirmation">{{ __('messages.confirmPassword') }}</label>
                    </div>
                    <div class="input-group input-group-merge">
                      <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="refer_code" class="form-label">{{ __('messages.referralCode') }}</label>
                    <input id="refer_by" type="text" class="form-control @error('refer_by') is-invalid @enderror" 
                           name="refer_by" 
                           value="{{ request()->get('code') ?: old('refer_by') }}" 
                           >
                    @error('refer_by')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="captcha" class="form-label">{{__('messages.captcha')}}</label>
                    <div class="d-flex align-items-center gap-2">
                      <input
                        type="text"
                        id="captcha"
                        class="form-control @error('captcha') is-invalid @enderror"
                        name="captcha"
                        placeholder="{{__('messages.enterTheCode')}}"
                        style="max-width: 150px;"
                        required
                      >
                      <div class="captcha-container" style="background: #fff; border-radius: 4px; padding: 5px;">
                        <canvas id="captchaCanvas" width="150" height="70" style="display: block;"></canvas>
                      </div>
                      @error('captcha')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="mb-3">
                    <button type="submit" class="btn btn-primary">
                        {{ __('messages.signUp') }}
                    </button>
                  </div>
                </form>
    
              </div>
            </div>
            <!-- /Register -->
          </div>
        </div>
      </div>

      <!-- / Content -->

      {{-- <div class="buy-now">
        <a
          href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
          target="_blank"
          class="btn btn-danger btn-buy-now"
          >Upgrade to Pro</a
        >
      </div> --}}


        <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
    document.querySelector('form').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        
        if (password !== confirmPassword) {
            e.preventDefault();
            alert('{{ __('messages.passwordAndConfirmationPasswordDoNotMatch') }}');
            return false;
        }

        const captchaInput = document.getElementById('captcha').value.trim();
        if (captchaInput !== captchaValue) {
            e.preventDefault();
            alert('Invalid verification code! Please try again.');
            generateCaptcha();
            document.getElementById('captcha').value = '';
            return false;
        }
    });

    let captchaValue = '';

    function generateCaptcha() {
        const canvas = document.getElementById('captchaCanvas');
        const ctx = canvas.getContext('2d');
        
        // Clear canvas
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        // Generate 4 random integers
        captchaValue = '';
        for (let i = 0; i < 4; i++) {
            captchaValue += Math.floor(Math.random() * 10).toString();
        }

        // Set background
        ctx.fillStyle = '#f8f9fa';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        // Add noise (lines)
        ctx.strokeStyle = '#0000ff';
        for (let i = 0; i < 20; i++) {
            ctx.beginPath();
            ctx.moveTo(Math.random() * canvas.width, Math.random() * canvas.height);
            ctx.lineTo(Math.random() * canvas.width, Math.random() * canvas.height);
            ctx.stroke();
        }

        // Draw distorted text
        ctx.font = 'bold 36px Arial';
        ctx.fillStyle = '#0000ff';
        let x = 25;
        for (let i = 0; i < captchaValue.length; i++) {
            const char = captchaValue[i];
            const rotation = (Math.random() - 0.5) * 0.4;
            ctx.save();
            ctx.translate(x, 45);
            ctx.rotate(rotation);
            ctx.fillText(char, 0, 0);
            ctx.restore();
            x += 30;
        }

        // Add more noise (dots)
        for (let i = 0; i < 100; i++) {
            ctx.fillRect(
                Math.random() * canvas.width,
                Math.random() * canvas.height,
                2,
                2
            );
        }
    }

    // Generate initial captcha
    window.addEventListener('load', generateCaptcha);

    let usernameExists = false;
    let isCheckingUsername = false;

    document.getElementById('name').addEventListener('blur', function() {
        const name = this.value;
        if (name) {
            isCheckingUsername = true;
            fetch('/check-username', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ name: name })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const nameError = document.getElementById('nameError');
                if (data.exists) {
                    this.classList.add('is-invalid');
                    nameError.style.display = 'block';
                    usernameExists = true;
                } else {
                    this.classList.remove('is-invalid');
                    nameError.style.display = 'none';
                    usernameExists = false;
                }
            })
            .catch(error => {
                console.error('Error checking username:', error);
            })
            .finally(() => {
                isCheckingUsername = false;
            });
        }
    });

    document.getElementById('registerForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Always prevent default first
        
        if (isCheckingUsername) {
            alert('Please wait while we check the username...');
            return;
        }

        const name = document.getElementById('name').value;
        if (!name) {
            this.submit();
            return;
        }

        fetch('/check-username', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ name: name })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.exists) {
                document.getElementById('name').classList.add('is-invalid');
                document.getElementById('nameError').style.display = 'block';
                usernameExists = true;
                alert('{{ __('messages.usernameAlreadyExists') }}');
            } else {
                usernameExists = false;
                // Submit the form using the original form element
                this.submit();
            }
        })
        .catch(error => {
            console.error('Error checking username:', error);
            alert('An error occurred while checking the username. Please try again.');
        });
    });

    // Handle success message and redirect
    @if(session('success'))
        alert('{{ session('success') }}');
        window.location.href = '{{ route('client.home') }}';
    @endif

    @if(session('error'))
        alert('{{ session('error') }}');
    @endif
    </script>

  </body>
</html>
