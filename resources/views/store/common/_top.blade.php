<nav class="navbar navbar-default navbar-static-top m-b-0">

    <div class="navbar-header">

        <div class="top-left-part" style="width:auto; text-align: center; border-right: 1px solid rgba(0, 0, 0, 0.08);">
            <a class="logo" href="{{ route('store.welcome') }}">
                <span class="hidden-xs" style="margin: 0 25px;">{{ \Auth::guard('store')->user()->store->name }}</span>
            </a>
        </div>

        <ul class="nav navbar-top-links navbar-left">
            <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i
                            class="ti-close ti-menu"></i></a></li>
        </ul>

        <ul class="nav navbar-top-links navbar-right pull-right">

            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                    <img src="{{ \Auth::guard('store')->user()->avatar }}" alt="user-img" width="36" class="img-circle">
                    <b class="hidden-xs">{{ \Auth::guard('store')->user()->name }}</b>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">

                    <li>
                        <div class="dw-user-box" style="padding: 10px 20px;">
                            <div class="u-img"><img src="{{ \Auth::guard('store')->user()->avatar }}" alt="user"
                                                    style="width: 60px;"/></div>
                            <div class="u-text">
                                <h4>{{ \Auth::guard('store')->user()->name }}</h4>
                                <p class="text-muted">{{ \Auth::guard('store')->user()->phone }}</p>
                            </div>
                        </div>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{ route('store.my.passwordEdit') }}"><i class="ti-settings"></i> 修改密码</a></li>
                    <li role="separator" class="divider"></li>
                    <form id="logout_form" action="{{ route('store.logout') }}" method="post">
                        {{ csrf_field() }}
                    </form>
                    <li>
                        <a href="javascript:void(0);" onclick="document:logout_form.submit();">
                            <i class="fa fa-power-off"></i> 退出登录
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
    </div>
</nav>