<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">

        <div class="sidebar-head">
            <h3>
                <span class="fa-fw open-close">
                    <i class="ti-menu hidden-xs"></i>
                    <i class="ti-close visible-xs"></i></span>
                <span class="hide-menu">超级管理员</span></h3>
        </div>

        <ul class="nav" id="side-menu">
            <li>
                <a href="javascript:void(0)" class="waves-effect">
                    <i data-icon="7" class="linea-icon linea-basic fa-fw"></i>
                    <span class="hide-menu">产品管理</span></a>
            </li>

            <li>
                <a href="javascript:void(0)" class="waves-effect">
                    <i data-icon="7" class="linea-icon linea-basic fa-fw"></i>
                    <span class="hide-menu">门店管理</span></a>
            </li>

            <li>
                <a href="javascript:void(0)" class="waves-effect @if(str_contains(request()->route()->getName(), ['admins', 'roles', 'nodes'])) active @endif">
                    <i class="mdi mdi-account fa-fw" data-icon="v"></i>
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

        </ul>
    </div>
</div>