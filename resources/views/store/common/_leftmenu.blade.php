<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">

        <div class="sidebar-head">
            <h3>
                <span class="fa-fw open-close">
                    <i class="ti-menu hidden-xs"></i>
                    <i class="ti-close visible-xs"></i>
                </span>
                <span class="hide-menu">店长管理中心</span>
            </h3>
        </div>

        <ul class="nav" id="side-menu">

            @if (\Auth::guard('store')->user()->checkPermission('products.index'))
                <li class="nav @if(str_contains(request()->route()->getName(), ['products'])) active @endif">
                    <a href="{{ route('store.products.index') }}" class="waves-effect">
                        <i class="mdi mdi-clipboard-text fa-fw" data-icon="v"></i>
                        <span class="hide-menu">产品库</span>
                    </a>
                </li>
            @endif

            @if (\Auth::guard('store')->user()->checkPermission('employees.index'))
                <li class="nav @if(str_contains(request()->route()->getName(), ['employees'])) active @endif">
                    <a href="{{ route('store.employees.index') }}" class="waves-effect">
                        <i class="mdi mdi-nature-people fa-fw" data-icon="v"></i>
                        <span class="hide-menu">员工管理</span>
                    </a>
                </li>
            @endif

            @if (\Auth::guard('store')->user()->checkPermission('members.index'))
                <li class="nav @if(str_contains(request()->route()->getName(), ['members'])) active @endif">
                    <a href="{{ route('store.members.index') }}" class="waves-effect">
                        <i class="mdi mdi-account fa-fw" data-icon="v"></i>
                        <span class="hide-menu">客户管理</span>
                    </a>
                </li>
            @endif

            @if (\Auth::guard('store')->user()->checkPermission('orders.index'))
                <li class="nav @if(str_contains(request()->route()->getName(), ['orders'])) active @endif">
                    <a href="{{ route('store.orders.index') }}" class="waves-effect">
                        <i class="mdi mdi-cart fa-fw" data-icon="v"></i>
                        <span class="hide-menu">订单管理</span>
                    </a>
                </li>
            @endif


            @if (\Auth::guard('store')->user()->checkPermission('coins.index'))
                <li class="nav @if(str_contains(request()->route()->getName(), ['coins'])) active @endif">
                    <a href="{{ route('store.coins.index') }}" class="waves-effect">
                        <i class="mdi mdi-coin fa-fw" data-icon="v"></i>
                        <span class="hide-menu">积分记录</span>
                    </a>
                </li>
            @endif

            @if (\Auth::guard('store')->user()->checkPermission('accounts.index'))
                <li class="nav @if(str_contains(request()->route()->getName(), ['accounts'])) active @endif">
                    <a href="{{ route('store.accounts.index') }}" class="waves-effect">
                        <i class="mdi mdi-chart-areaspline fa-fw" data-icon="v"></i>
                        <span class="hide-menu">账务记录</span>
                    </a>
                </li>
            @endif

            @if (\Auth::guard('store')->user()->checkPermission('commissions.index'))
                <li class="nav @if(str_contains(request()->route()->getName(), ['commissions'])) active @endif">
                    <a href="{{ route('store.commissions.index') }}" class="waves-effect">
                        <i class="mdi mdi-cash-multiple fa-fw" data-icon="v"></i>
                        <span class="hide-menu">佣金记录</span>
                    </a>
                </li>
            @endif

            @if (\Auth::guard('store')->user()->checkPermission('stockOrders.index'))
                <li class="nav @if(str_contains(request()->route()->getName(), ['stockOrders'])) active @endif">
                    <a href="{{ route('store.stock_orders.index') }}" class="waves-effect">
                        <i class="mdi mdi-cart-plus fa-fw" data-icon="v"></i>
                        <span class="hide-menu">备货订单管理</span>
                    </a>
                </li>
            @endif

            @if (\Auth::guard('store')->user()->isSuperAdmin())
                <li>
                    <a href="javascript:void(0)"
                       class="waves-effect @if(str_contains(request()->route()->getName(), ['admins', 'roles', 'nodes'])) active @endif">
                        <i class="mdi mdi-verified fa-fw" data-icon="v"></i>
                        <span class="hide-menu">权限管理
                            <span class="fa arrow"></span>
                            <span class="label label-rouded label-purple pull-right">2</span>
                        </span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li class="@if(request()->route()->named('store.roles.index')) active @endif">
                            <a href="{{ route('store.roles.index') }}">
                                <i class="icon-people"></i>
                                <span class="hide-menu">角色</span>
                            </a>
                        </li>
                        <li class="@if(request()->route()->named('store.nodes.index')) active @endif">
                            <a href="{{ route('store.nodes.index') }}">
                                <i class="icon-list"></i>
                                <span class="hide-menu">节点</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

        </ul>
    </div>
</div>