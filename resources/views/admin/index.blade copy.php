<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AdminLTE 3 | Dashboard</title>

    <!-- DataTables -->
    <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../AdminLTE-3.1.0/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/summernote/summernote-bs4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/toastr/toastr.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/summernote/summernote-bs4.min.css">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/codemirror/codemirror.css">
    <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/codemirror/theme/monokai.css">
    <!-- SimpleMDE -->
    <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/simplemde/simplemde.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div id="app">
        <admin-component></admin-component>
        {{--  <router-view></router-view>  --}}
    </div>

    {{--  <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>  --}}
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- jQuery -->
    <script src="../AdminLTE-3.1.0/plugins/jquery/jquery.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../AdminLTE-3.1.0/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../AdminLTE-3.1.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../AdminLTE-3.1.0/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../AdminLTE-3.1.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../AdminLTE-3.1.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../AdminLTE-3.1.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../AdminLTE-3.1.0/plugins/jszip/jszip.min.js"></script>
    <script src="../AdminLTE-3.1.0/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../AdminLTE-3.1.0/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../AdminLTE-3.1.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../AdminLTE-3.1.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../AdminLTE-3.1.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../AdminLTE-3.1.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../AdminLTE-3.1.0/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../AdminLTE-3.1.0/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../AdminLTE-3.1.0/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../AdminLTE-3.1.0/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../AdminLTE-3.1.0/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../AdminLTE-3.1.0/plugins/moment/moment.min.js"></script>
    <script src="../AdminLTE-3.1.0/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../AdminLTE-3.1.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../AdminLTE-3.1.0/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../AdminLTE-3.1.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../AdminLTE-3.1.0/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../AdminLTE-3.1.0/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../AdminLTE-3.1.0/dist/js/pages/dashboard.js"></script>
    <!-- SweetAlert2 -->
    <script src="../AdminLTE-3.1.0/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="../AdminLTE-3.1.0/plugins/toastr/toastr.min.js"></script>
    <!-- Summernote -->
    <script src="../AdminLTE-3.1.0/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- CodeMirror -->
    <script src="../AdminLTE-3.1.0/plugins/codemirror/codemirror.js"></script>
    <script src="../AdminLTE-3.1.0/plugins/codemirror/mode/css/css.js"></script>
    <script src="../AdminLTE-3.1.0/plugins/codemirror/mode/xml/xml.js"></script>
    <script src="../AdminLTE-3.1.0/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <!-- bs-custom-file-input -->
    <script src="../AdminLTE-3.1.0/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- Select2 -->
    <script src="../AdminLTE-3.1.0/plugins/select2/js/select2.full.min.js"></script>
</body>
</html>