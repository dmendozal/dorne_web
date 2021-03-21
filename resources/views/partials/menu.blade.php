<div class="sidebar">
    <nav class="sidebar-nav ps ps--active-y">
        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt">
                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>

            @can('user_management_access')
            <li class="nav-item nav-dropdown" >
                <a class="nav-link  nav-dropdown-toggle">
                    <i class="fas fa-users nav-icon">
                    </i>
                    {{ trans('global.userManagement.title') }}
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                            <i class="fas fa-unlock-alt nav-icon">

                            </i>
                            {{ trans('global.permission.title') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                            <i class="fas fa-briefcase nav-icon">

                            </i>
                            {{ trans('global.role.title') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                            <i class="fas fa-user nav-icon">

                            </i>
                            {{ trans('global.user.title') }}
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('horario_access')
            <li class="nav-item">
                <a href="{{ route("admin.products.index") }}" class="nav-link {{ request()->is('admin/products') || request()->is('admin/products/*') ? 'active' : '' }}">
                    <i class="fas fa-cogs nav-icon">

                    </i>
                    {{ trans('global.product.title') }}
                </a>
            </li>
            @endcan


            <li class="nav-item">
                <a href="{{ route("admin.empleados.index") }}" class="nav-link {{ request()->is('admin/empleados') || request()->is('admin/empleados/*') ? 'active' : '' }}">
                    <i class="fas fa-user nav-icon">

                    </i>
                    {{ trans('global.empleado.title') }}
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route("admin.horarios.index") }}" class="nav-link {{ request()->is('admin/horarios') || request()->is('admin/horarios/*') ? 'active' : '' }}">
                    <i class="fas fa-hourglass nav-icon">

                    </i>
                    {{ trans('global.horario.title') }}
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route("admin.clientes.index") }}" class="nav-link {{ request()->is('admin/clientes') || request()->is('admin/clientes/*') ? 'active' : '' }}">
                    <i class="fas fa-book-reader nav-icon">

                    </i>
                    {{ trans('global.cliente.title') }}
                </a>


            <li class="nav-item">
                <a href="{{ route("admin.solicitud.index") }}" class="nav-link {{ request()->is('admin/solicitud') || request()->is('admin/solicitud/*') ? 'active' : '' }}">
                    <i class="fas fa-book nav-icon">
                    </i>
                    {{ trans('global.solicitud.title') }}
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route("admin.servicios.index") }}" class="nav-link {{ request()->is('admin/servicios') || request()->is('admin/servicios/*') ? 'active' : '' }}">
                    <i class="fas fa-book-open nav-icon">
                    </i>
                    {{ trans('global.servicio.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("admin.reportes.index") }}" class="nav-link {{ request()->is('admin/reportes') || request()->is('admin/reportes/*') ? 'active' : '' }}">
                    <i class="fas fa-book-open nav-icon">
                    </i>
                    {{ trans('global.reporte.title') }}
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 869px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 415px;"></div>
        </div>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
