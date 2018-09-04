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
    <nav class="navbar navbar-default navbar-static-top m-b-0">

        <div class="navbar-header">

            <!-- Toggle icon for mobile view -->
            <div class="top-left-part">
                <!-- Logo -->
                <a class="logo" href="index.html">
                    <span class="hidden-xs">
                        <img src="../plugins/images/admin-text.png" alt="home" class="dark-logo" />
                     </span>
                </a>
            </div>
            <!-- /Logo -->

            <!-- Search input and Toggle icon -->
            <ul class="nav navbar-top-links navbar-left">
                <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>
            </ul>

            <!-- This is the message dropdown -->
            <ul class="nav navbar-top-links navbar-right pull-right">
                <!-- /.Task dropdown -->
                <!-- /.dropdown -->
                <li>
                    <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                        <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                        <img src="/admin/plugins/images/users/varun.jpg" alt="user-img" width="36" class="img-circle">
                        <b class="hidden-xs">云和管理员</b>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated flipInY">
                        <li>
                            <div class="dw-user-box">
                                <div class="u-img"><img src="/admin/plugins/images/users/varun.jpg" alt="user" /></div>
                                <div class="u-text"><h4>云和管理员</h4><p class="text-muted">varun@gmail.com</p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                            </div>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#"><i class="ti-settings"></i> 账户设置</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#"><i class="fa fa-power-off"></i> 退出登录</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>

                <!-- /.dropdown -->
            </ul>

        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- End Top Navigation -->

    <!-- Left navbar-header -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav slimscrollsidebar">
            <div class="sidebar-head">
                <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
            <ul class="nav" id="side-menu">
                <li>
                    <a href="javascript:void(0)" class="waves-effect">
                        <i data-icon="7" class="linea-icon linea-basic fa-fw"></i>
                        <span class="hide-menu">Link type </span></a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="waves-effect @if(str_contains(request()->route()->getName(), 'nodes')) active @endif">
                        <i class="mdi mdi-account fa-fw" data-icon="v"></i>
                        <span class="hide-menu">权限管理
                            <span class="fa arrow"></span>
                            <span class="label label-rouded label-purple pull-right">3</span>
                        </span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="javascript:void(0)">
                                <i class="icon-user"></i>
                                <span class="hide-menu">管理员</span>
                            </a>
                        </li>
                        <li class="@if(request()->route()->named('admin.roles.index')) active @endif">
                            <a href="{{ route('admin.roles.index') }}">
                                <i class="icon-people"></i>
                                <span class="hide-menu">角色</span>
                            </a>
                        </li>
                        <li class="@if(request()->route()->named('admin.nodes.index')) active @endif">
                            <a href="{{ route('admin.nodes.index') }}">
                                <i class="icon-list"></i>
                                <span class="hide-menu">节点</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- Left navbar-header end -->

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            @yield('content', 'this is a new page')
        </div>
    </div>
    <!-- /#page-wrapper -->

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