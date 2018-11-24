<nav class="sidebar sidebar-offcanvas sidebar-fixed" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="profile-image">
                    <img src="{{ route('user.avatar',['company' => Auth::user()->company_id, 'id' => Auth::user()->id ]) }}" alt="image"/>
                </div>
                <div class="profile-name">
                    <p class="name">
                        {{ ucfirst(Auth::user()->first_name) }}
                    </p>
                    <p class="designation">
                        Super Admin
                    </p>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.user.index') }}"><i class="fa fa-user menu-icon"></i><span class="menu-title">Usuarios</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.role.index') }}"><i class="fa fa-book menu-icon"></i><span class="menu-title">Roles</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.customer.index') }}"><i class="fa fa-users menu-icon"></i><span class="menu-title">Clientes</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route("admin.events.index") }}"><i class="fa fa-calendar menu-icon"></i><span class="menu-title">Eventos</span></a>
        </li>
        @stack('sidebar')
    </ul>
</nav>