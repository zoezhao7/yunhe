<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">

        <div class="sidebar-head">
            <h3>
                <span class="fa-fw open-close">
                    <i class="ti-menu hidden-xs"></i>
                    <i class="ti-close visible-xs"></i></span>
                <span class="hide-menu">管理菜单</span></h3>
        </div>

        <ul class="nav" id="side-menu">

            @if (\Auth::user()->checkPermission('products.index'))
                <li class="nav @if(str_contains(request()->route()->getName(), ['products'])) active @endif">
                    <a href="{{ route('admin.products.index') }}" class="waves-effect">
                        <i class="mdi mdi-clipboard-text fa-fw" data-icon="v"></i>
                        <span class="hide-menu">产品管理</span></a>
                </li>
            @endif

            @if (\Auth::user()->checkPermission('hubs.index'))
                <li class="nav @if(str_contains(request()->route()->getName(), ['hubs'])) active @endif">
                    <a href="{{ route('admin.hubs.index') }}" class="waves-effect">
                        <i class="mdi mdi-table-large fa-fw" data-icon="v"></i>
                        <span class="hide-menu">轮毂仓库</span></a>
                </li>
            @endif

            @if (\Auth::user()->checkPermission('members.index'))
                <li class="nav @if(str_contains(request()->route()->getName(), ['members'])) active @endif">
                    <a href="{{ route('admin.members.index') }}" class="waves-effect">
                        <i class="mdi mdi-account fa-fw" data-icon="v"></i>
                        <span class="hide-menu">客户管理</span></a>
                </li>
            @endif

            @if (\Auth::user()->checkPermission('stock_orders.index'))
                <li class="nav @if(str_contains(request()->route()->getName(), ['stock_orders'])) active @endif">
                    <a href="{{ route('admin.stock_orders.index') }}" class="waves-effect">
                        <i class="mdi mdi-cart-plus fa-fw" data-icon="v"></i>
                        <span class="hide-menu">备货订单</span></a>
                </li>
            @endif


            @if (\Auth::user()->checkPermission('stores.index'))
                <li>
                    <a href="javascript:void(0)"
                       class="waves-effect @if(str_contains(request()->route()->getName(), ['stores', 'employees'])) active @endif">
                        <i data-icon="v" class="mdi mdi-home fa-fw"></i>
                        <span class="hide-menu">门店管理
                            <span class="fa arrow"></span>
                            <span class="label label-rouded label-purple pull-right">2</span>
                        </span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li class="@if(request()->route()->named('admin.stores.index')) active @endif">
                            <a href="{{ route('admin.stores.index') }}">
                                <i class="icon-home"></i>
                                <span class="hide-menu">门店管理</span>
                            </a>
                        </li>
                        @if (\Auth::user()->checkPermission('employees.index'))
                            <li class="@if(request()->route()->named('admin.employees.index')) active @endif">
                                <a href="{{ route('admin.employees.index') }}">
                                    <i class="icon-people"></i>
                                    <span class="hide-menu">员工管理</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif


            @if (\Auth::user()->checkPermission('nodes.index'))
                <li>
                    <a href="javascript:void(0)"
                       class="waves-effect @if(str_contains(request()->route()->getName(), ['admins', 'roles', 'nodes'])) active @endif">
                        <i class="mdi mdi-verified fa-fw" data-icon="v"></i>
                        <span class="hide-menu">权限管理
                            <span class="fa arrow"></span>
                            <span class="label label-rouded label-purple pull-right">3</span>
                        </span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li class="@if(request()->route()->named('admin.admins.index')) active @endif">
                            <a href="{{ route('admin.admins.index') }}">
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
            @endif

        </ul>
    </div>
</div>