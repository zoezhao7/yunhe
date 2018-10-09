<nav class="navbar navbar-default navbar-static-top m-b-0">

    <div class="navbar-header">

        <!-- Toggle icon for mobile view -->
        <div class="top-left-part">
            <!-- Logo -->
            <a class="logo" href="{{ route('admin.welcome') }}">
                    <span class="hidden-xs">
                        云和
                     </span>
            </a>
        </div>
        <!-- /Logo -->

        <ul class="nav navbar-top-links navbar-right pull-right">

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
                    <li><a href="{{ route('admin.my.password_edit') }}"><i class="ti-settings"></i> 修改密码</a></li>
                    <li role="separator" class="divider"></li>
                    <form id="logout_form" action="{{ route('admin.logout') }}" method="post">
                        {{ csrf_field() }}
                    </form>
                    <li>
                        <a href="javascript:void(0);" onclick="document:logout_form.submit();">
                            <i class="fa fa-power-off"></i> 退出登录
                        </a>
                    </li>

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