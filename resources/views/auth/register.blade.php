

<!doctype html>
<html lang="en" >
  <head>
      <meta charset="utf-8">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>COINEX</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{asset('user_assets/images/favicon.ico')}}" />
      <!-- <link rel="stylesheet" href="{{asset('user_assets/css/libs.min.css')}}"> -->
      <link rel="stylesheet" href="{{asset('user_assets/css/coinex.css?v=1.0.0')}}">
      <script src="/plugins/jquery/jquery.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <body class="" data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body"></div>
      </div>    </div>
    <!-- loader END -->
      <div style="background-image: url('{{asset('user_assets/images/auth/01.png')}}" >  
        <div class="wrapper">
            <section class="vh-100 bg-image">
               <div class="container h-100">
                  <div class="row justify-content-center h-100 align-items-center">
                     <div class="col-md-6 mt-5">
                        <div class="card">
                           <div class="card-body">
                              <div class="auth-form">
                                    <h2 class="text-center mb-4">Generate new account</h2>
                                    <!-- <a href="../../dashboard/index.html" class="navbar-brand dis-none align-items-center justify-content-center">
                                       <svg width="36" class="text-primary" viewBox="0 0 128 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <g>
                                             <path d="M117.348 105.33C117.594 105.476 117.669 105.799 117.508 106.036C110.26 116.759 99.5876 125.042 87.0232 129.687C74.2883 134.395 60.2849 135.117 47.0817 131.745C33.8785 128.372 22.1759 121.086 13.7027 110.961C5.22957 100.836 0.43531 88.4101 0.0282348 75.5189C-0.37884 62.6276 3.62286 49.9548 11.4421 39.3726C19.2614 28.7905 30.4835 20.8602 43.4505 16.7536C56.4176 12.6469 70.4417 12.5815 83.4512 16.5672C96.2865 20.4995 107.462 28.1693 115.375 38.4663C115.55 38.6939 115.495 39.0214 115.256 39.1813L97.3742 51.176C97.1539 51.3238 96.8567 51.2735 96.6942 51.0637C91.6372 44.53 84.5205 39.6627 76.3537 37.1606C68.031 34.6109 59.0591 34.6527 50.7636 37.2799C42.468 39.9071 35.2888 44.9804 30.2865 51.7502C25.2842 58.5201 22.7241 66.6274 22.9846 74.8745C23.245 83.1215 26.3121 91.0709 31.7327 97.5482C37.1533 104.025 44.64 108.687 53.0866 110.844C61.5332 113.002 70.4918 112.54 78.6389 109.528C86.6324 106.573 93.4288 101.316 98.0645 94.5111C98.2142 94.2913 98.5086 94.2233 98.7376 94.3583L117.348 105.33Z" fill="#FF971D"></path>
                                             <path d="M53.2837 0.5C53.2837 0.223858 53.5075 0 53.7837 0H75.6195C75.8957 0 76.1195 0.223858 76.1195 0.5V26.25H53.2837V0.5Z" fill="#FF971D"></path>
                                             <path d="M53.2837 123.75H76.1195V149.5C76.1195 149.776 75.8957 150 75.6195 150H53.7837C53.5075 150 53.2837 149.776 53.2837 149.5V123.75Z" fill="#FF971D"></path>
                                          </g>
                                       </svg>            
                                       <h4 class="logo-title m-0">OINEX</h4>
                                    </a> -->
                                    <form method="POST" id="registForm" action="{{ route('register') }}">
                                    @csrf
                                       <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
                                       <div class="row">
                                          <div class="col-md-12 mb-4">
                                             <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="str_id" id="str_id" placeholder="" readonly>
                                                <label for="str_id">ID</label>
                                             </div>                                             
                                          </div>
                                          <div class="col-md-12 mb-4">
                                             <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="password" id="password" placeholder="" readonly>
                                                <label for="password">Password</label>
                                             </div>                                             
                                          </div>
                                       </div>
                                       <div class="text-center">
                                          <a href="{{route('login')}}" class="btn btn-success">Goto Login</a>
                                          <button type="button" class="btn btn-primary submit">Generate</button>
                                       </div>
                                    </form>
                                    <!-- <div class="new-account mt-3 text-center">
                                       <p>Already have an Account <a class="text-primary" href="../../dashboard/auth/sign-in.html">Sign in</a>
                                       </p>
                                    </div> -->
                                 </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
        </div>
      </div>   
      <!-- Backend Bundle JavaScript -->
      <script src="{{asset('user_assets/js/libs.min.js')}}"></script>
      <!-- widgetchart JavaScript -->
      <script src="{{asset('user_assets/js/charts/widgetcharts.js')}}"></script>
      <!-- fslightbox JavaScript -->
      <script src="{{asset('user_assets/js/fslightbox.js')}}"></script>
      <!-- app JavaScript -->
      <script src="{{asset('user_assets/js/app.js')}}"></script>
      <!-- apexchart JavaScript -->
      <script src="{{asset('user_assets/js/charts/apexcharts.js')}}"></script>
   </body>
   <script>
      $(document).ready(function() {
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
         
         $('.submit').on('click', function() {
            
            var form = $('#registForm');
            //return false;
            var action = '/generate';
            
            $.ajax({
                url: action,
                type: "GET",
                dataType: 'json',
                success: function ({status, data}) {
                  if(status == "success"){
                     $('#str_id').val(data.str_id);
                     $('#password').val(data.str_pwd);
                     $('.submit').addClass('d-none')
                  }else{
                     alert('Try again later');
                     return false;
                  }
                },
                error: function (data) {
                }
            });
         });
      });
      
   </script>
</html>