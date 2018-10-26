
<li class="nav-item" style="border-top: 1px solid #e0e0ef;"></li>
<li class="nav-item">
    <a class="nav-link collapsed" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
        <i class="fa fa-star menu-icon"></i>
        <span class="menu-title">Evento</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="icons" style="">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item">
                <a class="nav-link" href="{{ url("events/$event->id") }}"><i class="fa fa-home menu-icon"></i><span class="menu-title">Tablero</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('event.customers',['id' => $event->id]) }}"><i class="fa fa-users menu-icon"></i><span class="menu-title">Asistentes</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url("events/$event->id/tickets") }}"><i class="fa fa-ticket-alt menu-icon"></i><span class="menu-title">Tiquetes</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('event.orders',['id' => $event->id]) }}"><i class="fa fa-shopping-cart menu-icon"></i><span class="menu-title">Ordenes</span></a>
            </li>
            @can('event.edit')
                <li class="nav-item">
                    <a class="nav-link" href="{{ url("events/$event->id/edit") }}"><i class="fa fa-cog menu-icon"></i><span class="menu-title">Administrar</span></a>
                </li>
            @endcan

            @if ( $event->page && $event->page->slug)
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('evento/' . $event->page->slug ) }}" target="_blank"><i class="fa fa-globe menu-icon"></i><span class="menu-title text-info">Web</span></a>
                </li>
            @endif
        </ul>
    </div>
</li>
