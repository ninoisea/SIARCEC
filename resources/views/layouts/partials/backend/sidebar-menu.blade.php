{{-- ### $Sidebar Menu ### --}}
<ul class="sidebar-menu scrollable pos-r">
    <li class="nav-item">
        <a class="sidebar-link" href="javascript:void(0);">
            <span class="title">Menú de Navegación.</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="sidebar-link" href="{{ url('/') }}">
            <span class="icon-holder">
                <i class="c-blue-500 ti-home"></i>
            </span>
            <span class="title">Dashboard</span>
        </a>
    </li>
    @if(\Auth::user()->role_id == 1)
    <li class="nav-item">
        <a class="sidebar-link" href="{{ url('/users') }}">
            <span class="icon-holder">
                <i class="c-red-500 ti-user"></i>
            </span>
            <span class="title">Usuarios</span>
        </a>
    </li>
    @endif
    <li class="nav-item dropdown">
        <a class="dropdown-toggle" href="javascript:void(0);">
            <span class="icon-holder">
                <i class="c-green-500 ti-folder"></i>
            </span>
            <span class="title">Cheques</span>
            <span class="arrow">
                <i class="ti-angle-right"></i>
            </span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a class='sidebar-link' href="{{ route('cheques.index') }}">Ver cheques</a>
            </li>                
            <li>
                <a class='sidebar-link' href="{{ route('cheques.create') }}">Registrar cheques</a>
            </li>
        </ul>
    </li>
</ul>