<nav class="navbar navbar-default navbar-static-top m-b-0">

    <div class="navbar-header">

        <div class="top-left-part">
            <a class="logo" href="index.html">
                <span class="hidden-xs"></span>
            </a>
        </div>

        <ul class="nav navbar-top-links navbar-left">
            <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>
        </ul>

        <ul class="nav navbar-top-links navbar-right pull-right">
            <li>
                <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                    <input type="text" placeholder="Search..." class="form-control">
                    <a href=""><i class="fa fa-search"></i></a>
                </form>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                    <img src="/admin/plugins/images/users/varun.jpg" alt="user-img" width="36" class="img-circle">
                    <b class="hidden-xs">{{ \Auth::guard('store')->user()->real_name }}</b>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">

                    <li>
                        <div class="dw-user-box">
                            <div class="u-img"><img src="/admin/plugins/images/users/varun.jpg" alt="user" /></div>
                            <div class="u-text">
                                <h4>{{ \Auth::guard('store')->user()->real_name }}</h4>
                                <p class="text-muted">{{ \Auth::guard('store')->user()->user_name }}</p>
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
            </li>
        </ul>
    </div>
</nav>