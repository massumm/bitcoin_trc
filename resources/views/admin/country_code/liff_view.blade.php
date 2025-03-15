
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
    <?php
// Retrieve the value from the database
$dbTitle = DB::table('tbl_basic_setting')->value('d_title');
?>

<title id="medishop_title"><?php echo $dbTitle; ?></title>

    <meta name="description" content="" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
 

  </head>

  <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">


  <style>

      .dataTables_wrapper .dataTables_paginate .paginate_button {

          padding: 0px !important;
          margin: 0px !important;
          margin-top: 10px !important;

      }

      div.dataTables_wrapper div.dataTables_length select {

          width: 50%;

          margin-bottom: 20px !important;
      }
      .container {
			max-width: 600px;
			margin: 0 auto;
			padding: 30px;
			background-color: #fff;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}
		h1 {
			margin-top: 0;
			text-align: center;
			font-size: 2em;
			color: #333;
		}
		input[type="text"] {
      padding: 10px;
      border-radius: 5px;
      border: none;
      margin-bottom: 20px;
      width: 80%;
      text-align: center;
      background-color: #D9D9D9;
      font-family: 'Montserrat', sans-serif;
      font-size: 24px;
    }
	button {
      padding: 10px;
      border-radius: 10px;
      border: none;
      background-color: #2095F2;
      color: #fff;
      cursor: pointer;
      width: 50%;
      margin: 0 auto;
      font-family: 'Montserrat', sans-serif;
      font-size: 24px;
    }
	
		.login_card {

      width: 90%;
      max-width: 600px;
      margin: 50px auto;
      font-family: 'Montserrat', sans-serif;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
		button:hover {
			background-color: #0069d9;
		}

  </style>

  <body>



    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

        
        
                <!-- /Navbar -->

                 <!-- Content wrapper -->
                 <div class="content-wrapper">

                  <div class="container-fluid px-4">

                    <div class="login_card">

                      <input type="text" id="user-id" placeholder="ID">
                      <input type="text" id="user-password" placeholder="Password" >
                      <button onclick="getProfile()">Login</button>
                        {{-- <button onclick="getsProfile()">get info</button> --}}
                          {{-- <button onclick="login()">gt info</button> --}}
                    </div>
                    <script>
		
                      var vid;
                      liff.init({
                        liffId: '1660764229-z5dZeExR' // Replace with your LIFF ID
                      })
                      .then(() => {
              
                    
                        // start to use LIFF's api
                      })
                      .catch((err) => {
                        console.log(err);
                  
                        
                  
                      });
                  function getProfile() {
                            liff.getProfile()
                          .then((profile) => {
                              const profileInfo = `User ID: ${profile.userId}\nDisplay Name: ${profile.displayName}`;
                        var profile_id=profile.userId;
                        getconversionid(profile_id);
                             // window.alert(profileInfo);
                      
                              const profileInfoElement = document.createElement("p");
                              profileInfoElement.textContent = profileInfo;
                              document.body.appendChild(profileInfoElement);
                          })
                          .catch((err) => {
                              console.log('error', err);
                          });
                          // User is already logged in, proceed with using LIFF features
                          // Your code to use LIFF's API
                      
                  
                  }
                  async function getconversionid(profile_id){
                       
                   const apiKey = '30b1595a-316c-47b2-aeaf-634f562a56cc';
                  const apiUrl = `https://api.littlehelp.co.jp/line/v1/contact/${profile_id}?apikey=${apiKey}`;
                  $.ajax({
                      type: 'GET',
                      url: apiUrl,
                      dataType: 'json',
                      success: function(data) {
                      vid=data.vid;
                      console.log(data.vid);
                     // window.alert(vid);
                          login();
                          // Handle the response data here
                      },
                      error: function(jqXHR, textStatus, errorThrown) {
                          console.log(jqXHR);
                          // Handle the error here
                      }
                  });
                  
                  
                  }
                  function saveddata(userId){ 
                    $.ajax({
                      type: 'PUT',
                    url:  "{{url('api/line/') }}" +"/"+ userId + "?line_id=" + vid,
                  
                      dataType: 'json',
                      success: function(response) {
                          console.log(response.message);
                       
                          // Handle the success response here
                      }, 
                      error: function(jqXHR, textStatus, errorThrown) {
                          console.log(jqXHR);
                  
                          // Handle the error response here
                      }
                  });
                  
                  }
                  
                  function close(){
                  
                    liff.closeWindow();
                  }
                  function getsProfile(){
                    liff.login();
                  }
                  function login(){
                    var userid=document.getElementById('user-id').value;
                    var userpass=document.getElementById('user-password').value;
                  
                  $.ajax({
                                      url: "{{ url('api/login') }}",
                                      method: 'POST',
                            data: {
                                         email_or_mobile: userid,
                                         password: userpass
                                        
                                      },
                                      headers: {
                                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                      },
                                      success: function(response) {
                              var userId = response.user.id;
                                            console.log(userId);
                                saveddata(userId)
                                window.alert("success");
                                  
                                      
                                      },
                                      error: function(xhr, status, error) {
                                          console.log(error);
                                       
                                          window.alert("failed");
                            
                                      }
                                  }
                          );
                  
                  }
                  
                  
                    </script>
                </div>

                    <!-- Footer -->
           
              
                    <!-- /Footer -->
                 </div>
                 <!-- Content wrapper -->
      


        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
      </div>


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



    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>



    <script>

        $(document).ready( function () {
            $('#myDataTable').DataTable();
        } );
        var titleElement = document.getElementById('medishop_title');

// Retrieve the title text
var title = titleElement.innerHTML;

// Log the title
console.log(title);

    </script>


    @yield('body_script')

  </body>
</html>
