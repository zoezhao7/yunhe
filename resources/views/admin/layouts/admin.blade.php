<!DOCTYPE html>
<!--
   This is a starter template page. Use this page to start your new project from
   scratch. This page gets rid of all links and provides the needed markup only.
   -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/admin/plugins/images/favicon.png">
    <title>@yield('title') - 云和</title>
    <!-- Bootstrap Core CSS -->
    <link href="/admin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- This is Sidebar menu CSS -->
    <link href="/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- This is a Animation CSS -->
    <link href="/admin/css/animate.css" rel="stylesheet">
    <!-- This is a Custom CSS -->
    <link href="/admin/css/style.css" rel="stylesheet">
    <!-- color CSS you can use different color css from css/colors folder -->
    <!-- We have chosen the skin-blue (default.css) for this starter
         page. However, you can choose any other skin from folder css / colors .
         -->
    <link href="/admin/css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="fix-sidebar">
<!-- Preloader -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
</div>
<div id="wrapper">

    <!-- Top Navigation -->
    @include('admin.common._top')

    <!-- Left navbar-header -->
    @include('admin.common._leftmenu')

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            @yield('content', 'this is a new page')
        </div>
    </div>

</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="/admin/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="/admin/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Sidebar menu plugin JavaScript -->
<script src="/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--Slimscroll JavaScript For custom scroll-->
<script src="/admin/js/jquery.slimscroll.js"></script>
<!-- Custom Theme JavaScript -->
<script src="/admin/js/custom.js"></script>
</body>

</html>