<!--
*
*  INSPINIA - Responsive Admin Theme
*  version 2.7.1
*
-->

<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.7.1/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 May 2018 14:05:37 GMT -->

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Bellcos | Home</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <!--comienzo de form_advanced.html -->
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">

    <link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">

    <link href="css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

    <link href="css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">

    <link href="css/plugins/cropper/cropper.min.css" rel="stylesheet">

    <link href="css/plugins/switchery/switchery.css" rel="stylesheet">

    <link href="css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

    <link href="css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">

    <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">

    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <link href="css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <link href="css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">

    <link href="css/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

    <link href="css/plugins/dualListbox/bootstrap-duallistbox.min.css" rel="stylesheet">
    <!--fin de form_advanced.html -->
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">


</head>

<body>

    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                                <img alt="image" class="img-circle" src="img/bellcosImg.png" />
                            </span>
                            <a class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{auth()->user()->name}}</strong>
                                    </span>
                                    <!-- <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>-->
                                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                        <li><a href="profile.html">Profile</a></li>
                                        <li><a href="contacts.html">Contacts</a></li>
                                        <li><a href="mailbox.html">Mailbox</a></li>
                                        <li class="divider"></li>
                                        <li><a href="login.html">Logout</a></li>
                                    </ul>
                        </div>
                        <div class="logo-element">
                            BELB
                        </div>
                    </li>

                    <li>
                        <a href="{{url('home')}}"><i class="fa fa-laptop"></i> <span class="nav-label">Home</span></a>
                    </li>
                    <li>
                        <a href="{{url('cliente')}}"><i class="fa fa-folder"></i> <span class="nav-label">Generar Ruta</span></a>
                    </li>
                    <li>
                        <a href="{{url('salasAsignadas')}}"><i class="fa fa-list-ol"></i> <span class="nav-label">Salas Asignadas</span></a>
                    </li>
                    <li>
                        <a href="{{url('reporte')}}"><i class="fa fa-edit"></i> <span class="nav-label">Reporte de Stock</span></a>
                    </li>
                    <li>
                        <a href="{{url('reporteGeneral')}}"><i class="fa fa-file-text-o"></i> <span class="nav-label">Reporte General</span></a>
                    </li>
                    <!--  
                    <li>
                        <a href="{{url('listaSala')}}"><i class="fa fa-pie-chart"></i> <span class="nav-label">Salas Asignada</span> </a>
                    </li>
                    <li>
                        <a href="{{url('empleados')}}"><i class="fa fa-pie-chart"></i> <span class="nav-label">Agregar Empleado</span> </a>
                    </li>-->
                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Bienvenidos a Bellcos Bolvia.</span>
                        </li>


                        <li>
                            <form method="POST" action="{{route('logout')}}">
                                @csrf
                                <button class="btn btn-danger btn-xs">Logout</button>
                            </form>

                        </li>
                        <li>
                            <a class="right-sidebar-toggle">
                                <i class="fa fa-tasks"></i>
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>

            @yield('content')
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">
                    </div>
                    <div class="footer">
                        <div class="pull-right">
                            Santa Cruz <strong>Bolivia</strong> 2020.
                        </div>
                        <div>
                            <strong>Sistema</strong> Bellcos S.A
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>
    <script src="js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>
    @yield('script2')

    @yield('script')


</body>

<!-- Mirrored from webapplayers.com/inspinia_admin-v2.7.1/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 May 2018 14:06:41 GMT -->

</html>