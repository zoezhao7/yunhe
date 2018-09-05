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
                    <b class="hidden-xs">{{ \Auth::user()->real_name }}</b>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">

                    <li>
                        <div class="dw-user-box">
                            <div class="u-img"><img src="/admin/plugins/images/users/varun.jpg" alt="user" /></div>
                            <div class="u-text">
                                <h4>{{ \Auth::user()->real_name }}</h4>
                                <p class="text-muted">{{ \Auth::user()->user_name }}</p>
                            </div>
                        </div>
                    </li>

                    <li role="separator" class="divider"></li>
                    <li><a href="#"><i class="ti-settings"></i> 账户设置</a></li>
                    <li role="separator" class="divider"></li>

                    <form id="logout_form" action="{{ route('admin.logout') }}" method="post">
                        {{ csrf_field() }}
                        <li>
                            <a href="javascript:void(0);" onclick="document:logout_form.submit();">
                                <i class="fa fa-power-off"></i> 退出登录
                            </a>
                        </li>
                    </form>

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