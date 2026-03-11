<nav class="sidebar-nav">
    <ul>
        <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <span class="icon"><i class="lni lni-dashboard"></i></span>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('admin.productos.*') ? 'active' : '' }}">
            <a href="{{ route('admin.productos.index') }}">
                <span class="icon"><i class="lni lni-apartment"></i></span>
                <span class="text">Habitaciones</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('admin.categorias.*') ? 'active' : '' }}">
            <a href="{{ route('admin.categorias.index') }}">
                <span class="icon"><i class="lni lni-grid-alt"></i></span>
                <span class="text">Tipos</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('admin.reservas.*') ? 'active' : '' }}">
            <a href="{{ route('admin.reservas.index') }}">
                <span class="icon"><i class="lni lni-calendar"></i></span>
                <span class="text">Reservas</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
            <a href="{{ route('admin.sliders.index') }}">
                <span class="icon"><i class="lni lni-image"></i></span>
                <span class="text">Slider</span>
            </a>
        </li>
    </ul>
</nav>
