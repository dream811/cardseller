<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="kr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TP Admin</title>
        <link rel="shortcut icon" href="{{asset('user_assets/images/favicon.ico')}}" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
        <!-- daterange picker -->
        <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <!-- Bootstrap4 Duallistbox -->
        <link rel="stylesheet" href="/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
        <!-- BS Stepper -->
        <link rel="stylesheet" href="/plugins/bs-stepper/css/bs-stepper.min.css">
        <!-- dropzonejs -->
        <link rel="stylesheet" href="/plugins/dropzone/min/dropzone.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/dist/css/adminlte.min.css">
        <!-- Toastr -->
        <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
        <!-- summernote -->
        <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <link rel="stylesheet" href="/dist/css/font.css">

        <!-- jquery bootstrap data table -->
        <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

        <script type="text/javascript" src="/plugins/angular.min.js"></script>
        <script type="text/javascript" src="/plugins/moment.js"></script>
        <script type="text/javascript" src="/plugins/numeral.min.js"></script>
        {{-- <script type="text/javascript" src="/js/constant.js?{{ time() }}"></script> --}}
        
        <script src="/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="/admin_assets/js/include.js?{{ time() }}"></script>
        <style>
            body {
                /* font-family: 'BareunBatang'; */
                background-color: #f4f6f9;
                font-size: 14px;
            }

            .table-form {
                font-size: 14px;
                margin: auto;
                width: 95%;
                min-width: 1500px;
                background-color: #eeeeee;
            }

            .table-form tr {
                height: 35px;
            }

            .table-form td {
                border: 1px solid gray;
                padding-left: 10px;
                padding-right: 10px;
                min-width: 150px;
            }

            .my-form {
                font-size: 14px;
                height: 27px;
                width: 150px;
                padding-top: 2px;
                padding-bottom: 0px;
                padding-left: 10px;
                padding-right: 10px;
                border: 1px solid #d2d6de;
                radius: 0px;
            }

            .color_0 { background-color: #7fb3d5c0 }
            .color_1 { background-color: #a9cce3b6 }
            .color_2 { background-color: #bb8fcebb }
            .color_3 { background-color: #d4efdfb9 }
            .color_4 { background-color: #d98780b2 }
            .color_5 { background-color: #a2d9cec5 }
            .color_6 { background-color: #e6b0aaad }
            .color_7 { background-color: #f5cba7b4 }
            .color_8 { background-color: #a9dfbfb2 }
            .color_9 { background-color: #ebdef0bd }
            .color_10 { background-color: #e6b0aab2 }
            .color_11 { background-color: #fad7a0b2 }
            .color_12 { background-color: #d1f2eba6 }
            .color_13 { background-color: #7fb3d5bd }
            .color_14 { background-color: #f7dc6fad }
            .color_15 { background-color: #e8daefb7 }
            .color_16 { background-color: #99a3a4c7 }
            .color_17 { background-color: #f1948aaf  }
            .color_18 { background-color: #f39d12a4 }
            .color_19 { background-color: #a3e4d7bb }
            .color_20 { background-color: #a569bda8 }
            .color_21 { background-color: #b2babbab }
            .color_22 { background-color: #48c9afaf }
            .color_23 { background-color: #fad7a0af }
            .color_24 { background-color: #f3c57ba8 }
            .color_25 { background-color: #b0f3b39d }
            .color_26 { background-color: #a7faa0ab }
            .color_27 { background-color: #fac8a09c }
            .color_28 { background-color: #a0b5faa9 }
            .color_29 { background-color: #d3faa0be }
            .color_30 { background-color: #faa0dc98 }
            .color_31 { background-color: #a0faa7b4 }
            .color_32 { background-color: #d1a0faad }
            .color_33 { background-color: #f4faa0b0 }
            .color_34 { background-color: #a0effaab }
            .color_35 { background-color: #faa0d79d }
            .color_36 { background-color: #c1faa09a }
            .color_37 { background-color: #faa0afa4 }
            .color_38 { background-color: #a0f7faa1 }
            .color_39 { background-color: #c5c296bb }
            .color_40 { background-color: #b9faa0b6 }
            .color_41 { background-color: #a0b0fab2 }
            .color_42 { background-color: #faf8a09f }
            .color_43 { background-color: #b9faa08a }
            .color_44 { background-color: #faa0e39c }
            .color_45 { background-color: #c8faa0a4 }
            .color_46 { background-color: #b6a5a6b7 }
            .color_47 { background-color: #73c5688f }
            .color_48 { background-color: #c5c9e97e }
            .color_49 { background-color: #da3dd279 }
            .color_50 { background-color: #a1a0faaf }
            .color_51 { background-color: #e6faa0af }
            .color_52 { background-color: #a0f7faaf }
            .color_53 { background-color: #e8a0faaf }
            .color_54 { background-color: #f8faa0af }
            .color_55 { background-color: #faa0c2af }
            .color_56 { background-color: #c1faa0af }
            .color_57 { background-color: #faa0acaf }
            .color_58 { background-color: #ecfaa0af }
            .color_59 { background-color: #f2a0faaf }
            .color_60 { background-color: #a0faf2af }
            .color_act { background-color: #CCD1D1 }
        </style>
        @yield('third_party_stylesheets')        
        @stack('page_css')

    </head>
    <body ng-app="myApp" ng-controller="myController" class="hold-transition sidebar-mini layout-fixed" data-panel-auto-height-mode="height" ng-cloak>
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a> </li>
                    
                </ul>
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item d-none d-sm-inline-block">
                        <span class="btn btn-outline-danger btn-block btn-sm">
                            <i class="fas fa-money-check-alt"></i>
                            <span onclick="" style="font-size:12px;font-weight:bold">
                                <span class="user_money" style="margin-left:10px; font-weight:700;">{{number_format(Auth::user()->money, 2, '.', ',')}}</span>
                            </span>
                        </span>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <span class="btn btn-outline-warning btn-block btn-sm">
                            <i class="fas fa-credit-card"></i>
                            <span onclick="" style="font-size:12px;font-weight:bold">
                                <span class="user_cart_cnt" style="margin-left:10px; font-weight:700;">0</span>
                            </span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button"> <i class="fas fa-expand-arrows-alt"></i> </a>
                    </li>
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <img 
                                @if (Auth::check() && Auth::user()->image != "")
                                    src="{{Auth::user()->image}}"
                                @else
                                    src="{{asset('user_assets/images/logo.png')}}"
                                @endif
                                class="user-image img-circle elevation-2" alt="User Image">
                                <span class="d-none d-md-inline">{{ Auth::user()->str_id }}</span>
                                
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-primary">
                                <img 
                                    @if (Auth::check() && Auth::user()->image != "")
                                        src="{{Auth::user()->image}}"
                                    @else
                                        src="{{asset('user_assets/images/logo.png')}}"
                                    @endif
                                    
                                    class="img-circle elevation-2"
                                    alt="User Image">
                                <p>
                                    {{ Auth::user()->str_id }}
                                    <small>Join Date: {{ Auth::user()->created_at->format('Y-m-d') }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="{{route('user.mypage')}}" class="btn btn-default btn-xs btn-flat">My Info</a>
                                <a href="#" class="btn btn-default btn-xs btn-flat float-right"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Log out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="#" class="brand-link" style="height:50px; " >
                    <img src="{{asset('user_assets/images/logo.png')}}" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
                </a>
                @include('user.layouts.menu')
            </aside>
            <!-- Content Wrapper. Contains page content -->
            @yield('content')
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>

        
        <script>
        $( document ).ajaxError(function( event, jqxhr, settings, thrownError ) {
            if (typeof settings === "string" && (settings.indexOf('401') > -1 || settings.indexOf('419') > -1) ) {
                location.href="/login";
            }
        });      
        
        </script>

        <div>
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-error" id="id_alert_error" style="display: none;"></button>
            <div class="modal fade" id="modal-error">
                <div class="modal-dialog" style="width: 400px;">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error</h5>
                        <div style="height: 10px;"></div>
                        <p id="id_msg_error"></p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-info" id="id_alert_info" style="display: none;"></button>
            <div class="modal fade" id="modal-info">
                <div class="modal-dialog" style="width: 400px;">
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-info"></i> Infomation</h5>
                        <div style="height: 10px;"></div>
                        <p id="id_msg_info"></p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-warning" id="id_alert_warning" style="display: none;"></button>
            <div class="modal fade" id="modal-warning">
                <div class="modal-dialog" style="width: 400px;">
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Warning</h5>
                        <div style="height: 10px;"></div>
                        <p id="id_msg_warning"></p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-success" id="id_alert_success" style="display: none;"></button>
            <div class="modal fade" id="modal-success">
                <div class="modal-dialog" style="width: 400px;">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Success</h5>
                        <div style="height: 10px;"></div>
                        <p id="id_msg_success"></p>
                    </div>
                </div>
            </div>
        </div>

        <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/plugins/select2/js/select2.full.min.js"></script>
        <script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="/dist/js/adminlte.js"></script>
        <script src="/plugins/flot/jquery.flot.js"></script>
        <script src="/plugins/flot/plugins/jquery.flot.resize.js"></script>
        <script src="/plugins/flot/plugins/jquery.flot.pie.js"></script>
        <script src="/plugins/inputmask/jquery.inputmask.min.js"></script>
        <script src="/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
        <script src="/plugins/bs-stepper/js/bs-stepper.min.js"></script>
        <script src="/plugins/dropzone/min/dropzone.min.js"></script>
        <script src="/plugins/toastr/toastr.min.js"></script>
        <script src="/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
        <!-- <script src="{{asset('js/jszip/jszip.min.js')}}"></script>
        <script src="{{asset('js/pdfmake/pdfmake.min.js')}}"></script>
        <script src="{{asset('js/pdfmake/vfs_fonts.js')}}"></script> -->
        <script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
        <script>
            getRealTimeInfo();
        setInterval(getRealTimeInfo, 5000);
        function getRealTimeInfo(){
            var action = '/realtime_info';
            // $.ajax({
            //     url: action,
            //     type: "GET",
            //     dataType: 'json',
            //     success: function ({status, data}) {
            //         $('.user_money').html(new Intl.NumberFormat('en-US',  { minimumFractionDigits: 2, }).format(data.user_info.money));
            //         $('.user_cart_cnt').html(data.user_info.cart_cnt);
            //     },
            //     error: function (data) {
            //     }
            // });
        }
        </script>
        @yield('third_party_scripts')
        @yield('script')
        @stack('page_scripts')
    </body>
</html>
