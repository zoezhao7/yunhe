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


        <ul class="nav navbar-top-links navbar-left">
            <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>
            <?php $taskOrders = \Auth::guard('admin')->user()->orderTasks(); ?>
            @if ( ! $taskOrders->isEmpty() )
            <li class="dropdown">
                <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="mdi mdi-check-circle"></i>
                    <div class="notify">
                        <span class="heartbit"></span>
                        <span class="point"></span>
                    </div>
                </a>
                <ul class="dropdown-menu mailbox animated bounceInDown">
                    <li>
                        <div class="drop-title">你有{{ $taskOrders->count() }}条订单需要处理</div>
                    </li>
                    <li>
                        @foreach($taskOrders as $key=>$order)
                            @if($key<4)
                            <div class="message-center">
                                <a href="{{ route('admin.stock_orders.show', $order->id) }}">
                                    <div class="user-img">
                                        <img src="{{ $order->employee->avatar }}" alt="user" class="img-circle">
                                        <span class="profile-status online pull-right"></span>
                                    </div>
                                    <div class="mail-contnet">
                                        <h5>{{ $order->store->name }}</h5>
                                        <span class="mail-desc">有一笔新的备货订单需要处理。</span>
                                        <span class="time">{{ $order->created_at->format('M-d H:i') }}</span>
                                    </div>
                                </a>
                            </div>
                            @endif
                        @endforeach
                    </li>
                    <li>
                        <a class="text-center" href="{{ route('admin.stock_orders.index') }}"> <strong>查看所有新订单</strong> <i class="fa fa-angle-right"></i> </a>
                    </li>
                </ul>
                <!-- /.dropdown-messages -->
            </li>
            @endif
        </ul>




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