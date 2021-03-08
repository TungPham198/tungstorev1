<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"> @yield('admin_meta')
    <base href="{{ asset('') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Phạm Đình Tùng" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets\images\favicon.ico">
    <link href="assets\libs\summernote\summernote-bs4.css" rel="stylesheet" type="text/css">
    <!-- App css -->
    <link href="assets\css\bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet">
    <link href="assets\css\icons.min.css" rel="stylesheet" type="text/css">
    <link href="assets\css\app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet">



</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        @include('backend.includes.header')
        <!-- end Topbar -->
        <!-- ========== Left Sidebar Start ========== -->
        @include('backend.includes.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <div class="content">

                <!-- Start container-fluid -->
                @yield('content')
                <!-- end container-fluid -->

                <!-- Footer Start -->
                @include('backend.includes.footer')
                <!-- end Footer -->

            </div>
            <!-- end content -->

        </div>
        <!-- END content-page -->

    </div>
    <!-- END wrapper -->

    <!-- Vendor js -->
    <script src="assets\js\vendor.min.js"></script>

    @yield('admin_js')
    <!-- App js -->
    <script src="assets\js\app.min.js"></script>

</body>

</html>